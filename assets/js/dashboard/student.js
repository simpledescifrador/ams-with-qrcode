$(document).ready( function () {
    $('#student_table').DataTable(
        {
            "order": [[ 0, "desc" ]],
            responsive: true
        }
    );
} );