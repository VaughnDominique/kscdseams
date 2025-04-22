<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\EventSched; 
use App\Models\Fitness;

class DashboardController extends Controller
{
    public function dash()
    {
        $today = Carbon::now()->toDateString(); // Get today's date in 'Y-m-d' format

        // Get the count of ongoing events
        $ongoingEventsCount = EventSched::whereDate('start', '<=', $today)
                                        ->whereDate('end', '>=', $today)
                                        ->count();

        // Get fitness slots
        $fitness = Fitness::first();
        $availableSlots = $fitness?->availslot ?? 0;
        $totalSlots = $fitness?->maxslot ?? 0;

        // Set dynamic card colors based on the data
        $fitnessCardColor = $availableSlots == 0 ? 'bg-danger' : 'bg-success';
        $eventsCardColor = $ongoingEventsCount == 0 ? 'bg-secondary' : 'bg-info';

        // Fetch all events
        $events = EventSched::all(); // You can filter if needed

        // Pass all required variables to the view
        return view('home.dashboard', compact(
            'ongoingEventsCount',
            'events',
            'availableSlots',
            'totalSlots',
            'fitnessCardColor',
            'eventsCardColor'
        ));
    }


    public function logout()
    {
        if (\Auth::guard('web')->check()) {
            auth()->guard('web')->logout();
            return redirect()->route('login')->with('success', 'You have been Successfully Logged Out');
        }  else {
            return redirect()->route('dash')->with('error', 'No authenticated user to log out');
        }

    }
}