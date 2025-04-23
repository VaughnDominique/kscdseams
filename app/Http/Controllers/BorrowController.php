<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\OverdueItemNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Offices;
use App\Models\Borrowed;
use App\Models\Category;

class BorrowController extends Controller
{
    public function borrowRead()
    {
        $office = Offices::orderBy('office_abbr', 'ASC')->get();
        $itemcat = Category::orderBy('equipment', 'ASC')->get();

        return view('equipment.listborrow', compact('office', 'itemcat'));
    }

    public function getEquipmentByType($type)
    {
        $equipment = Category::where('typeequip', $type)->get();
        return response()->json($equipment);
    }

    public function getborrowRead() 
    {
        $data = Borrowed::leftJoin('invtcategory', 'borrowequip.equipid', '=', 'invtcategory.id')
                ->leftJoin('offices', 'borrowequip.department', '=', 'offices.id')
                ->select('invtcategory.id as icid', 'invtcategory.equipment', 'invtcategory.typeequip', 'offices.id as oid', 'offices.office_abbr', 'borrowequip.*')
                ->get();

        return response()->json(['data' => $data]);
    }

    public function borrowCreate(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'equipid' => 'required',
            'equiptype' => 'required',
            'equipqty' => 'required',
            'department' => 'required',
            'borrowertype' => 'required',
            'dateborrowed' => 'required',
            'dateretured' => 'required',
            'borrowedspan' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $equipId = $request->input('equipid');
        $requestedQty = (int) $request->input('equipqty');

        $equipment = Category::find($equipId);
        if (!$equipment) {
            return response()->json(['error' => true, 'message' => 'Equipment not found.'], 404);
        }

        $totalAvailable = $equipment->number_equip;

        if ($requestedQty > $totalAvailable) {
            return response()->json([
                'error' => true,
                'message' => 'Not enough equipment available. Only ' . $totalAvailable . ' item(s) left.'
            ], 409);
        }

        try {
            // Start a database transaction to ensure data consistency
            DB::beginTransaction();
            
            // Create the borrow record
            Borrowed::create([
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'lname' => $request->input('lname'),
                'equipid' => $request->input('equipid'),
                'equiptype' => $request->input('equiptype'),
                'equipqty' => $request->input('equipqty'),
                'department' => $request->input('department'),
                'borrowertype' => $request->input('borrowertype'),
                'dateborrowed' => $request->input('dateborrowed'),
                'dateretured' => $request->input('dateretured'),
                'borrowedspan' => $request->input('borrowedspan'),
                'borrowerid' => $request->input('borrowerid'),
                'stat' => 'Borrowed',
                'email' => $request->input('email'),
            ]);
            
            // Update the inventory by deducting the borrowed quantity
            $equipment->number_equip = $equipment->number_equip - $requestedQty;
            $equipment->save();
            
            // Commit transaction
            DB::commit();

            return response()->json(['status' => 1, 'msg' => 'Item borrowed successfully']);

        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction
            DB::rollBack();
            return response()->json(['error' => true, 'message' => 'Failed to Borrow: ' . $e->getMessage()], 500);
        }
    }

    public function returnitemBorrow(Request $request) 
    {
        $id = $request->id;
        $item = Borrowed::find($id);

        if (!$item) {
            return response()->json(['error' => true, 'message' => 'Item not found'], 404);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();
            
            // Get the equipment details and borrowed quantity
            $equipment = Category::find($item->equipid);
            $borrowedQty = $item->equipqty;
            
            // Only process if the item is currently borrowed
            if ($item->stat === 'Borrowed') {
                // Update borrow status
                $item->update(['stat' => 'Returned']);
                
                // Add the quantity back to inventory
                if ($equipment) {
                    $equipment->number_equip = $equipment->number_equip + $borrowedQty;
                    $equipment->save();
                }
            }
            
            // Commit transaction
            DB::commit();
            
            return response()->json(['success' => true, 'message' => 'Item returned successfully and inventory updated']);
            
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            return response()->json(['error' => true, 'message' => 'Failed to update item status: ' . $e->getMessage()], 500);
        }
    }

    public function checkOverdueItems()
    {
        // Find all items that are overdue
        $overdueItems = Borrowed::where('stat', 'Borrowed')
            ->where('dateretured', '<', Carbon::now()->toDateString())
            ->get();
        
        $notificationCount = 0;
        
        foreach ($overdueItems as $item) {
            if ($item->email) {
                // Send notification
                try {
                    Mail::to($item->email)->send(new OverdueItemNotification($item));
                    $notificationCount++;
                } catch (\Exception $e) {
                    // Log error
                    \Log::error("Failed to send overdue notification: " . $e->getMessage());
                }
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => "Overdue check completed. {$notificationCount} notifications sent."
        ]);
    }

    public function sendEmails()
    {
        $today = now()->format('Y-m-d');
    
        $borrows = DB::table('borrowequip')
        ->join('invtcategory', 'borrowequip.equipid', '=', 'invtcategory.id')
        ->whereDate(DB::raw("DATE_SUB(borrowequip.dateretured, INTERVAL borrowequip.borrowedspan DAY)"), '=', $today)
        ->whereNotNull('borrowequip.email')
        ->where('borrowequip.mail_stat', 0)
        ->select('borrowequip.*', 'invtcategory.equipment as equip_name')
        ->get();
    
        foreach ($borrows as $borrow) {
            $message = "Hello {$borrow->fname} {$borrow->lname},\n\n"
                     . "This is a friendly reminder to return the borrowed equipment: {$borrow->equip_name} "
                     . "by {$borrow->dateretured}.\n\nThank you!";
        
            Mail::raw($message, function ($mail) use ($borrow) {
                $mail->to($borrow->email)
                     ->subject('Equipment Return Reminder');
            });
        
            DB::table('borrowequip')
                ->where('id', $borrow->id)
                ->update(['mail_stat' => 1]);
        }        
    
        return response()->json(['message' => 'Emails sent and mail_stat updated.']);
    }    
    
}
