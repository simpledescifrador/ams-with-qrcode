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
                        <li><a href="<?php echo base_url() ;?>dashboard/attendance">Attendance</a></li> 
                        <li class="active"><a href="<?php echo base_url() ;?>dashboard/recitation">Recitation</a></li> 
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
                        <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard <Small><?php echo $sub_title; ?></Small></h1>
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
                    <li>Recitation</li>
                    <li class="active"><?php echo $sub_title; ?></li>
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
                            <a href="<?php echo base_url() ;?>dashboard/attendance" class="list-group-item">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
                                    Attendance  
                            </a>
                            <a href="<?php echo base_url() ;?>dashboard/recitation" class="list-group-item active main-color-bg">
                                <span class="glyphicon glyphicon-education" aria-hidden="true"></span> 
                                    Recitation <small> -  <?php echo $sub_title; ?></small>
                            </a>
                        </div>
                    </div>
                    <!-- /Sdie Nav -->
                    <!-- Overview -->
                    <?php if ($report_type == 1) : ?>
                        <div class="col-md-9">
                            <h3><?php echo $heading; ?></h3>
                            <hr>
                            <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recitation Report<span style="display: block;float: right;"><b>Date: </b></b><?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?></span></h3>
                            </div>
                            <div class="panel-body">
                                <div id="buttons1" ><b>Export: </b></div><br>
                                <table id="s_recitation_report_table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>No. of Recitations</th>
                                            </tr>
                                        </thead>
                                        <?php if (!empty($s_recitation_data)) : ?>
                                            <tfoot style="background: lightblue;">
                                                <tr>
                                                    <td></td>
                                                    <td align="right"><b>Total:</b></td>
                                                    <td><?php echo $total_recitations; ?></td>
                                                </tr>
                                            </tfoot>
                                        <?php endif; ?>
                                        <tbody>
                                            <?php foreach ($s_recitation_data as $index => $rows) : ?>
                                                <tr>
                                                    <td><?php echo $index+1; ?></td>
                                                    <td><?php echo $rows['date']; ?></td>
                                                    <td><?php echo $rows['recitations']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                            </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-md-9">
                            <h3><?php echo $heading; ?></h3>
                            <hr>
                            <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Recitation Report<span style="display: block;float: right;"><b>Date: </b></b><?php echo date('F j, Y', strtotime($date_range[0])); ?> to <?php echo date('F j, Y', strtotime($date_range[1])); ?></span></h3>
                            </div>
                            <div class="panel-body">
                                <div id="buttons" ><b>Export: </b></div><br>
                                <table id="recitation_report_table" class="table table-striped table-bordered" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>No. of Recitations</th>
                                            </tr>
                                        </thead>
                                        <?php if (!empty($recitation_data)) : ?>
                                            <tfoot style="background: lightblue;">
                                                <tr>
                                                    <td></td>
                                                    <td align="right"><b>Total:</b></td>
                                                    <td><?php echo $total_recitations; ?></td>
                                                </tr>
                                            </tfoot>
                                        <?php endif; ?>
                                        <tbody>
                                            <?php foreach ($recitation_data as $index => $rows) : ?>
                                                <tr>
                                                    <td><?php echo $index+1; ?></td>
                                                    <td><?php echo $rows['student_name']; ?></td>
                                                    <td><?php echo $rows['recitations']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                            </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- /Overview -->
                </div>
            </div>
        </section>
        <!-- /Main -->