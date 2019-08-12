<!-- Add Student  -->
<div class="modal fade" id="add-student-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-student-form" action="<?php echo site_url('students/new');?>" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Student</h4>
                </div>
                <div id="student-alert-msg"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="student-profile-image">Student Picture</label><br />
                        <img id="student-profile-img" src="" width="200" style="display:none;" /> <br />
                        <small>*Optional</small>
                        <input type="file" id="student-profile-image" name="profile-image"accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="fnameStudent">First Name</label>
                        <input type="text" class="form-control" id="student-fname" name="fname">
                    </div>
                    <div class="form-group">
                        <label for="mnameStudent">Middle Name</label>
                        <input type="text" class="form-control" id="student-mname" name="mname">
                    </div>
                    <div class="form-group">
                        <label for="lnameStudent">Last Name</label>
                        <input type="text" class="form-control" id="student-lname" name="lname">
                    </div>
                    <div class="form-group">
                        <label for="txt_section">Section</label>
                        <select class="form-control" id="section-id" name="section_id">
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
                    <button id="add-student" type="submit" class="btn btn-primary">Add Student</button>
                </div>
        </form>
        </div>
    </div>
</div>
<!-- Load Webcam JS -->
<script src="<?php echo base_url() ;?>assets/js/webcam.min.js"></script>
<script src="<?php echo base_url() ;?>assets/js/dashboard/student.js"></script>

<script type="text/javascript">
    //Student View Details onClick
    $('.student_view_details').click(function() {
        var studentId=$(this).closest("tr").find("td:eq(0)").text(); // get current row 1st 
        //TD value 
        location.href = "<?php echo base_url(); ?>dashboard/students/" + studentId;
    });

    $("#student-profile-image").change(function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#student-profile-img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
    });

    // $('#use-webcam').click(function() {
    //     $('.web-cam').removeAttr('hidden');
    //     $('#use-webcam').addClass('hidden');
    // });

    /* ADD STUDENT AJAX */
    $('#add-student-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            cache:false,
            contentType: false,
            processData: false,
            success: function(msg) {
                if (msg == 'Success') {
                    $('#student-alert-msg').html('<div class="alert alert-success text-center">New Student Added Successfully!</div>');
                    //Clear Form
                    $('#student-fname').val('');
                    $('#student-mname').val('');
                    $('#student-lname').val('');
                    $('#section-id').val(0);
                    $('#student-profile-image').val('');
                    $('#student-profile-img').removeAttr('src');
                    setTimeout(function(){// wait for 2 secs
                        location.reload(); // then reload the page.
                    }, 1000); 
                } else if (msg == 'Error') {
                    $('#student-alert-msg').html('<div class="alert alert-danger text-center">Error in adding student! Please try again later.</div>');
                    //Clear Form
                    $('#student-fname').val('');
                    $('#student-mname').val('');
                    $('#student-lname').val('');
                    $('#section-id').val(0);
                    $('#student-profile-image').val('');
                    $('#student-profile-img').removeAttr('src');
                } else {
                    $('#student-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });
        return false;
    });
</script>