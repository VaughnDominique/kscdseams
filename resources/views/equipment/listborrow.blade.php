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
                                <h1 class="m-0">Borrow</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Borrow</li>
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
                                <table id="borrowTable" class="table table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Borrower ID</th>
                                            <th>Type</th>
                                            <th>Office/College</th>
                                            <th>Type</th>
                                            <th>Item Borrow</th>
                                            <th>Quantity</th>
                                            <th>Date Borrowed</th>
                                            <th>Date Span</th>
                                            <th>Status</th>
                                            <th width="10%">#</th>
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

@include('modal.addborrowermodal')

<div class="modal fade" id="editBorrowModal" tabindex="-1" role="dialog" aria-labelledby="editBorrowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBorrowModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editBorrowForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editBorrowId">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="type" class="badge badge-secondary">Type of Equipment:</label>
                                <select name="equiptype" id="edittype" class="form-control form-control-sm">
                                    <option disabled selected>--Select--</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Musical">Musical</option>
                                    <option value="PE Equipments">PE Equipments</option>
                                    <option value="Utility">Utility</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="equipid" class="badge badge-secondary">Equipment:</label>
                                <select name="equipid" id="editequipid" class="form-control form-control-sm">
                                    <option disabled selected> --Select-- </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="editBorrowQty" class="badge badge-secondary">Quantity:</label>
                                <input type="number" name="equipqty" class="form-control form-control-sm" min="1" id="editBorrowQty">
                                <small id="editavailableQtyInfo" class="text-muted text-danger"></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="editBorrowlname" class="badge badge-secondary">Last name:</label>
                                <input type="text" name="lname" class="form-control form-control-sm" id="editBorrowlname">
                            </div>
                            <div class="col-md-4">
                                <label for="editBorrowfname" class="badge badge-secondary">First name:</label>
                                <input type="text" name="fname" class="form-control form-control-sm" id="editBorrowfname">
                            </div>
                            <div class="col-md-4">
                                <label for="editBorrowmname" class="badge badge-secondary">Middle Initial:</label>
                                <input type="text" name="mname" class="form-control form-control-sm" id="editBorrowmname">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="editBorrowoff" class="badge badge-secondary">Office/College:</label>
                                <select name="department" class="form-control form-control-sm select2" id="editBorrowoff">
                                    <option disabled selected> --Select-- </option>
                                    @foreach ($office as $dataoffice)
                                        <option value="{{ $dataoffice->id }}">{{ $dataoffice->office_abbr }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editBorrowtype" class="badge badge-secondary">Type:</label>
                                <select name="borrowertype" class="form-control form-control-sm" id="editBorrowtype">
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
                                <label for="editborrowerid">Borrower ID Number:</label>
                                <input type="text" name="borrowerid" class="form-control" id="editborrowerid">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="dateborrowed">Date Borrowed</label>
                                <input type="datetime-local" name="dateborrowed" class="form-control" id="dateborrowed" min="{{ date('Y-m-d\TH:i') }}">
                                <span class="text-danger error-text dateborrowed_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="datereturned">Date Returned</label>
                                <input type="datetime-local" name="dateretured" class="form-control" id="datereturned" min="{{ date('Y-m-d\TH:i') }}">
                                <span class="text-danger error-text dateretured_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="borrowedspan">Borrow Span (Days)</label>
                                <input type="number" name="borrowedspan" class="form-control" id="borrowedspan" readonly>
                            </div>
                        </div>
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
    var borrowReadRoute = "{{ route('getborrowRead') }}";
    var borrowCreateRoute = "{{ route('borrowCreate') }}";
    var borrowDateSpanRoute = "{{ route('getEquipmentByType', ':type') }}";
    var borrowReceivedRoute = "{{ route('returnitemBorrow') }}";
    
    // Set minimum date for date pickers
    document.addEventListener('DOMContentLoaded', function() {
        // Format current date and time for datetime-local input
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        const today = `${year}-${month}-${day}T${hours}:${minutes}`;
        
        // Set min attribute for the date inputs in both forms
        document.querySelectorAll('input[type="datetime-local"]').forEach(function(el) {
            el.min = today;
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let dateBorrowed = document.getElementById("dateborrowed");
        let dateReturned = document.getElementById("datereturned");
        let borrowedSpan = document.getElementById("borrowedspan");

        function isWeekend(date) {
            let day = date.getDay(); // 0 = Sunday, 6 = Saturday
            return (day === 0 || day === 6);
        }

        function getNextValidDate(startDate, days) {
            let count = 0;
            let validDate = new Date(startDate);

            while (count < days) {
                validDate.setDate(validDate.getDate() + 1);
                if (!isWeekend(validDate)) {
                    count++;
                }
            }

            return validDate;
        }

        dateBorrowed.addEventListener("change", function() {
            if (dateBorrowed.value) {
                let borrowDate = new Date(dateBorrowed.value);
                
                let minReturnDate = getNextValidDate(borrowDate, 1); // At least 1 valid day after borrow date
                let maxReturnDate = getNextValidDate(borrowDate, 5); // Max 5 valid borrow days
                
                dateReturned.min = minReturnDate.toISOString().split("T")[0];
                dateReturned.max = maxReturnDate.toISOString().split("T")[0];
                dateReturned.value = ""; // Reset return date
                borrowedSpan.value = ""; // Reset span count
            }
        });

        dateReturned.addEventListener("change", function() {
            if (dateBorrowed.value && dateReturned.value) {
                let borrowDate = new Date(dateBorrowed.value);
                let returnDate = new Date(dateReturned.value);

                let count = 0;
                let tempDate = new Date(borrowDate);

                while (tempDate < returnDate) {
                    tempDate.setDate(tempDate.getDate() + 1);
                    if (!isWeekend(tempDate)) {
                        count++;
                    }
                }
                
                borrowedSpan.value = count;
            }
        });
        
        // When submitting the borrow form, ensure email is included
        $("#borrowForm").on('submit', function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);
            
            $.ajax({
                url: borrowCreateRoute,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 1) {
                        $('#modal-borrower').modal('hide');
                        $('#borrowForm')[0].reset();
                        $('#borrowTable').DataTable().ajax.reload();
                        toastr.success(response.msg);
                    } else {
                        $.each(response.error, function(prefix, val) {
                            $('.' + prefix + '_error').text(val[0]);
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status == 409) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                }
            });
        });
    });
</script>

@endsection
