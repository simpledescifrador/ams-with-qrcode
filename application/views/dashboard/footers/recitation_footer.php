<!-- Add Recitation Modal -->
<div class="modal fade" id="add-recitation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Add Recitation</h4>
      </div>
      <div id="add-recitation-alert-msg"></div>
      <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="text_studentIde">Student ID:</label>
                    <input id="text_studentId" type="text" class="form-control" name="text_studentId" placeholder="Enter student ID">
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                        <div class='input-group date default-date-picker' id='add-recitation-dp'>
                            <input type='text' class="form-control" readonly id="add-recitation-date" value="<?php echo date("D, M d, Y h:i A", strtotime(date('y-m-d h:i:s'))); ?>">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add-recitation-btn" type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Attendance Modal -->
<div class="modal fade" id="edit-recitation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Recitation</h4>
      </div>
      <div id="edit-recitation-alert-msg"></div>
      <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="edit-student-name">Student Name</label>
                        <input type="text" class="form-control" id="edit-student-name" readonly />
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                        <div class='input-group date default-date-picker' id='edit-recitation-dp'>
                            <input type='text' class="form-control" readonly id="edit-date"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                </div>
            </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="edit-recitation-btn" type="button" class="btn btn-warning">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Attendance Modal -->
<div class="modal fade" id="delete-recitation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        <label>Are you sure you wanna delete this selected recitation?</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button id="delete-btn" type="button" class="btn btn-danger">Yes</button>
      </div>
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
      <div id="generate-report-alert-msg"></div>
      <div class="modal-body">
            <form id="generate-report-form" method="get" action="<?php echo site_url("dashboard/generate/recitation"); ?>">
            <div class="form-group">
                    <label for="section-id">Report Type</label>
                    <select class="form-control" id="report-type" name="report">
                            <option value="0">Select Report Type</option>
                            <option value="1">Student Recitation Report</option>
                            <option value="2">Section Recitation Report</option>
                    </select>
            </div>

            <div class="form-group report student-report section-report hide">
                <label for="report-section-id">Section</label>
                    <select class="form-control" id="report-section-id" name="section">
                    <option value="0">Select Section</option>
                            <?php foreach ($sections as $value) {
                                echo "<option value='{$value['section_id']}'>{$value['name']}</option>";
                            }
                            ?>
                    </select>
            </div>
            <div class="form-group report student-report hide">
                <label bel for="report-student-id">Student</label>
                    <select class="form-control" id="report-student-id" name="student">
                    <option value="0">Select Student</option>
                    </select>
            </div>
            <div class="form-group report-date-range-fg report student-report section-report hide">
              <label for="report-date-range">Date Range</label>
              <input type="text" class="form-control" id="report-date-range" placeholder="Date Range" name="date">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="view-attendance-btn" type="submit" class="btn btn-success">Submit</button>
      </div>
      </form> 
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>vendor/components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">

