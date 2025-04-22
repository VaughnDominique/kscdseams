toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right"
};
$(document).ready(function() {
    $('#addBorrow').off('submit').on('submit', function(event) {
        event.preventDefault();
        
        // Check for past dates before submitting
        const borrowDate = $('input[name="dateborrowed"]').val();
        const returnDate = $('input[name="dateretured"]').val();
        
        if (isDateInPast(borrowDate)) {
            toastr.error('Borrow date cannot be in the past');
            return false;
        }
        
        if (isDateInPast(returnDate)) {
            toastr.error('Return date cannot be in the past');
            return false;
        }
        
        var formData = $(this).serialize();

        $.ajax({
            url: borrowCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                // Handle both response formats (status and success)
                if(response.status == 1 || response.success) {
                    toastr.success(response.msg || response.message);
                    $(document).trigger('borrowAdded');
                    $('input[name="lname"]').val('');
                    $('input[name="fname"]').val('');
                    $('input[name="mname"]').val('');
                    $('input[name="equipqty"]').val('');
                    $('input[name="email"]').val('');
                    $('#modal-borrower').modal('hide');
                } else {
                    if (response.error) {
                        $.each(response.error, function(prefix, val) {
                            $('.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        toastr.error(response.msg || response.message || 'An error occurred');
                    }
                }
            },
            error: function(xhr, status, error) {
                try {
                    var errorObj = JSON.parse(xhr.responseText);
                    if (errorObj.message) {
                        toastr.error(errorObj.message);
                    } else if (errorObj.error && errorObj.error.message) {
                        toastr.error(errorObj.error.message);
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                } catch(e) {
                    toastr.error('An unexpected error occurred.');
                }
            }
        });
    });
    
    // Helper function to check if date is in past
    function isDateInPast(dateValue) {
        const selectedDate = new Date(dateValue);
        selectedDate.setHours(0, 0, 0, 0); // Reset time part for date comparison
        
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Reset time part for date comparison
        
        return selectedDate < today;
    }
    
    // Set min date for all date inputs
    function setMinDates() {
        const today = new Date().toISOString().split('T')[0];
        $('input[type="date"]').attr('min', today);
    }
    
    setMinDates();
    
    // Add validation to date inputs
    $('input[name="dateborrowed"], input[name="dateretured"]').on('change', function() {
        if (isDateInPast(this.value)) {
            toastr.error('Cannot select a date in the past');
            this.value = '';
        }
    });

    var dataTable = $('#borrowTable').DataTable({
        "ajax": {
            "url": borrowReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {
                data: null,
                render: function(data, type, row) {
                    var firstname = data.fname;
                    var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                    var lastName = data.lname;
            
                    return lastName + ', ' + firstname + ' ' + middleInitial;
                }
            }, 
            {data: 'borrowerid'},
            {data: 'borrowertype'},
            {data: 'office_abbr'},
            {data: 'equiptype'},
            {data: 'equipment'},
            {
                data: 'equipqty',
                render: function(data, type, row) {
                    var lowQuantityThreshold = 3; // Define threshold here to match other locations
                    
                    // Use red badge for low quantities
                    if (data <= lowQuantityThreshold) {
                        return `<span class="badge badge-danger" style="color: white; font-weight: bold;">${data}</span>`;
                    } else {
                        return `<span class="badge badge-success">${data}</span>`;
                    }
                }
            },
            {data: 'dateborrowed',
                render: function (data, type, row) {
                    if (type === 'display') {
                        return moment(data).format('MMMM D, YYYY');
                    } else {
                        return data;
                    }
                }
            },
            {data: 'borrowedspan'},
            {data: 'stat'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-borrowedit" data-id="' + row.id + '" data-lname="' + row.lname + '" data-fname="' + row.fname + '" data-mname="' + row.mname + '" data-typeequip="' + row.typeequip + '" data-equipid="' + row.equipid + '" data-equipqty="' + row.equipqty + '" data-department="' + row.department + '" data-borrowertype="' + row.borrowertype + '" data-dateborrowed="' + row.dateborrowed + '" data-datereturned="' + row.datereturned + '" data-borrowedspan="' + row.borrowedspan + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
                            '<a href="' + borrowReceivedRoute + '/' + data + '" class="dropdown-item returned-item" data-id="' + data + '">' +
                            '<i class="fas fa-check"></i> Borrow Item Return ' +
                            '</a>'+
                            '<button type="button" value="' + data + '" class="dropdown-item cat-delete">' +
                            '<i class="fas fa-trash"></i> Delete' +
                            '</button>' +
                            '</div>' +
                            '</div>';
                        return dropdown;
                    } else {
                        return data;
                    }
                },
            },
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.id); 
        }
    });


    $(document).on('borrowAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).ready(function(){
    // Define low quantity threshold
    var lowQuantityThreshold = 0; // You can adjust this value as needed
    
    $('#type').on('change', function(){
        var type = $(this).val();

        if(type) {
            $.ajax({
                url: borrowDateSpanRoute.replace(':type', type), 
                type: 'GET',
                success: function(data) {
                    $('#equipid').empty().append('<option disabled selected> --Select-- </option>');
                    
                    $.each(data, function(key, value) {
                        // Add quantity in the option text with appropriate coloring
                        var qtyDisplay = value.number_equip;
                        var equipText = value.equipment;
                        
                        // If stock is low or out, add the qty info with appropriate styling
                        if (value.number_equip <= lowQuantityThreshold) {
                            equipText += ' <span style="color: red;">(' + qtyDisplay + ' left)</span>';
                        }
                        
                        $('#equipid').append('<option value="'+ value.id +'" data-number-equip="'+ value.number_equip +'">'+ equipText +'</option>');
                    });
                }
            });
        } else {
            $('#equipid').empty().append('<option disabled selected> --Select-- </option>');
        }
    });

    $('#equipid').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var numberEquip = selectedOption.data('number-equip');
        
        // Check if quantity is low
        if (numberEquip <= lowQuantityThreshold && numberEquip > 0) {
            $('#availableQtyInfo').html(
                '<span style="color: red; font-weight: bold;">Warning: Low Quantity Available: ' + numberEquip + '</span>'
            );
            toastr.warning('Selected equipment is low in stock (' + numberEquip + ' remaining)');
        } else if (numberEquip == 0) {
            $('#availableQtyInfo').html(
                '<span style="color: red; font-weight: bold;">Equipment Out of Stock: ' + numberEquip + '</span>'
            );
            toastr.error('Selected equipment is currently out of stock!');
            // Optionally disable the submit button
            $('#addBorrowSubmitBtn').prop('disabled', true);
        } else {
            $('#availableQtyInfo').html('<span style="color: green;">Available Quantity: ' + numberEquip + '</span>');
            // Re-enable submit button if it was disabled
            $('#addBorrowSubmitBtn').prop('disabled', false);
        }

        // Move the handler outside to prevent binding multiple times
        $('input[name="equipqty"]').off('input').on('input', function() {
            var requestedQty = parseInt($(this).val());
            
            if (requestedQty > numberEquip) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Requested quantity exceeds available equipment!',
                });
                $(this).val('');
            }
        });
    });
});

