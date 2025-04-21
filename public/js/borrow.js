toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right"
};
$(document).ready(function() {
    $('#addBorrow').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: borrowCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $(document).trigger('borrowAdded');
                    $('input[name="lname"]').val('');
                    $('input[name="fname"]').val('');
                    $('input[name="mname"]').val('');
                    $('input[name="equipqty"]').val('');
                    $('#modal-borrower').modal('hide');
                } else {
                    toastr.error(response.message);
                    console.log(response);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
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
                    return `<span class="badge badge-success">${data}</span>`;
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
    $('#type').on('change', function(){
        var type = $(this).val();

        if(type) {
            $.ajax({
                url: borrowDateSpanRoute.replace(':type', type), 
                type: 'GET',
                success: function(data) {
                    $('#equipid').empty().append('<option disabled selected> --Select-- </option>');
                    
                    $.each(data, function(key, value) {
                        $('#equipid').append('<option value="'+ value.id +'" data-number-equip="'+ value.number_equip +'">'+ value.equipment +'</option>');
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
        
        $('#availableQtyInfo').html('<span style="color: red;">Available Quantity: ' + numberEquip + '</span>');

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
        
        $('#editavailableQtyInfo').html('<span style="color: red;">Available Quantity: ' + numberEquip + '</span>');

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