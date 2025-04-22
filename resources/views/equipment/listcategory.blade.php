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
                                <h1 class="m-0">Category</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Category</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-plus"></i>
                                    Add
                                </h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('categoryCreate') }}" id="addCategory">
                                    @csrf
    
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label class="badge badge-secondary">Equipment Number:</label>
                                                <input type="text" name="serialnumber" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label class="badge badge-secondary">Equipment:</label>
                                                <input type="text" name="equipment" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label class="badge badge-secondary">Belongs to:</label>
                                                <select name="typeequip" class="form-control form-control-sm">
                                                    <option disabled selected>--Select--</option>
                                                    <option value="Sports">Sports</option>
                                                    <option value="Musical">Musical</option>
                                                    <option value="PE Equipments">PE Equipments</option>
                                                    <option value="Utility">Utility</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label class="badge badge-secondary">Quantity:</label>
                                                <input type="number" name="number_equip" class="form-control form-control-sm" min="0">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" style="background-color: #198754; border-color: #198754">
                                                    <i class="fas fa-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-list"></i>
                                    List
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                                        <li class="nav-item ml-1">
                                            <a class="nav-link active text-dark text-bold" 
                                                id="custom-tabs-one-tab" 
                                                data-toggle="pill" 
                                                href="#custom-tabs-one" 
                                                role="tab" 
                                                aria-controls="custom-tabs-one" 
                                                aria-selected="true">
                                                    Sports
                                            </a>
                                        </li>
                                        <li class="nav-item ml-1">
                                            <a class="nav-link text-dark text-bold" 
                                                id="custom-tabs-two-tab" 
                                                data-toggle="pill" 
                                                href="#custom-tabs-two" 
                                                role="tab" 
                                                aria-controls="custom-tabs-two" 
                                                aria-selected="false">
                                                    Musical
                                            </a>
                                        </li>
                                        <li class="nav-item ml-1">
                                            <a class="nav-link text-dark text-bold" 
                                                id="custom-tabs-three-tab" 
                                                data-toggle="pill" 
                                                href="#custom-tabs-three" 
                                                role="tab" 
                                                aria-controls="custom-tabs-three" 
                                                aria-selected="false">
                                                    PE Equipment
                                            </a>
                                        </li>
                                        <li class="nav-item ml-1">
                                            <a class="nav-link text-dark text-bold" 
                                                id="custom-tabs-four-tab" 
                                                data-toggle="pill" 
                                                href="#custom-tabs-four" 
                                                role="tab" 
                                                aria-controls="custom-tabs-four" 
                                                aria-selected="false">
                                                    Utility
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one" role="tabpanel" aria-labelledby="custom-tabs-one-tab">
                                        <div class="mt-2">
                                            <table id="catsportTable" class="table table-hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Equipment Number</th>
                                                        <th>Equipment</th>
                                                        <th>Category</th>
                                                        <th>No. of Equipments</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-two" role="tabpanel" aria-labelledby="custom-tabs-two-tab">
                                        <div class="mt-2">
                                            <table id="catmusicTable" class="table table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Equipment Number</th>
                                                        <th>Equipment</th>
                                                        <th>Category</th>
                                                        <th>No. of Equipments</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-three" role="tabpanel" aria-labelledby="custom-tabs-three-tab">
                                        <div class="mt-2">
                                            <table id="catpeequipTable" class="table table-hover" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Equipment Number</th>
                                                        <th>Equipment</th>
                                                        <th>Category</th>
                                                        <th>No. of Equipments</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-four" role="tabpanel" aria-labelledby="custom-tabs-four-tab">
                                        <div class="mt-2">
                                            <table id="catutilityTable" class="table table-hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Equipment Number</th>
                                                        <th>Equipment</th>
                                                        <th>Category</th>
                                                        <th>No. of Equipments</th>
                                                        {{-- <th>No. of Available</th> --}}
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    
                                                </tbody>
                                            </table>
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

<div class="modal fade" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="editCatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCatModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCatForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editCatId">
                    <div class="form-group">
                        <label for="editSerial">Serial Number</label>
                        <input type="text" class="form-control" id="editSerial" name="serialnumber">
                    </div>
                    <div class="form-group">
                        <label for="editEquip">Equipment</label>
                        <input type="text" class="form-control" id="editEquip" name="equipment">
                    </div>
                    <div class="form-group">
                        <label for="editType">Belongs to</label>
                        <select name="typeequip" class="form-control form-control-sm" id="editType">
                            <option disabled selected>--Select--</option>
                            <option value="Sports">Sports</option>
                            <option value="Musical">Musical</option>
                            <option value="PE Equipments">PE Equipments</option>
                            <option value="Utility">Utility</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity</label>
                        <input type="number" class="form-control" id="editQuantity" name="number_equip">
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
    var categorySportsReadRoute = "{{ route('getcatSportsRead') }}";
    var categoryMusicalReadRoute = "{{ route('getcatMusicalRead') }}";
    var categoryPEequipReadRoute = "{{ route('getcatPEequipRead') }}";
    var categoryUtilityReadRoute = "{{ route('getcatUtilityRead') }}";
    var categoryCreateRoute = "{{ route('categoryCreate') }}";
    var categoryUpdateRoute = "{{ route('categoryUpdate', ['id' => ':id']) }}";
    var categoryDeleteRoute = "{{ route('categoryDelete', ['id' => ':id']) }}";
</script>

@endsection
