<!-- Navgation Bar -->
<nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    <a class="navbar-brand" href="#">Attendance Monitoring</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url() ;?>dashboard">Home</a></li>
                        <li><a href="<?php echo base_url() ;?>dashboard/section">Sections</a></li>
                        <li><a href="<?php echo base_url() ;?>dashboard/student">Students</a></li>
                        <li class="active"><a href="<?php echo base_url() ;?>dashboard/attendance">Attendance</a></li> 
                        <li><a href="<?php echo base_url() ;?>dashboard/recitation">Recitation</a></li> 
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Welcome <?php echo $username; ?>!</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /Navgation Bar -->
        <!-- Header -->
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-11">
                        <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard <Small>Attendance Record</Small></h1>
                    </div>
                    <div class="col-md-1">
                        <div class="dropdown settings">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-cog" aria-hidden="true">  <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="" data-toggle="modal"  data-target="#password-change-modal">Change Password</a></li>
                                <li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->
        <!-- Breadcrumb -->
        <section id="breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                    <li>Attendance</li>
                    <li class="active">View</li>
                </ol>
            </div>
        </section>
        <!-- /Breadcrumb -->
        <!-- Main -->
        <section id="main">
            <div class="container">
                <div class="row">
                    <!-- Side Nav -->
                    <div class="col-md-3">
                        <div class="list-group">
                            <a href="<?php echo base_url(); ?>dashboard" class="list-group-item">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> 
                                    Home
                            </a>
                            <a href="<?php echo base_url(); ?>dashboard/section" class="list-group-item">
                                <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> 
                                    Sections
                            </a>
                            <a href="<?php echo base_url(); ?>dashboard/student" class="list-group-item">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                                    Students
                            </a>
                            <a href="<?php echo base_url() ;?>dashboard/attendance" class="list-group-item active main-color-bg">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
                                    Attendance  <small> -  View</small>
                            </a>
                            <a href="<?php echo base_url() ;?>dashboard/recitation" class="list-group-item">
                                <span class="glyphicon glyphicon-education" aria-hidden="true"></span> 
                                    Recitation
                            </a>
                        </div>
                    </div>
                    <!-- /Sdie Nav -->
                    <!-- Overview -->
                    <div class="col-md-9">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left"><?php echo $panel_title; ?></h3>
                                <h3 class="panel-title pull-right"><?php echo date_format(date_create($attendance_date), "D, M d, Y"); ?></h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <input type="text" class="hidden" id="selected-id">
                                <input type="text" class="hidden" id="student-id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="mark-attendance-form" class="form-inline" method="post" action="">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mark All No Attendance As: </label>
                                                    <select class="form-control" name="remark" id="selected-remark">
                                                        <option>Select Remark</option>
                                                        <option value="Present">Present</option>
                                                        <option value="Tardy">Tardy</option>
                                                        <option value="Excused">Excused</option>
                                                        <option value="Unexcused">Unexcused</option>
                                                    </select>
                                                    </select>
                                            </div>
                                            &nbsp&nbsp
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <span id="mark-attendance-form-status" class="text-danger hide">&nbsp&nbsp*Please select a remark before clicking submit</span>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <table id="view_attendance_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Attendance ID</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($attendance as $rows) : ?>
                                            <tr>
                                                <td><?php echo $rows['student_id']; ?></td>
                                                <td><?php echo $rows['student_name']; ?></td>
                                                <td><?php echo $rows['attendance_id']; ?></td>
                                                <td>
                                                    <?php 
                                                        switch ($rows['remark']) {
                                                            case "Tardy":
                                                                echo "<span class='label label-warning'>Tardy</span>";
                                                                break;
                                                            case "Unexcused":
                                                                echo "<span class='label label-danger'>Unexcused</span>";
                                                                break;
                                                            case "Excused":
                                                                echo "<span class='label label-primary'>Excused</span>";
                                                                break;
                                                            case "Present":
                                                                echo "<span class='label label-success'>Present</span>";
                                                                break;
                                                            default:
                                                                echo "<span class='label label-default'>No Attendance</span>";
                                                                break;
                                                        }
                                                    ?>
                                                </td>
                                                <?php if ($rows['remark'] === null) : ?>
                                                <td><div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="modal" data-target="#add-attendance-modal">
                                                            <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                                        </button>
                                                    </div></td>
                                                <?php else : ?>
                                                    <td><div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-warning" aria-label="Left Align" data-toggle="modal" data-target="#edit-attendance-modal">
                                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                        </button>
                                                        <button id="delete-action" type="button" class="btn btn-danger" aria-label="Right Align" data-toggle="modal" data-target="#delete-attendance-modal">
                                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                        </button>
                                                    </div></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Overview -->
                </div>
            </div>
        </section>
        <!-- /Main -->