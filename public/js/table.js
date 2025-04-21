$(function () {
    $("#example1").DataTable({
        "responsive": false,
        "lengthChange": true, 
        "autoWidth": true,
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        height: '100'
    })
});