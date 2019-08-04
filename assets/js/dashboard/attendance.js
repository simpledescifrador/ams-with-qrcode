$(document).ready( function () {
    $('#recent_attendance_table').DataTable(
        {
            "order": [[ 0, "desc" ]],
            responsive: true,
            paging: false,
            "searching": false
        }
    );
} );