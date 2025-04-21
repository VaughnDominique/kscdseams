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
                                <h1 class="m-0">Logbook</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Logbook</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-borrower">
                                        <i class="fas fa-user-plus"></i> Add New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('logselectdateShow') }}" id="searchLogs">
    
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label class="badge badge-secondary">Select Date:</label>
                                                <input type="date" name="dateborrowed" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-md-6">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-success btn-sm" style="background-color: #198754; border-color: #198754">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