$(document).on('click', '.btn-borrowedit', function() {
    var id = $(this).data('id');
    var lname = $(this).data('lname');
    var fname = $(this).data('fname');
    var mname = $(this).data('mname');
    var equiptype = $(this).data('typeequip');
    var equipid = $(this).data('equipid');
    var equipqty = $(this).data('equipqty');
    var department = $(this).data('department');
    var borrowertype = $(this).data('borrowertype');
    var dateborrowed = $(this).data('dateborrowed');
    var datereturned = $(this).data('datereturned');
    var borrowedspan = $(this).data('borrowedspan');
    
    $('#editCatId').val(id);
    $('#editBorrowlname').val(lname);
    $('#editBorrowfname').val(fname);
    $('#editBorrowmname').val(mname);
    $('#type').val(equiptype);
    $('#equipid').val(equipid);
    $('#editBorrowQty').val(equipqty);
    $('#editBorrowoff').val(department);
    $('#editBorrowtype').val(borrowertype);
    $('#dateborrowed').val(dateborrowed);
    $('#datereturned').val(datereturned);
    $('#borrowedspan').val(borrowedspan);
    
    $('#editBorrowModal').modal('show');
});

$(document).ready(function(){
    // Define low quantity threshold (same as above)
    var lowQuantityThreshold = 0;
    
    $('#edittype').on('change', function(){
        var type = $(this).val();

        if(type) {
            $.ajax({
                url: borrowDateSpanRoute.replace(':type', type), 
                type: 'GET',
                success: function(data) {
                    $('#editequipid').empty().append('<option disabled selected> --Select-- </option>');
                    
                    $.each(data, function(key, value) {
                        $('#editequipid').append('<option value="'+ value.id +'" data-number-equip="'+ value.number_equip +'">'+ value.equipment +'</option>');
                    });
                }
            });
        } else {
            $('#editequipid').empty().append('<option disabled selected> --Select-- </option>');
        }
    });

    $('#editequipid').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var numberEquip = selectedOption.data('number-equip');
        
        // Check if quantity is low
        if (numberEquip <= lowQuantityThreshold && numberEquip > 0) {
            $('#editavailableQtyInfo').html(
                '<span style="color: orange;">Warning: Low Quantity Available: ' + numberEquip + '</span>'
            );
            toastr.warning('Selected equipment is low in stock (' + numberEquip + ' remaining)');
        } else if (numberEquip == 0) {
            $('#editavailableQtyInfo').html(
                '<span style="color: red;">Equipment Out of Stock: ' + numberEquip + '</span>'
            );
            toastr.error('Selected equipment is currently out of stock!');
            // Optionally disable the submit button
            $('#editBorrowSubmitBtn').prop('disabled', true);
        } else {
            $('#editavailableQtyInfo').html('<span style="color: green;">Available Quantity: ' + numberEquip + '</span>');
            // Re-enable submit button if it was disabled
            $('#editBorrowSubmitBtn').prop('disabled', false);
        }

        $('input[name="equipqty"]').on('input', function() {
            var requestedQty = parseInt($(this).val());
            
            if (requestedQty > numberEquip) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Requested quantity exceeds available equipment!',
                });
                $(this).val('');
            }
        });
    });
});

$(document).ready(function() {
    $('#editBorrowForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var id = $('#editCatId').val();

        $.ajax({
            url: borrowUpdateRoute + '/' + id,
            type: "PUT",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editBorrowModal').modal('hide');
                    $(document).trigger('borrowAdded');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });
});

$(document).on('click', '.cat-delete', function() {
    var id = $(this).val();
    
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: borrowDeleteRoute + '/' + id,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        $(document).trigger('borrowAdded');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        }
    });
});

$(document).on('click', '.returned-item', function(e) {
    e.preventDefault();
    var itemId = $(this).data('id');
    //alert('Item ID: ' + itemId); // Alert to check for ID
    $.ajax({
        url: borrowReceivedRoute,
        method: 'POST',
        data: {
            id: itemId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response);
            $(document).trigger('borrowAdded');
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});