@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>Borrowed Equipment Management</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('checkOverdueItems') }}" class="btn btn-warning">
                            <i class="fas fa-bell"></i> Check Overdue Items & Send Notifications
                        </a>
                    </div>
                    
                    <!-- Main content for managing borrowed items would go here -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
