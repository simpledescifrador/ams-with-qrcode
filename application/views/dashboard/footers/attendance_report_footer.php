<script type="text/javascript">
    $(document).ready( function () {
        var attendanceReportTable = $('#attendance_report_table').DataTable(
            {
                responsive: true,
                paging: false,
                "searching": false,
                "order": [[ 0, "asc" ]],
                "columnDefs": [
                    {"className": "text-center", "targets": 0},
                    {"className": "text-center", "targets": 2},
                    {"className": "text-center", "targets": 3},
                    {"className": "text-center", "targets": 4},
                    {"className": "text-center", "targets": 5},
                    { "width": "5%", "targets": 0 },
                    { 'orderable': false, "width": "15%", 'targets': 2 },
                    { 'orderable': false, "width": "15%", 'targets': 3 },
                    { 'orderable': false, "width": "15%", 'targets': 4 },
                    { 'orderable': false, "width": "15%", 'targets': 5 },
                ],
                "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "iDisplayLength": -1

            }
        ); 
        var buttons = new $.fn.dataTable.Buttons(attendanceReportTable, {
            buttons: [
                { extend: 'excelHtml5', footer: true , messageTop: "<?php echo $heading; ?> Attendance Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"},
                { extend: 'pdfHtml5', footer: true , messageTop: "<?php echo $heading; ?> Attendance Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"}
            ]
        }).container().appendTo($('#buttons'));



    } );

    var sattendanceReportTable = $('#s_attendance_report_table').DataTable(
        {
            responsive: true,
            paging: false,
            "searching": false,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {"className": "text-center", "targets": 0},
                { "width": "5%", "targets": 0 },
                { 'orderable': false, "width": "15%", 'targets': 2 },
            ],
            "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "iDisplayLength": -1

        }
    );
    var buttons1 = new $.fn.dataTable.Buttons(sattendanceReportTable, {
            buttons: [
                { extend: 'excelHtml5', messageTop: "<?php echo $heading; ?> Attendance Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"},
                { extend: 'pdfHtml5', messageTop: "<?php echo $heading; ?> Attendance Report from " + "<?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?>"}
            ]
        }).container().appendTo($('#buttons1'));
</script>