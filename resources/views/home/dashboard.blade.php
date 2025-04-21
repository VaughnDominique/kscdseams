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
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Inventory</h5>
                                <p class="card-text">
                                    Manage and track your inventory items.
                                </p>
                                <a href="{{ route('categoryRead') }}" class="btn btn-primary">Go to Inventory</a>
                            </div>
                        </div>
                    </div>

                    <!-- Events Section -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Events</h5>
                                <p class="card-text">
                                    View and manage upcoming events.
                                </p>
                                <a href="{{ route('eventappointRead') }}" class="btn btn-primary">Go to Events</a>
                            </div>
                        </div>
                    </div>

                    <!-- Fitness Lab Section -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Fitness Lab</h5>
                                <p class="card-text">
                                    Access fitness lab resources and schedules.
                                </p>
                                <a href="{{ route('fitnessappointRead') }}" class="btn btn-primary">Go to Fitness Lab</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
