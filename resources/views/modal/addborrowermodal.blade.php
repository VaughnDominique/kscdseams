<div class="modal fade" id="modal-borrower" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Add Borrower</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('borrowCreate') }}" id="addBorrow">
                    @csrf
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label class="badge badge-secondary">Type of Equipment:</label>
                                <select name="equiptype" id="type" class="form-control form-control-sm">
                                    <option disabled selected>--Select--</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Musical">Musical</option>
                                    <option value="PE Equipments">PE Equipments</option>
                                    <option value="Utility">Utility</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="badge badge-secondary">Equipment:</label>
                                <select name="equipid" id="equipid" class="form-control form-control-sm">
                                    <option disabled selected> --Select-- </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="badge badge-secondary">Quantity:</label>
                                <input type="number" name="equipqty" class="form-control form-control-sm" min="1">
                                <small id="availableQtyInfo" class="text-muted text-danger"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label class="badge badge-secondary">Last name:</label>
                                <input type="text" name="lname" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label class="badge badge-secondary">First name:</label>
                                <input type="text" name="fname" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label class="badge badge-secondary">Middle Initial:</label>
                                <input type="text" name="mname" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label class="badge badge-secondary">Office/College:</label>
                                <select name="department" class="form-control form-control-sm select2">
                                    <option disabled selected> --Select-- </option>
                                    @foreach ($office as $dataoffice)
                                        <option value="{{ $dataoffice->id }}">{{ $dataoffice->office_abbr }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="badge badge-secondary">Type:</label>
                                <select name="borrowertype" class="form-control form-control-sm">
                                    <option disabled selected>--Select--</option>
                                    <option value="Student">Student</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Borrower ID Number:</label>
                                <input type="text" name="borrowerid" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="dateborrowed">Date Borrowed</label>
                                <input type="date" name="dateborrowed" class="form-control" id="dateborrowed">
                            </div>
                            <div class="col-md-4">
                                <label for="datereturned">Date Returned</label>
                                <input type="date" name="dateretured" class="form-control" id="datereturned">
                            </div>
                            <div class="col-md-4">
                                <label for="borrowedspan">Borrow Span (Days)</label>
                                <input type="number" name="borrowedspan" class="form-control" id="borrowedspan" readonly>
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
</div>