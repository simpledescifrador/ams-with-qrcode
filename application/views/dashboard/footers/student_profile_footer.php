<!-- Edit Student  -->
<div class="modal fade" id="edit-student-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Student</h4>
                </div>
                <div id="student-alert-msg"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fnameStudent">First Name</label>
                        <input type="text" class="form-control" id="student-fname" name="fname" value="<?php echo $student_details['name']['fname'];?>">
                    </div>
                    <div class="form-group">
                        <label for="mnameStudent">Middle Name</label>
                        <input type="text" class="form-control" id="student-mname" name="mname" value="<?php echo $student_details['name']['mname'];?>">
                    </div>
                    <div class="form-group">
                        <label for="lnameStudent">Last Name</label>
                        <input type="text" class="form-control" id="student-lname" name="lname" value="<?php echo $student_details['name']['lname'];?>">
                    </div>
                    <div class="form-group">
                        <label for="txt_email">Section</label>
                        <select class="form-control" id="section-id" name="schoolYear">
                            <option value="0">Select Section</option>
                            <?php foreach($sections as $value ) {
                                echo "<option value='{$value['section_id']}'>{$value['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="edit-student" type="button" class="btn btn-primary">Edit Student</button>
                </div>
        </form>
        </div>
    </div>
    </div>
    <!-- Remove Student  -->
    <div class="modal fade" id="remove-student-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Remove Student</h4>
                </div>
                <div class="modal-body">
                    <label>Are you sure you wanna remove this student?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="remove-student" type="submit" class="btn btn-primary">Yes</button>
                </div>
        </form>
        </div>
    </div>
    </div>
    <!-- Generate Student's QR Code -->
    <div class="modal fade" id="student-qrcode-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">QR Code</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <img id="student-qrcode-img" src="<?php echo base_url('assets/images/qrcode_placeholder.png'); ?>"/>
                            <a id="" target="blank" hidden>Print</a>
                            <div class="form-group">
                            <label for="student-qrcode">QR Code:</label>
                            <input type="text" class="form-control" id="text-student-qrcode" readonly>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="generate-student-qrcode-btn" type="button" class="btn btn-primary">Generate QR Code</button>
                    <button id="student-qrcode-print" type="button" class="btn btn-primary disabled">Print</button>
                </div>
        </form>
        </div>
    </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generate-report-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Generate Report</h4>
      </div>
      <div class="modal-body">
      <div id="year-form-group" class="form-group">
        <label class="control-label" for="text_reportYear">From Year</label>
        <select class="form-control" id="text_reportYear" name="year">
            <option>Select Year</option>
            <?php for ($i = 0; $i < 20; $i++) : ?>
                <option value="<?php echo date("Y") - $i; ?>"><?php echo date("Y") - $i; ?></option>
            <?php endfor; ?>
        </select>
        <span class="help-block hide" >Please select the year</span>
    </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="generate-btn" type="button" class="btn btn-success outline">Generate</button>
      </div>
    </div>
  </div>
</div>
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
                    <label for="student-name">Student Name:</label>
                    <input type="text" class="form-control" id="student-name" name="student-name" placeholder="ID" disabled value="<?php echo $student_details['student_name']; ?>">
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
                    <label for="date">Date:</label>
                        <div class='input-group date' id='edit-attendance-dp'>
                            <input type='text' class="form-control" readonly id="edit-date"/>
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
        var attendanceTable = $('#student-attendance-table').DataTable(
            {
                responsive: true,
                "columnDefs": [
                    { "width": "20%", "targets": 3 },
                    { "width": "5%", "targets": 0 },
                ]
            }
        );

        //get Selected row id
        $('#student-attendance-table tbody').on( 'click', 'tr', function () {
            var selectedRow = attendanceTable.row( this ).data();
            $("#selected-id").val(selectedRow[0]);
            $("#edit-date").val(selectedRow[1]);
            $("#text_editRemark").val(selectedRow[2]);
        } );

    } );

    //Generate Student Attendance
    $("#generate-btn").click(function(e) {
        e.preventDefault();

        var year = $("#text_reportYear option:selected").val();
        if (year == "Select Year") {
            $("#year-form-group").attr('class', 'has-error');
            $("#year-form-group .help-block").addClass('show');
            $("#year-form-group .help-block").removeClass("hide");

        } else {
            $("#year-form-group").removeAttr('class', 'has-error');
            $("#year-form-group .help-block").addClass('hide');
            $("#year-form-group .help-block").removeClass("show");

            $('#generate-report-modal').modal('hide');
            $(location).attr('href', "<?php echo base_url(); ?>generate/students/<?php echo $student_details['student_id']; ?>/attendance?year=" + year);
        }
    });

    //Add Attendance
    $("#add-attendance-btn").click(function() {
        var form_data = {
            student_id: "<?php echo $student_details['student_id']; ?>",
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

    //Edit Attendance Date input date picker
    $('#edit-attendance-dp').datetimepicker({
        format: 'D, M d, yyyy HH:ii P',
        todayBtn: "linked",
        autoclose: true
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

   $('#edit-student-anchor').click(function() {
        var sectionValue = "<?php echo $student_details['section']['id']; ?>";
        $('#section-id').val(sectionValue);
    });

    /* GENERATE STUDENT QRCODE AJAX */
    $('#generate-student-qrcode-btn').click(function() {
        var studentId = window.location.pathname.split("/").pop();
        var url = "<?php echo base_url(); ?>qrcodes/students/" + studentId;
        $.ajax({
            url: url,
            type: 'GET',
            success: function(output) {
                var outputObject = JSON.parse(output);
                $("#student-qrcode-img").attr('src', outputObject.qrCodeUrl);
                $("#text-student-qrcode").val(outputObject.qrCode);
                $('#student-qrcode-print').removeClass('disabled');
            }
        });
        return false;
    });

    $("#student-qrcode-print").click(function() {
        console.log();
        var qrcode = $("#text-student-qrcode").val();

        window.open("<?php echo base_url(); ?>generate/students/qrcode/" + qrcode, '_blank');
    });

    //Edit Student
    $('#edit-student').click(function() {
        var form_data = {
            fname: $('#student-fname').val(),
            mname: $('#student-mname').val(),
            lname: $('#student-lname').val(),
            section_id: $('#section-id').val()
        };
        $.ajax({
            url: "<?php echo site_url("students/" . $student_details['student_id'] . "/edit"); ?>",
            type: 'POST',
            data: form_data,
            success: function(msg) {
                if (msg == 'Success') {
                    $('#student-alert-msg').html('<div class="alert alert-success text-center">Section Edited Successfully!</div>');
                    //Clear Form
                    $('#student-fname').val('');
                    $('#student-mname').val('');
                    $('#student-lname').val('');
                    $('#section-id').val(0);
                    setTimeout(function(){// wait for 1 secs
                        location.reload(); // then reload the page.
                    }, 1000); 
                } else if (msg == 'Error') {
                    $('#student-alert-msg').html('<div class="alert alert-danger text-center">Error in editing section! Please try again later.</div>');
                    //Clear Form
                    $('#student-fname').val('');
                    $('#student-mname').val('');
                    $('#student-lname').val('');
                    $('#section-id').val(0);
                } else {
                    $('#student-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });
        return false;
    });

    //Remove Student
    $('#remove-student').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo site_url("students/" . $student_details['student_id'] . "/delete"); ?>",
            type: 'PUT',
            success: function(msg) {
                if (msg == 'Success') {
                    alert('Successful Deleted!');
                    setTimeout(function(){// wait for 1 secs
                        location.href = "<?php echo base_url(); ?>dashboard/student";
                }, 1000); 
                } else {
                    alert('Error Occurred! Failed to delete');
                }
            }
        });
        return ;
    });
</script>
