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
                <div class="col-md-5">
                        <h2>Dashboard <Small>Attendance Records</Small></h2>
                    </div>
                    <div class="col-md-6">
                        <h1 class="live-time"></h1>
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
                    <li class="active">Attendance</li>
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
                                    Attendance
                            </a>
                            <a href="<?php echo base_url() ;?>dashboard/recitation" class="list-group-item">
                                <span class="glyphicon glyphicon-education" aria-hidden="true"></span> 
                                    Recitation
                            </a>
                        </div>
                    </div>
                    <!-- /Sdie Nav -->
                    <!-- Overview -->
                    <div>
                        <div class="col-md-2">
                            <a href="#" class="list-group-item success-btn" data-toggle="modal"  data-target="#view-attendance-modal">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                 View Attendance
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="list-group-item main-color-bg" data-toggle="modal"  data-target="#generate-report-modal">
                                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                 Generate Report
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9"><br/> 
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recently Added Attendance <small>(Last 5 records)</small></h3>
                            </div>
                            <div class="panel-body">
                                <table id="recent_attendance_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Date & Time</th>
                                            <th>Name</th>
                                            <th>Section</th>
                                            <th>Remarks</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($recent_attendance_records as $rows): ?>
                                            <tr>
                                                <td><?php echo $rows['id']; ?></td>
                                                <td><?php echo date_format(date_create($rows['date']), "D, M d, Y h:i A");?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['section']; ?></td>
                                                <td>
                                                    <?php 
                                                        switch ($rows['remarks']) {
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
                                                        }
                                                    ?>
                                                </td> 
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        


                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Attendance Records</h4>
                                <div class="btn-group pull-right">
                                <a class="btn btn-success outline" data-toggle="modal" data-target="#add-attendance-modal">Add Attendance</a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <input type="text" class="hidden" id="selected-id">
                                <input type="text" class="hidden" id="student-id">
                                <table id="attendance_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Date & Time</th>
                                            <th>Name</th>
                                            <th>Section</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($attendance_records as $rows) : ?>
                                            <tr>
                                                <td><?php echo $rows['id']; ?></td>
                                                <td><?php echo date_format(date_create($rows['date']), "D, M d, Y h:i A");?></td>
                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['section']; ?></td>
                                                <td>
                                                    <?php 
                                                        switch ($rows['remarks']) {
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
                                                        }
                                                    ?>
                                                </td>                                                
                                                <td><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-warning" aria-label="Left Align" data-toggle="modal" data-target="#edit-attendance-modal">
                                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                                    </button>
                                                    <button id="delete-action" type="button" class="btn btn-danger" aria-label="Right Align" data-toggle="modal" data-target="#delete-attendance-modal">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    </button>
                                                </div></td>
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