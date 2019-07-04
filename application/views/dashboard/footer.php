<footer id="footer">
    <p>Copyright, &copy; 2019</p>
</footer>
        <!-- /Footer -->

        <!-- Modal -->
        <!-- Add Section -->
            <div class="modal fade" id="add-section-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add Section</h4>
                            </div>
                            <div id="section-alert-msg"></div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <input type="text" class="form-control" id="text_section" name="section_name">
                                </div>
                                <div class="form-group">
                                    <label for="schoolYear">School Year</label>
                                    <select class="form-control" id="text_schoolYear" name="school_year">
                                        <option>Select School Year</option>
                                        <option value="2019-2020">2019-2020</option>
                                        <option value="2020-2021">2020-2021</option>
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2024-2025">2024-2025</option>
                                        <option value="2025-2026">2025-2026</option>
                                        <option value="2026-2027">2026-2027</option>
                                        <option value="2027-2028">2027-2028</option>
                                        <option value="2028-2029">2028-2029</option>
                                        <option value="2029-2030">2029-2030</option>
                                        <option value="2030-2031">2030-2031</option>
                                        <option value="2031-2032">2031-2032</option>
                                        <option value="2032-2033">2032-2033</option>
                                        <option value="2033-2034">2033-2034</option>
                                        <option value="2034-2035">2034-2035</option>
                                        <option value="2035-2036">2035-2036</option>
                                        <option value="2036-2037">2036-2037</option>
                                        <option value="2037-2038">2037-2038</option>
                                        <option value="2038-2039">2038-2039</option>
                                        <option value="2039-2040">2039-2040</option>
                                        <option value="2040-2041">2040-2041</option>
                                        <option value="2041-2042">2041-2042</option>
                                        <option value="2042-2043">2042-2043</option>
                                        <option value="2043-2044">2043-2044</option>
                                        <option value="2044-2045">2044-2045</option>
                                        <option value="2045-2046">2045-2046</option>
                                        <option value="2046-2047">2046-2047</option>
                                        <option value="2047-2048">2047-2048</option>
                                        <option value="2048-2049">2048-2049</option>
                                        <option value="2049-2050">2049-2050</option>
                                        <option value="2050-2051">2050-2051</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="add-section" type="submit" class="btn btn-primary">Add Section</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- Edit Section  -->
            <div class="modal fade" id="edit-section-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Edit Section</h4>
                            </div>
                            <div id="sectionvb -alert-msg"></div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="section-name">Name</label>
                                    <input type="text" class="form-control" id="section-name">
                                <div class="form-group">
                                    <label for="schoolYear">School Year</label>
                                    <select class="form-control" id="text_schoolYear" name="school_year">
                                        <option>Select School Year</option>
                                        <option value="2019-2020">2019-2020</option>
                                        <option value="2020-2021">2020-2021</option>
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2024-2025">2024-2025</option>
                                        <option value="2025-2026">2025-2026</option>
                                        <option value="2026-2027">2026-2027</option>
                                        <option value="2027-2028">2027-2028</option>
                                        <option value="2028-2029">2028-2029</option>
                                        <option value="2029-2030">2029-2030</option>
                                        <option value="2030-2031">2030-2031</option>
                                        <option value="2031-2032">2031-2032</option>
                                        <option value="2032-2033">2032-2033</option>
                                        <option value="2033-2034">2033-2034</option>
                                        <option value="2034-2035">2034-2035</option>
                                        <option value="2035-2036">2035-2036</option>
                                        <option value="2036-2037">2036-2037</option>
                                        <option value="2037-2038">2037-2038</option>
                                        <option value="2038-2039">2038-2039</option>
                                        <option value="2039-2040">2039-2040</option>
                                        <option value="2040-2041">2040-2041</option>
                                        <option value="2041-2042">2041-2042</option>
                                        <option value="2042-2043">2042-2043</option>
                                        <option value="2043-2044">2043-2044</option>
                                        <option value="2044-2045">2044-2045</option>
                                        <option value="2045-2046">2045-2046</option>
                                        <option value="2046-2047">2046-2047</option>
                                        <option value="2047-2048">2047-2048</option>
                                        <option value="2048-2049">2048-2049</option>
                                        <option value="2049-2050">2049-2050</option>
                                        <option value="2050-2051">2050-2051</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="edit-section" type="submit" class="btn btn-primary">Edit Section</button>
                            </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
             <!-- Remove Section  -->
             <div class="modal fade" id="remove-section-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Remove Section</h4>
                            </div>
                            <div class="modal-body">
                                <label>Are you sure you wanna remove this section?</label>
                                <label><small>NOTE: Removing a section will also remove students enrolled in it.</small></label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button id="remove-section" type="submit" class="btn btn-primary">Yes</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        <!-- Add Student  -->
            <div class="modal fade" id="add-student-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add Student</h4>
                            </div>
                            <div id="student-alert-msg"></div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="fnameStudent">First Name</label>
                                    <input type="text" class="form-control" id="student-fname">
                                </div>
                                <div class="form-group">
                                    <label for="mnameStudent">Middle Name</label>
                                    <input type="text" class="form-control" id="student-mname">
                                </div>
                                <div class="form-group">
                                    <label for="lnameStudent">Last Name</label>
                                    <input type="text" class="form-control" id="student-lname">
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
                                <button id="add-student" type="submit" class="btn btn-primary">Add Student</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
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
                                    <input type="text" class="form-control" id="student-fname">
                                </div>
                                <div class="form-group">
                                    <label for="mnameStudent">Middle Name</label>
                                    <input type="text" class="form-control" id="student-mname">
                                </div>
                                <div class="form-group">
                                    <label for="lnameStudent">Last Name</label>
                                    <input type="text" class="form-control" id="student-lname">
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
                                <button id="edit-student" type="submit" class="btn btn-primary">Edit Student</button>
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
                                        <a id="student-qrcode-print" hidden>Print</a>
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
                            </div>
                    </form>
                    </div>
                </div>
            </div>
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
        <!-- /Modal -->


        <!-- Bootstrap core JavaScript--> 
        <script src="<?php echo base_url() ;?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url() ;?>assets/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 

        <script type="text/javascript">

            $(document).ready( function () {
                $('#enrolled_students_table').DataTable(
                    {
                        "order": [[ 0, "desc" ]],
                        responsive: true
                    }
                );
                $('#section_table').DataTable(
                    {
                        "order": [[ 0, "desc" ]],
                        responsive: true
                    }
                );
                $('#student_table').DataTable(
                    {
                        "order": [[ 0, "desc" ]],
                        responsive: true
                    }
                );
            } );

            //Button Clicks
            $('.student_view_details').click(function() {
                var studentId=$(this).closest("tr").find("td:eq(0)").text(); // get current row 1st 
                //TD value 
                location.href = "<?php echo base_url(); ?>dashboard/students/" + studentId;
            });
            $('.section_view_details').click(function() {
                var sectionId=$(this).closest("tr").find("td:eq(0)").text(); // get current row 1st 
                //TD value 
                location.href = "<?php echo base_url(); ?>dashboard/sections/" + sectionId;
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
                        $('#student-qrcode-print').removeAttr('hidden');
                    }
                });
                return false;
            });

            /* ADD STUDENT AJAX */
            $('#add-student').click(function() {
                var form_data = {
                    fname: $('#student-fname').val(),
                    mname: $('#student-mname').val(),
                    lname: $('#student-lname').val(),
                    section_id: $('#section-id').val(),
                };
                $.ajax({
                    url: "<?php echo site_url('students/new'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(msg) {
                        if (msg == 'Success') {
                            $('#student-alert-msg').html('<div class="alert alert-success text-center">New Student Added Successfully!</div>');
                            //Clear Form
                            $('#student-fname').val('');
                            $('#student-mname').val('');
                            $('#student-lname').val('');
                            $('#section-id').val(0);

                            setTimeout(function(){// wait for 2 secs
                                location.reload(); // then reload the page.
                            }, 2000); 
                        } else if (msg == 'Error') {
                            $('#student-alert-msg').html('<div class="alert alert-danger text-center">Error in adding student! Please try again later.</div>');
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
            /* ADD SECTION AJAX */
            $('#add-section').click(function() {
                var form_data = {
                    section: $('#text_section').val(),
                    school_year: $('#text_schoolYear').val(),
                };
                $.ajax({
                    url: "<?php echo site_url('sections/new'); ?>",
                    type: 'POST',
                    data: form_data,
                    success: function(msg) {
                        if (msg == 'Success') {
                            $('#section-alert-msg').html('<div class="alert alert-success text-center">New Section Added Successfully!</div>');
                            //Clear Form
                            $('#text_section').val('');
                            $('#text_schoolYear').val('Select School Year');
                            setTimeout(function(){// wait for 2 secs
                                location.reload(); // then reload the page.
                            }, 2000); 
                        } else if (msg == 'Error') {
                            $('#section-alert-msg').html('<div class="alert alert-danger text-center">Error in adding section! Please try again later.</div>');
                            //Clear Form
                            $('#text_section').val('');
                            $('#text_schoolYear').val('Select School Year');
                        } else {
                            $('#section-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                        }
                    }
                });
                return false;
            });

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
                            }, 2000); 
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
    </body>
</html>