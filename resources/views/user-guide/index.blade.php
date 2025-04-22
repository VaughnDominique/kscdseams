@extends('layouts.app')

@section('body')

<style>
    .fc-event {
        border-color: #198754; background-color: #198754;
    }
</style>
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
                                <h1 class="m-0">User Guide</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">User Guide</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <p>The KSCD Management System allows the admin to:</p>
                                <ul>
                                    <li>Manage sports and fitness lab equipment inventory.</li>
                                    <li>Monitor and approve equipment reservations.</li>
                                    <li>Track gym usage and control capacity.</li>
                                    <li>Manage appointment schedules.</li>
                                    <li>Send email notifications for overdue equipment.</li>
                                    <li>View reports and update system availability.</li>
                                </ul>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#guideModal1">View Complete Guide</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-header bg-light">
                                            <h5><i class="fas fa-sign-in-alt"></i> 🔐 1. Logging into the Admin Panel</h5>
                                        </div>
                                        <div class="card-body">
                                            <ol>
                                                <li>Open your browser and go to the system URL (e.g., http://localhost/kscdsystem/login.php).</li>
                                                <li>Enter your admin username and password.</li>
                                                <li>Click Login to access the dashboard.</li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header bg-light">
                                            <h5><i class="fas fa-tachometer-alt"></i> 📊 2. Dashboard Overview</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>After logging in, you'll see an overview of:</p>
                                            <ul>
                                                <li>Total Equipment</li>
                                                <li>Active Reservations</li>
                                                <li>Available Equipment</li>
                                                <li>Gym Capacity Usage</li>
                                                <li>Quick Calendar Access</li>
                                                <li>System Status</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-header bg-light">
                                            <h5><i class="fas fa-boxes"></i> 📦 3. Managing Equipment Inventory</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>🟢 To Add Equipment:</strong></p>
                                            <ol>
                                                <li>Go to Inventory > Add Equipment.</li>
                                                <li>Fill in the following:
                                                    <ul>
                                                        <li>Name</li>
                                                        <li>Category (e.g., Dumbbells, Balls, Yoga Mats)</li>
                                                        <li>Date of Use / Purchase</li>
                                                        <li>Status (Available, In Use, Damaged)</li>
                                                    </ul>
                                                </li>
                                                <li>Click Submit.</li>
                                            </ol>
                                            
                                            <p><strong>📝 To Edit/Delete Equipment:</strong></p>
                                            <ol>
                                                <li>Navigate to Inventory > Equipment List.</li>
                                                <li>Click Edit or Delete next to the item you wish to manage.</li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header bg-light">
                                            <h5><i class="fas fa-clipboard-list"></i> 📅 4. Managing Equipment Reservations</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>✅ To Approve Reservations:</strong></p>
                                            <ol>
                                                <li>Go to Reservation > Pending Requests.</li>
                                                <li>Review the request details.</li>
                                                <li>Click Approve to confirm reservation, or Decline to reject.</li>
                                            </ol>
                                            
                                            <p><strong>📕 To View All Reservations:</strong></p>
                                            <ol>
                                                <li>Navigate to Reservation > All Records to view history and active bookings.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
