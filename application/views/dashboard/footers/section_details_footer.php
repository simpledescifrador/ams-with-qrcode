<!-- Edit Section  -->
<div class="modal fade" id="edit-section-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Section</h4>
                </div>
                <div id="section-alert-msg"></div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="section-name">Name</label>
                        <input type="text" class="form-control" id="text_section" name="section" value="<?php echo $section_details['section']; ?>">
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
                    <button id="edit-section" type="button" class="btn btn-primary" >Edit Section</button>
                </div>
            </div>
        </form>
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
                    <button id="remove-section" type="button" class="btn btn-primary">Yes</button>
                </div>
        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#enrolled_students_table').DataTable(
            {
                responsive: true
            }
        );
    } );

    //Student View Details onClick
    $('.student_view_details').click(function() {
        var studentId=$(this).closest("tr").find("td:eq(0)").text(); // get current row 1st 
        //TD value 
        location.href = "<?php echo base_url(); ?>dashboard/students/" + studentId;
    });
    
    $('#edit_section_anchor').click(function() {
        var schoolYearValue = "<?php echo $section_details['school_year']; ?>";
        $('#text_schoolYear').val(schoolYearValue);        
    });
    
    $('#generate-section-qrcode-anchor').click(function() {
        var sectionId = "<?php echo $section_details['section_id']; ?>";
        window.open("<?php echo base_url(); ?>generate/section/qrcode/" + sectionId);
    });

    //Edit Section
    $('#edit-section').click(function() {
        var form_data = {
            section: $('#text_section').val(),
            school_year: $('#text_schoolYear').val(),
        };
        $.ajax({
            url: "<?php echo site_url("sections/" . $section_details['section_id'] . "/edit"); ?>",
            type: 'POST',
            data: form_data,
            success: function(msg) {
                console.log(msg);
                if (msg == 'Success') {
                $('#section-alert-msg').html('<div class="alert alert-success text-center">Section Edited Successfully!</div>');
                //Clear Form
                $('#text_section').val('');
                $('#text_schoolYear').val('Select School Year');
                setTimeout(function(){// wait for 1 secs
                    location.reload(); // then reload the page.
                }, 1000); 
            } else if (msg == 'Error') {
                $('#section-alert-msg').html('<div class="alert alert-danger text-center">Error in editing section! Please try again later.</div>');
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

    //Remove Section
    $('#remove-section').click(function() {
        $.ajax({
            url: "<?php echo site_url("sections/" . $section_details['section_id'] . "/delete"); ?>",
            type: 'PUT',
            success: function(msg) {
                if (msg == 'Success') {
                    alert('Successful Deleted!');
                    setTimeout(function(){// wait for 1 secs
                        location.href = "<?php echo base_url(); ?>dashboard/section";
                }, 1000); 
                } else {
                    alert('Error Occurred! Failed to delete');
                }
            }
        });
        return ;
    });
</script>