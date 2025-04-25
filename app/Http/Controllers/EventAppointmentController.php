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
use App\Models\EventSched;

class EventAppointmentController extends Controller
{
    public function eventappointRead()
    {
        $office = Offices::orderBy('office_abbr', 'ASC')->get();
        return view('events.appointevent', compact('office'));
    }

    public function geteventschedRead() 
    {
        $data = EventSched::leftJoin('offices', 'schedevent.officeID', '=', 'offices.id')
                ->select('schedevent.*', 'offices.office_abbr', 'offices.id as oid')
                ->get();

        return response()->json(['data' => $data]);
    }

    public function eventschedShow() 
    {
        $events = EventSched::all();
        $eventData = [];

        foreach ($events as $event) {
            $eventData[] = [
                'title' => $event->eventname,
                'start' => $event->start, 
                'end' => $event->end,
            ];
        }
        return response()->json($eventData);
    }

    public function checkeventschedShow() 
    {
        $events = EventSched::all();
        $eventData = [];

        foreach ($events as $event) {
            $eventData[] = [
                'title' => $event->eventname,
                'start' => $event->start, 
                'end' => $event->end,
            ];
        }
        return response()->json($eventData);
    }

    public function eventappointCreate(Request $request) 
    {
        $request->validate([
            'eventname' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'officeID' => 'required',   
        ]);

        $start = $request->input('start');
        $end = $request->input('end');
        $eventName = $request->input('eventname');
        $officeID = $request->input('officeID');

        $today = Carbon::today()->format('Y-m-d');
        if ($start < $today) {
            return response()->json([
                'error' => true,
                'message' => 'Cannot create events in the past. Please select a future date.'
            ], 422);
        }

        // ❗ Check if same name + same start date + same start time already exists
        $conflictSameNameTime = EventSched::where('eventname', $eventName)
            ->whereDate('start', Carbon::parse($start)->toDateString())
            ->whereTime('start', Carbon::parse($start)->toTimeString())
            ->exists();

        if ($conflictSameNameTime) {
            return response()->json([
                'error' => true,
                'message' => 'An event with the same name and start time already exists on this day.'
            ], 409);
        }

        // Optional: Check time overlap with other events
        $conflict = EventSched::where(function ($query) use ($start, $end) {
                $query->where('start', '<', $end)
                      ->where('end', '>', $start);
            })->exists();

        if ($conflict) {
            return response()->json([
                'error' => true,
                'message' => 'Event schedule conflicts with another event.'
            ], 409);
        }

        EventSched::create([
            'eventname' => $eventName,
            'start' => $start,
            'end' => $end,
            'officeID' => $officeID,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event Schedule successfully created'
        ], 200);
    }

    public function eventappointUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'eventname' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'officeID' => 'required',
        ]);

        try {
            $start = $request->input('start');
            $end = $request->input('end');
            $eventName = $request->input('eventname');

            $today = Carbon::today()->format('Y-m-d');
            if ($start < $today) {
                return response()->json([
                    'error' => true,
                    'message' => 'Cannot schedule events in the past. Please select a future date.'
                ], 422);
            }

            $event = EventSched::findOrFail($request->input('id'));

            // Check conflict excluding current event
            $conflict = EventSched::where('officeID', $request->input('officeID'))
                ->where('id', '!=', $request->input('id'))
                ->where(function ($query) use ($start, $end) {
                    $query->whereBetween('start', [$start, $end])
                          ->orWhereBetween('end', [$start, $end])
                          ->orWhere(function ($q) use ($start, $end) {
                              $q->where('start', '<=', $start)
                                ->where('end', '>=', $end);
                          });
                })->exists();

            if ($conflict) {
                return response()->json([
                    'error' => true,
                    'message' => 'Event schedule conflicts with an existing event'
                ], 409);
            }

            $event->update([
                'eventname' => $eventName,
                'start' => $start,
                'end' => $end,
                'officeID' => $request->input('officeID'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Event Schedule updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed to update Event Schedule'
            ], 500);
        }
    }

    public function eventappointDelete($id) 
    {
        $event = EventSched::find($id);
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted Successfully'
        ]);
    }
}
