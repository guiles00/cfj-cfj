$(document).ready(function() {
    
    $('#becas_table_id').dataTable( {
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "processing": true,
        "searching": false,
        "serverSide": true,
        "pageLength": 25,
        "language": {
                "url": "dataTables.spanish.lang"
        },
        "lengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50,100, "Todo"]], 
        "ajax": {
            "url": "./process_becas.php",
            "type": "POST"
        },
        "columns": [
            { "data": "beca_id" },
            { "data": "tipo_beca_label" },
            { "data": "nombre" },
            { "data": "apellido" },
            { "data": "monto" },
            { "data": "estado_label" },
        ]
    } );

});