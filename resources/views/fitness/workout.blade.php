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
                                    <h1 class="m-0">Fitness Lab</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item breadcrumbactive"><a
                                                href="{{ route('dash') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Fitness Lab</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('fitnessappointCreate') }}" id="setFitness">
                                        @csrf

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label class="badge badge-secondary">Set Maximum for Fitness
                                                        Lab:</label>
                                                    <input type="number" name="maxslot" value="{{ $setf->first()->maxslot }}" class="form-control form-control-sm" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label class="badge badge-secondary">Set Available for Fitness
                                                        Lab:</label>
                                                    <input type="number" name="availslot" class="form-control form-control-sm" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success"
                                                        style="background-color: #198754; border-color: #198754">
                                                        <i class="fas fa-save"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-success" style="background-color: #198754 !important;">
                                <span class="info-box-icon"><i class="fas fa-dumbbell"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">
                                        <h1 id="availableSlot"></h1>
                                    </span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                        Available Slot:
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box bg-success" style="background-color: #198754 !important;">
                                <span class="info-box-icon"><i class="fas fa-dumbbell"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">
                                        <h1 id="maximumSlot"></h1>
                                    </span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                        Maximum Slot:
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var fitnessSetRoute = "{{ route('fitnessappointCreate') }}";
        var fitnessShowRoute = "{{ route('getfitnessShow') }}";
    </script>
@endsection
