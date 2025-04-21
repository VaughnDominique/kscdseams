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
use App\Models\Fitness;

class FitnessAppointmentController extends Controller
{
    public function fitnessappointRead()
    {
        $setf = Fitness::orderBy('id', 'ASC')->get();

        return view('fitness.workout', compact('setf'));
    }
    

    public function fitnessappointCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'maxslot' => 'required|integer|min:0',
                'availslot' => 'required|integer|min:0',
            ]);

            try {
                $fitness = Fitness::first();

                if ($fitness) {
                    $fitness->update([
                        'maxslot' => $request->input('maxslot'),
                        'availslot' => $request->input('availslot'),
                    ]);
                } else {
                    Fitness::create([
                        'maxslot' => $request->input('maxslot'),
                        'availslot' => $request->input('availslot'),
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Fitness slots have been set successfully!'
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to set fitness slots.'
                ], 500);
            }
        }
    }


    public function getfitnessShow() 
    {
        $data = Fitness::orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }

    public function getfitnessShowland() 
    {
        $data = Fitness::orderBy('id', 'ASC')->get();

        return response()->json(['data' => $data]);
    }
}
