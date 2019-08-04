
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

<script src="<?php echo base_url() ;?>assets/js/dashboard/section.js"></script>

<script type="text/javascript">
    $('.section_view_details').click(function() {
        var sectionId=$(this).closest("tr").find("td:eq(0)").text(); // get current row 1st 
        //TD value 
        location.href = "<?php echo base_url(); ?>dashboard/sections/" + sectionId;
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
                }, 1000); 
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
</script>
