$(function() {

    $('#table1').DataTable({
        pageLength: 10,
        dom: 'Bfrtip',             
        buttons: [ ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
        },
        "footerCallback": function ( row, data, start, end, display ) {
        }                   
    });

});