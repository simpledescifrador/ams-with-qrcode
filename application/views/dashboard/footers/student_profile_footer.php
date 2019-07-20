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
                            <a id="" hidden>Print</a>
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

<script type="text/javascript">
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
