toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right"
};
$(document).ready(function() {
    var dataTable = $('#alltable').DataTable({
        "ajax": {
            "url": dsdsd,
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
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.id); 
        }
    });


    $(document).on('categoryAdded', function() {
        dataTable.ajax.reload();
    });
});