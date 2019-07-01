<footer id="footer">
            <p>Copyright, &copy; 2019</p>
        </footer>
        <!-- /Footer -->

        <!-- Modal -->
            <!-- Edit Information  -->
            <div class="modal fade" id="edit-informatoin-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Information</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="txt_name">Name</label>
                                    <input type="email" class="form-control" id="txt_name">
                                </div>
                                <div class="form-group">
                                    <label for="txt_email">Email</label>
                                    <input type="text" class="form-control" id="txt_email">
                                </div>
                                <div class="form-group">
                                    <label for="txt_username">Username</label>
                                    <input type="text" class="form-control" id="txt_username">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- Change Password  -->
            <div class="modal fade" id="password-change-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="txt_currentPassword">Current Password</label>
                                    <input type="email" class="form-control" id="txt_currentPassword" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="txt_newPassword">New Password</label>
                                    <input type="password" class="form-control" id="txt_newPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="txt_repeatPassword">Repeat Password</label>
                                    <input type="password" class="form-control" id="txt_repeatPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        <!-- /Modal -->

        <!-- Bootstrap core JavaScript--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo base_url() ;?>assets/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
    </body>
</html>