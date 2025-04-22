@extends('layouts.app')

@section('body')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('menu.sidebar')
            </div>
            
            <div class="col-md-10 mt-mobile-50">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Dashboard</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Inventory Section -->
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white shadow-lg" style="height: 100%; padding: 20px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h3 class="card-title mb-3" style="font-size: 1.75rem;">
                                        <i class="fas fa-boxes"></i> Inventory
                                    </h3>
                                    <p class="card-text" style="font-size: 1.2rem;">
                                        Manage and track your inventory items.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Events Section -->
                    <div class="col-md-4 mb-4"> <!-- Adjusted to match the size of the Fitness Lab card -->
                        <div class="card bg-info text-white shadow-lg" style="height: 100%; padding: 20px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <!-- Card Title with Icon -->
                                <div>
                                    <h3 class="card-title mb-3" style="font-size: 1.75rem;">
                                        <i class="fas fa-calendar-alt"></i> Upcoming Events
                                    </h3>
                                    <div class="table-responsive mb-3">
                                        <table class="table table-sm table-borderless text-white">
                                            <thead>
                                                <tr>
                                                    <th>Event Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($events as $event)
                                                <tr>
                                                    <td>{{ $event->eventname }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->start)->format('M d, Y H:i') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->end)->format('M d, Y H:i') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($events->isEmpty())
                                        <p class="text-center text-white">No upcoming events</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                
                    <!-- Fitness Lab Section -->
                    <div class="col-md-4 mb-4">
                        <div class="card {{ $fitnessCardColor }} text-white shadow-lg" style="height: 100%; padding: 20px;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h3 class="card-title mb-3" style="font-size: 1.75rem;">
                                        <i class="fas fa-dumbbell"></i> Fitness Lab
                                    </h3>
                                    <p class="card-text" style="font-size: 1.2rem;">
                                        Access the fitness lab Available Slots.
                                    </p>
                                    <p class="mt-3" style="font-size: 1.4rem;">
                                        <strong>Available Slots:</strong> <span id="fitness-count">{{ $availableSlots }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Add CountUp.js for animation -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.8/countUp.min.js"></script>
                <script>
                    const eventsCount = new CountUp('events-count', {{ $ongoingEventsCount }});
                    const fitnessCount = new CountUp('fitness-count', {{ $availableSlots }});
                    if (!eventsCount.error) eventsCount.start();
                    if (!fitnessCount.error) fitnessCount.start();
                </script>
                
            </div>
        </div>
    </div>
</div>

@endsection
