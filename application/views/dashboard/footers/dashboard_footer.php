<footer id="footer">
    <p>Copyright, &copy; 2019</p>
</footer>

<!-- Change Password  -->
<div class="modal fade" id="password-change-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open('change-password'); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </div>
                <div id="alert-msg"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txt_currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="txt_currentPassword" name="current_password" placeholder="Enter your current password">
                    </div>
                    <div class="form-group">
                        <label for="txt_newPassword">New Password</label>
                        <input type="password" class="form-control" id="txt_newPassword" name="new_password" placeholder="Enter your new password">
                    </div>
                    <div class="form-group">
                        <label for="txt_repeatPassword">Repeat Password</label>
                        <input type="password" class="form-control" id="txt_repeatPassword" name="repeat_password" placeholder="Repeat new password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="change-password" type="submit" class="btn btn-primary">Change Password</button>
                </div>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript--> 
<script src="<?php echo base_url() ;?>assets/js/jquery.min.js"></script>
<<<<<<< HEAD
<!-- JQuery UI -->
<script src="<?php echo base_url() ;?>vendor/components/jqueryui/jquery-ui.min.js"></script>
=======
<!-- Moment JS -->
<script src="<?php echo base_url() ;?>assets/js/moment.min.js"></script>
>>>>>>> dashboard-analytics
<script src="<?php echo base_url(); ?>assets/vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ;?>assets/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    /* Change Password AJAX */
    $('#change-password').click(function() {
        var form_data = {
            current_password: $('#txt_currentPassword').val(),
            new_password: $('#txt_newPassword').val(),
            repeat_password: $('#txt_repeatPassword').val(),
        };
        $.ajax({
            url: "<?php echo site_url('change-password'); ?>",
            type: 'POST',
            data: form_data,
            success: function(msg) {
                if (msg == 'Success') {
                    $('#alert-msg').html('<div class="alert alert-success text-center">Your Password has been change successfully!<br />Please logout to confirm your new password</div>');
                    //Clear Form
                    $('#txt_currentPassword').val('');
                    $('#txt_newPassword').val('');
                    $('#txt_repeatPassword').val('');
                    setTimeout(function(){// wait for 2 secs
                        location.reload(); // then reload the page.
                    }, 1000); 
                } else if (msg == 'Error') {
                    $('#alert-msg').html('<div class="alert alert-danger text-center">Error in changing your password! Please try again later.</div>');
                    //Clear Form
                    $('#txt_currentPassword').val('');
                    $('#txt_newPassword').val('');
                    $('#txt_repeatPassword').val('');
                } else {
                    $('#alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });
        return false;
    });
</script>