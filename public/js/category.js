toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right"
};
$(document).ready(function() {
    $('#addCategory').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: categoryCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $(document).trigger('categoryAdded');
                    $('input[name="serialnumber"]').val('');
                    $('input[name="equipment"]').val('');
                    $('input[name="typeequip"]').val('');
                    $('input[name="number_equip"]').val('');
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

    var dataTable = $('#catsportTable').DataTable({
        "ajax": {
            "url": categorySportsReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'serialnumber'},
            {data: 'equipment'},
            {data: 'typeequip'},
            {data: 'number_equip'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-catedit" data-id="' + row.id + '" data-serial="' + row.serialnumber + '" data-equip="' + row.equipment + '" data-type="' + row.typeequip + '" data-numequip="' + row.number_equip + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
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


    $(document).on('categoryAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).ready(function() {
    var dataTable = $('#catmusicTable').DataTable({
        "ajax": {
            "url": categoryMusicalReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'serialnumber'},
            {data: 'equipment'},
            {data: 'typeequip'},
            {data: 'number_equip'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-catedit" data-id="' + row.id + '" data-serial="' + row.serialnumber + '" data-equip="' + row.equipment + '" data-type="' + row.typeequip + '" data-numequip="' + row.number_equip + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
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


    $(document).on('categoryAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).ready(function() {
    var dataTable = $('#catpeequipTable').DataTable({
        "ajax": {
            "url": categoryPEequipReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'serialnumber'},
            {data: 'equipment'},
            {data: 'typeequip'},
            {data: 'number_equip'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-catedit" data-id="' + row.id + '" data-serial="' + row.serialnumber + '" data-equip="' + row.equipment + '" data-type="' + row.typeequip + '" data-numequip="' + row.number_equip + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
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


    $(document).on('categoryAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).ready(function() {
    var dataTable = $('#catutilityTable').DataTable({
        "ajax": {
            "url": categoryUtilityReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'serialnumber'},
            {data: 'equipment'},
            {data: 'typeequip'},
            {data: 'number_equip'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-catedit" data-id="' + row.id + '" data-serial="' + row.serialnumber + '" data-equip="' + row.equipment + '" data-type="' + row.typeequip + '" data-numequip="' + row.number_equip + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
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


    $(document).on('categoryAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-catedit', function() {
    var id = $(this).data('id');
    var catserial = $(this).data('serial');
    var catequip = $(this).data('equip');
    var cattype = $(this).data('type');
    var catnum = $(this).data('numequip');
    
    $('#editCatId').val(id);
    $('#editSerial').val(catserial);
    $('#editEquip').val(catequip);
    $('#editType').val(cattype);
    $('#editQuantity').val(catnum);
    $('#editCatModal').modal('show');
});

$('#editCatForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: categoryUpdateRoute,
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editCatModal').modal('hide');
                $(document).trigger('categoryAdded');
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error, message) {
            var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
            toastr.error(errorMessage);
        }
    });
});

$(document).on('click', '.cat-delete', function(e) {
    var id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: categoryDeleteRoute.replace(':id', id),
                success: function(response) {
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                    }
                }
            });
        }
    })
});


$(function () {
    $('#addCategory').validate({
        rules: {
            serialnumber: {
                required: true,
            },
            equipment: {
                required: true,
            },
            typeequip: {
                required: true,
            },
            number_equip: {
                required: true,
            },
        },
        messages: {
            serialnumber: {
                required: "Please Enter serial number",
            },
            equipment: {
                required: "Please Enter equipment name",
            },
            typeequip: {
                required: "Please Select if this belongs to",
            },
            number_equip: {
                required: "Please Enter number of equipment",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);        
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});