<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;

class CategoryController extends Controller
{
    public function categoryRead()
    {
        return view('equipment.listcategory');
    }

    public function getcatSportsRead() 
    {
        $data = Category::where('typeequip', '=', 'Sports')->orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function getcatMusicalRead() 
    {
        $data = Category::where('typeequip', '=', 'Musical')->orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function getcatPEequipRead() 
    {
        $data = Category::where('typeequip', '=', 'PE Equipments')->orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function getcatUtilityRead() 
    {
        $data = Category::where('typeequip', '=', 'Utility')->orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function categoryCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'serialnumber' => 'required',
                'equipment' => 'required',
                'typeequip' => 'required',
                'number_equip' => 'required',
            ]);

            $serialNo = $request->input('serialnumber'); 
            $equipName = $request->input('equipment'); 
            $typeName = $request->input('typeequip'); 
            $existingCat = Category::where('serialnumber', $serialNo)
                ->where('equipment', $equipName)
                ->where('typeequip', $typeName)
                ->first();

            if ($existingCat) {
                return response()->json([
                    'error' => true, 
                    'message' => "Category with Serial Number: $serialNo and Equipment Name: $equipName already exists"
                ], 404);
            }

            try {
                Category::create([
                    'serialnumber' => $serialNo,
                    'equipment' => $equipName,
                    'typeequip' => $request->input('typeequip'),
                    'number_equip' => $request->input('number_equip'),
                ]);

                return response()->json(['success' => true, 'message' => 'Category stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Category'], 404);
            }
        }
    }

    public function categoryUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'serialnumber' => 'required',
            'equipment' => 'required',
            'typeequip' => 'required',
            'number_equip' => 'required',
        ]);

        try {
            $serialNo = $request->input('serialnumber'); 
            $equipName = $request->input('equipment'); 
            $existingCat = Category::where('serialnumber', $serialNo)
                ->where('equipment', $equipName)
                ->where('id', '!=', $request->input('id'))
                ->first();

            if ($existingCat) {
                return response()->json([
                    'error' => true, 
                    'message' => "Category with Serial Number: $serialNo and Equipment Name: $equipName already exists"
                ], 404);
            }

            $cat = Category::findOrFail($request->input('id'));
            $cat->update([
                'serialnumber' => $serialNo,
                'equipment' => $equipName,
                'typeequip' => $request->input('typeequip'),
                'number_equip' => $request->input('number_equip'),
        ]);
            return response()->json(['success' => true, 'message' => 'Category update successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to Update Category'], 404);
        }
    }

    public function categoryDelete($id) 
    {
        $cat = Category::find($id);
        $cat->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
