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
                                <h1 class="m-0">Event Appointment</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Event Appointment</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <table id="schedeventTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Date Start</th>
                                            <th>Date End</th>
                                            <th>Office</th>
                                            <th width="10%">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modal.addeventmodal')

<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editEventForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editEventId">
                    <div class="form-group">
                        <label for="editEventname">Event</label>
                        <input type="text" class="form-control" id="editEventname" name="eventname">
                    </div>
                    <div class="form-group">
                        <label for="editEventDateStart">Date Start</label>
                        <input type="datetime-local" class="form-control" id="editEventDateStart" name="start">
                    </div>
                    <div class="form-group">
                        <label for="editEventDateEnd">Date End</label>
                        <input type="datetime-local" class="form-control" id="editEventDateEnd" name="end">
                    </div>
                    <div class="form-group">
                        <label for="editEventDateOffice">Office/Department:</label>
                        <select name="officeID" class="form-control form-control-sm select2bs4" id="editEventDateOffice">
                            <option disabled selected> --Select-- </option>
                            @foreach ($office as $dataoffice)
                                <option value="{{ $dataoffice->id }}">{{ $dataoffice->office_abbr }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var eventschedReadRoute = "{{ route('geteventschedRead') }}";
    var eventschedCalendarRoute = "{{ route('eventschedShow') }}";
    var eventschedCreateRoute = "{{ route('eventappointCreate') }}";
    var eventschedUpdateRoute = "{{ route('eventappointUpdate', ['id' => ':id']) }}";
    var eventschedDeleteRoute = "{{ route('eventappointDelete', ['id' => ':id']) }}";
</script>

@endsection
