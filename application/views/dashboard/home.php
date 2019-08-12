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
                <li class="active"><a href="<?php echo base_url() ;?>dashboard">Home</a></li>
                <li><a href="<?php echo base_url() ;?>dashboard/section">Sections</a></li>
                <li><a href="<?php echo base_url() ;?>dashboard/student">Students</a></li>
                <li><a href="<?php echo base_url() ;?>dashboard/attendance">Attendance</a></li> 
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
                <h2>Dashboard <Small>Home</Small></h2>
            </div>
            <div class="col-md-6">
                <h1 class="live-time"></h1>
            </div>
            <div class="col-md-1">
                <div class="dropdown settings">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-cog" aria-hidden="true">  <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <!-- <li><a href="" data-toggle="modal"  data-target="#edit-informatoin-modal">Edit Inforation</a></li> -->
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
            <li class="active">Dashboard</li>
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
                    <a href="<?php echo base_url() ;?>dashboard" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> 
                            Home
                    </a>
                    <a href="<?php echo base_url() ;?>dashboard/section" class="list-group-item">
                        <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> 
                            Sections
                    </a>
                    <a href="<?php echo base_url() ;?>dashboard/student" class="list-group-item">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                            Students
                    </a>
                    <a href="<?php echo base_url() ;?>dashboard/attendance" class="list-group-item">
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
            <div class="col-md-9">
                <div class="panel panel-default">
                        <div class="panel-heading  main-color-bg">
                            <h3 class="panel-title">Overview</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> <?php echo $section_count; ?> </h2>
                                    <h4>Total Number of Sections</h4>
                                    <p><a href="<?php echo site_url('dashboard/section'); ?>">View All Sections</a></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $student_count; ?> </h2>
                                    <h4>Total Number of Students</h4>
                                    <p><a href="<?php echo site_url('dashboard/student'); ?>">View All Students</a></p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Analytics</h3>
                    </div>
                    <div class="panel-body">
                        <div class="chart-container">
                            <canvas id="attendance-chartcanvas"></canvas>
                        </div>
                        <p><i><b>Note:</b> Late is equal to tardy & Absent are equals to excused and unexcused</i></p>
                    </div>
                    <div class="panel-footer"><small>Updated as of <?php  echo date('h:i:s A'); ?></small></div>
                </div>
<!--                 <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Top 5 Performing Section</h4>
                                <div class="btn-group pull-right">
                                    <div class="btn-group input-group-sm display-option">
                                        <span class="btn btn-default btn-sm active">This Month</span>
                                        <span class="btn btn-default btn-sm">This Year</span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Section</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Most Punctual Students</h4>
                                <div class="btn-group pull-right">
                                    <div class="btn-group input-group-sm display-option">
                                        <span class="btn btn-default btn-sm active">This Month</span>
                                        <span class="btn btn-default btn-sm">This Year</span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th># of Late</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- /Overview -->
        </div>
    </div>
</section>
<!-- /Main -->