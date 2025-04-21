<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        if ($request->isMethod('post')) {
            $request->validate([
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
            ]);

            $equipId = $request->input('equipid');
            $requestedQty = (int) $request->input('equipqty');

            $equipment = Category::find($equipId);
            if (!$equipment) {
                return response()->json(['error' => true, 'message' => 'Equipment not found.'], 404);
            }

            $totalAvailable = $equipment->number_equip;

            $currentlyBorrowed = Borrowed::where('equipid', $equipId)
                ->where('stat', '=', 'Borrowed') 
                ->sum('equipqty');

            $availableNow = $totalAvailable - $currentlyBorrowed;

            if ($requestedQty > $availableNow) {
                return response()->json([
                    'error' => true,
                    'message' => 'Not enough equipment available. Only ' . $availableNow . ' item(s) left.'
                ], 409);
            }

            try {
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
                ]);

                return response()->json(['success' => true, 'message' => 'Equipment borrowed successfully'], 200);

            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to Borrow'], 404);
           }
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
            $item->update(['stat' => 'Returned']);
            return response()->json(['success' => true, 'message' => 'Item returned successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update item status'], 500);
        }
    }
}
