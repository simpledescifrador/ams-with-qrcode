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
                        <li class="active"><a href="<?php echo base_url() ;?>dashboard/section">Sections</a></li>
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
                        <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard <Small>Section Details</Small></h1>
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
                    <li><a href="<?php echo base_url(); ?>dashboard/section">Sections</a></li>
                    <li class="active">Details</li>
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
                            <a href="<?php echo base_url(); ?>dashboard/section" class="list-group-item  active main-color-bg">
                                <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> 
                                    Sections <small> -  Details</small>
                            </a>
                            <a href="<?php echo base_url(); ?>dashboard/student" class="list-group-item">
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
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <a id="generate-section-qrcode-anchor" class="list-group-item" data-toggle="modal"  data-target="#section-qrcode-modal">
                                    <span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span>
                                     Print QR Code's
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a id="edit_section_anchor" href="#" class="list-group-item" data-toggle="modal"  data-target="#edit-section-modal">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                     Edit
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="list-group-item" data-toggle="modal"  data-target="#remove-section-modal">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                     Remove
                                </a>
                            </div>
                        </div>
                        <br /><hr />
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section-id">Section ID</label>
                                    <input type="text" class="form-control" id="section-id" placeholder="ABC123..." readonly value="<?php echo $section_details['section_id']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="section-name">Section</label>
                                    <input type="text" class="form-control" id="section-name" placeholder="Name..." readonly value="<?php echo $section_details['section']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="school-year">School Year</label>
                                    <input type="text" class="form-control" id="school-year" placeholder="0000 - 0000..." readonly value="<?php echo $section_details['school_year']?>">
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Students Enrolled</h3>
                            </div>
                            <div class="panel-body">
                                <table id="enrolled_students_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>M.I.</th>
                                            <th>Last Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($enrolled_students as $rows): ?>
                                            <tr>
                                                <td><?php echo $rows['student_id'];?></td>
                                                <td><?php echo $rows['first_name']; ?></td>
                                                <td><?php echo substr($rows['middle_name'], 0, 1); ?></td>
                                                <td><?php echo $rows['last_name']; ?></td>
                                                <td><button type="button" class="btn btn-sm main-color-bg student_view_details" >View Details</button></td>
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
                    