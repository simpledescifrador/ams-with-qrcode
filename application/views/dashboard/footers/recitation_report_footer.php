<script type="text/javascript">
    $(document).ready( function () {
        var recitationReportTable = $('#recitation_report_table').DataTable(
        {
            responsive: true,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {"className": "text-center", "targets": 0},
                { "width": "5%", "targets": 0 },
                { "width": "20%", "targets": 2 },
                { 'orderable': false, "width": "15%", 'targets': 2 },
            ],
            "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "iDisplayLength": -1

        }
    );
    var buttons = new $.fn.dataTable.Buttons(recitationReportTable, {
            buttons: [
                { extend: 'excelHtml5', footer: true , messageTop: "<?php echo $heading; ?> Recitation Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"},
                { extend: 'pdfHtml5', footer: true , messageTop: "<?php echo $heading; ?> Recitation Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"}
            ]
        }).container().appendTo($('#buttons'));
    } );

var srecitationReportTable = $('#s_recitation_report_table').DataTable(
        {
            responsive: true,
            paging: false,
            "searching": false,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {"className": "text-center", "targets": 0},
                { "width": "5%", "targets": 0 },
                { "width": "20%", "targets": 2 },
                { 'orderable': false, "width": "15%", 'targets': 2 },
            ]

        }
    );
    var buttons1 = new $.fn.dataTable.Buttons(srecitationReportTable, {
            buttons: [
                { extend: 'excelHtml5', footer: true , messageTop: "<?php echo $heading; ?> Recitation Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"},
                { extend: 'pdfHtml5', footer: true , messageTop: "<?php echo $heading; ?> Recitation Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"}
            ]
        }).container().appendTo($('#buttons1'));
</script>