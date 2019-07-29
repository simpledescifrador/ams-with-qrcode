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
            <div class="col-md-11">
                <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard <Small>Home</Small></h1>
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
                <div class="well"> 
                    <h4>Current Time</h4> 
                    <strong><h2 class="live-time"><</h2></strong>
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
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> <?php echo $section_count; ?> </h2>
                                    <h4>Sections</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $student_count; ?> </h2>
                                    <h4>Students</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 0 </h2>
                                    <h4>Label</h4>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="well dash-box">
                                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 0 </h2>
                                    <h4>Label</h4>
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
                    </div>
                    <div class="panel-footer"><small>Generated as of <?php  echo date('h:i:s A'); ?></small></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Top 5 Present</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Date</th>
                                        <th>Present</th>
                                        <th>Late</th>
                                        <th>Absent</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Top 5 Tardy</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Date</th>
                                        <th>Present</th>
                                        <th>Late</th>
                                        <th>Absent</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Overview -->
        </div>
    </div>
</section>
<!-- /Main -->