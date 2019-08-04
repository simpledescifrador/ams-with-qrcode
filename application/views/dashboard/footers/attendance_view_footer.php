<!-- Add Attendance Modal -->
<div class="modal fade" id="add-attendance-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
      </div>
      <div id="add-attendance-alert-msg"></div>
      <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="text_studentIde">Student Name</label>
                    <input id="text_studentName" type="text" class="form-control" name="text_studentName" readonly>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type='text' class="form-control" readonly id="add-attendance-date" value="<?php echo date("D, M d, Y", strtotime($attendance_date)); ?>">
                </div>
                <div class="form-group">
                    <label for="text_remark">Remark</label>
                    <select class="form-control" id="text_remark" name="remark">
                        <option>Select Remark</option>
                        <option value="Present">Present</option>
                        <option value="Tardy">Tardy</option>
                        <option value="Unexcused">Unexcused</option>
                        <option value="Excused">Excused</option>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add-attendance-btn" type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Attendance Modal -->
<div class="modal fade" id="edit-attendance-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Attendance</h4>
      </div>
      <div id="edit-attendance-alert-msg"></div>
      <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="edit-student-name">Student Name</label>
                        <input type="text" class="form-control" id="edit-student-name" readonly />
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                        <div class='input-group date default-date-picker' id='edit-attendance-dp'>
                            <input type='text' class="form-control" readonly id="edit-date" value="<?php echo date("D, M d, Y", strtotime($attendance_date)); ?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                </div>
                <div class="form-group">
                    <label for="text_editRemark">Remark</label>
                    <select class="form-control" id="text_editRemark" name="edit-remark">
                        <option>Select Remark</option>
                        <option value="Present">Present</option>
                        <option value="Tardy">Tardy</option>
                        <option value="Unexcused">Unexcused</option>
                        <option value="Excused">Excused</option>
                    </select>
                </div>
            </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="edit-attendance-btn" type="button" class="btn btn-warning">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Attendance Modal -->
<div class="modal fade" id="delete-attendance-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <label>Are you sure you wanna delete this selected attendance?</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button id="delete-btn" type="button" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready( function () {
        var attendanceTable = $('#view_attendance_table').DataTable(
            {
                responsive: true,
                "order": [[ 1, "asc" ]],
                "columnDefs": [
                    { "width": "20%", "targets": 4 },
                    { "width": "15%", "targets": 3 },
                    { "width": "20%", "targets": 2 },
                    {
                        "targets": [ 2, 0 ],
                        "visible": false
                    }
                ],
                "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "iDisplayLength": -1
            }
        );

        //get Selected row id
        $('#view_attendance_table tbody').on( 'click', 'tr', function () {
            var selectedRow = attendanceTable.row( this ).data();
            $("#selected-id").val(selectedRow[2]);
            $("#student-id").val(selectedRow[0]);
            $("#text_studentName").val(selectedRow[1]);
            $("#edit-student-name").val(selectedRow[1]);
            var remark = $($.parseHTML(selectedRow[3])).text();
            $("#text_editRemark").val(remark);
        } );

    } );

    //Add Attendance
    $("#add-attendance-btn").click(function(e) {
        e.preventDefault();
        var form_data = {
            student_id: $("#student-id").val(),   
            date: $("#add-attendance-date").val(),         
            remark: $('#text_remark').val()
        };
        var remark = $('#text_remark').val();
        if (remark == "Select Remark") {
            $('#add-attendance-alert-msg').html('<div class="alert alert-danger">Please select remark</div>');
        } else {
            $.ajax({
                url: "<?php echo site_url("attendance/new"); ?>",
                type: 'POST',
                data: form_data,
                success: function(msg) {
                    if (msg == 'Success') {
                        $('#add-attendance-alert-msg').html('<div class="alert alert-success text-center">Attendance Added Successfully!</div>');
                        //Clear Form
                        $('#text_remark').val("Select Remark");
                        setTimeout(function(){// wait for 1 secs
                            location.reload(); // then reload the page.
                        }, 1000); 
                    } else if (msg == 'Error') {
                        $('#add-attendance-alert-msg').html('<div class="alert alert-danger text-center">Error in adding new attendance! Please try again later.</div>');
                        //Clear Form
                        $('#text_remark').val("Select Remark");
                    } else {
                        $('#add-attendance-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                    }
                }
            });            
        }

        return false;        
    });

     //Edit Attendance
     $("#edit-attendance-btn").click(function(e) {
        e.preventDefault();
        var attendanceId = $("#selected-id").val();
        var form_data = {
            date: $('#edit-date').val(),
            remark: $('#text_editRemark').val()
        };
        
        var remark = $('#text_editRemark').val();
        if (remark == "Select Remark") {
            $('#edit-attendance-alert-msg').html('<div class="alert alert-danger">Please select remark</div>');
        } else {
            $.ajax({
                url:  "<?php echo base_url(); ?>attendance/" + attendanceId + "/edit",
                type: 'POST',
                data: form_data,
                success: function(msg) {
                    if (msg == 'Success') {
                        $('#edit-attendance-alert-msg').html('<div class="alert alert-success text-center">Attendance Edited Successfully!</div>');
                        setTimeout(function(){// wait for 1 secs
                            location.reload(); // then reload the page.
                        }, 1000); 
                    } else if (msg == 'Error') {
                        $('#edit-attendance-alert-msg').html('<div class="alert alert-danger text-center">Error in editing attendance! Please try again later.</div>');
                    } else {
                        $('#edit-attendance-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                    }
                }
            });
        }
        return false;
    });

    //Delete Attendance
    $("#delete-btn").click(function(e) {
        e.preventDefault();
        var attendanceId = $("#selected-id").val();
        $.ajax({
            url: "<?php echo base_url(); ?>attendance/" + attendanceId + "/delete",
            type: 'PUT',
            success: function(msg) {
                if (msg == 'Success') {
                    alert('Successful Deleted!');
                    setTimeout(function(){// wait for 1 secs
                        location.reload();
                }, 1000); 
                } else {
                    alert('Error Occurred! Failed to delete');
                }
            }
        });
        return ;
    });
    //Default Date input date picker
    $('.default-date-picker').datetimepicker({
        format: 'D, M d, yyyy HH:ii P',
        todayBtn: "linked",
        autoclose: true
    });

    function isValidDate(dateString) {
      var regEx = /^\d{4}-\d{2}-\d{2}$/;
      if(!dateString.match(regEx)) return false;  // Invalid format
      var d = new Date(dateString);
      var dNum = d.getTime();
      if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
      return d.toISOString().slice(0,10) === dateString;
    }
</script>