$(document).ready( function () {
    var recentRecitationTable = $('#recent_recitation_table').DataTable(
        {
            "order": [[ 0, "desc" ]],
            responsive: true,
            paging: false,
            "searching": false,
            "columnDefs": [
                {"className": "text-center", "targets": 0},
                { "width": "5%", "targets": 0 },
                { "width": "25%", "targets": 3 },
            ]
        }
    );

    var recitationRecordsTable = $('#recitation_records_table').DataTable(
        {
            "order": [[ 0, "desc" ]],
            responsive: true,
            "columnDefs": [
                {"className": "text-center", "targets": 0},
                { "width": "5%", "targets": 0 },
                { "width": "15%", "targets": 4 },
            ],
            "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "iDisplayLength": 5
        }
    );

    //get Selected row id
    $('#recitation_records_table tbody').on( 'click', 'tr', function () {
        var selectedRow = recitationRecordsTable.row( this ).data();
        $("#selected-id").val(selectedRow[0]);
        $("#edit-date").val(selectedRow[1]);
        $("#edit-student-name").val(selectedRow[2]);
    } );
} );

    //Add Recitation
    $("#add-recitation-btn").click(function(e) {
        e.preventDefault();
        var form_data = {
            student_id: $("#text_studentId").val(),   
            date: $("#add-recitation-date").val()      
        };

        $.ajax({
            url: "<?php echo site_url("recitations/new"); ?>",
            type: 'POST',
            data: form_data,
            success: function(msg) {
                if (msg == 'Success') {
                    $('#add-recitation-alert-msg').html('<div class="alert alert-success text-center">Recitation Added Successfully!</div>');
                    //Clear Form
                    setTimeout(function(){// wait for 1 secs
                        location.reload(); // then reload the page.
                    }, 1000); 
                } else if (msg == 'Error') {
                    $('#add-recitation-alert-msg').html('<div class="alert alert-danger text-center">Error in adding new recitation! Please try again later.</div>');
                } else {
                    $('#add-recitation-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });            

        return false;        
    });

     //Edit Recitation
     $("#edit-recitation-btn").click(function(e) {
        e.preventDefault();
        var recitationId = $("#selected-id").val();
        var form_data = {
            date: $('#edit-date').val()
        };
        
        $.ajax({
            url:  "<?php echo base_url(); ?>recitations/" + recitationId + "/edit",
            type: 'POST',
            data: form_data,
            success: function(msg) {
                if (msg == 'Success') {
                    $('#edit-recitation-alert-msg').html('<div class="alert alert-success text-center">Recitation Edited Successfully!</div>');
                    setTimeout(function(){// wait for 1 secs
                        location.reload(); // then reload the page.
                    }, 1000); 
                } else if (msg == 'Error') {
                    $('#edit-recitation-alert-msg').html('<div class="alert alert-danger text-center">Error in editing recitation! Please try again later.</div>');
                } else {
                    $('#edit-recitation-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            }
        });
        return false;
    });

    //Delete Attendance
    $("#delete-btn").click(function(e) {
        e.preventDefault();
        var recitationId = $("#selected-id").val();
        $.ajax({
            url: "<?php echo base_url(); ?>recitations/" + recitationId + "/delete",
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

    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#report-date-range').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#report-date-range').daterangepicker({
        locale: {
              format: 'YYYY/MM/DD'
        },
        applyButtonClasses: 'btn btn-success',
        cancelButtonClasses: 'btn btn-danger',
        opens: 'right',
        drops: 'down',
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    /* Get Section Students */
    $('#report-section-id').on('change', function(e) {
      var sectionId = this.value;

      if (sectionId != 0) {
        $.ajax({
          url: "<?php echo base_url(); ?>sections/" + sectionId + "/students",
          method: "GET",
          success: function(data) {
            $('#report-student-id').empty().append("<option value='0'>Select Student</option>");
            $.each(JSON.parse(data), function(index, element) {
              $('#report-student-id').append("<option value=" + element.id + ">" + element.name + "</option>");
            });
          }
        });
      }
    });

    $('#report-type').on('change', function(e) {
      var reportType = this.value;
      if (reportType == 1) {
        $('.report').addClass('hide');
        $('.student-report').removeClass('hide');
      } else if (reportType == 2) {
        $('.report').addClass('hide');
        $('.section-report').removeClass('hide');
      } else {
        $('.report').addClass('hide');
      }
    });

    $("#generate-report-form").submit(function(e) {
      var reportType = $('#report-type').val();

      if (reportType == 0) {
        e.preventDefault();
        var msg = "Select Report Type";
        $('#generate-report-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
      } else {
        $('#generate-report-alert-msg').html('');
        
        if (reportType == 1) {/* Student Report */
          $("#report-student-id").attr("name", "student");
          var sectionId = $("#report-section-id").val();
          var studentId = $("#report-student-id").val();
          if (sectionId == 0) {
            e.preventDefault();
            var msg = "Select Section";
            $('#generate-report-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
          } else if (studentId == 0) {
            e.preventDefault();
            var msg = "Select Student";
            $('#generate-report-alert-msg').html('<div class="alert alert-danger">' + msg + '</div>');
          } else {
            $('#generate-report-alert-msg').html('');
          }
        } else {/* Section Report */
          $("#report-student-id").removeAttr('name');
        }

      }
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