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
                        <li class="active"><a href="<?php echo base_url() ;?>dashboard/student">Students</a></li>
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
                        <h2><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard <Small>Student's Profile</Small></h1>
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
                    <li><a href="<?php echo base_url(); ?>dashboard/student">Students</a></li>
                    <li class="active">Profile</li>
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
                            <a href="<?php echo base_url(); ?>dashboard/student" class="list-group-item active main-color-bg">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                                    Students <small><i> -  Profile</i></small>
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
                                <a href="#" class="list-group-item" data-toggle="modal"  data-target="#student-qrcode-modal">
                                    <span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span>
                                     Generate Qr Code
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a id="edit-student-anchor" href="#" class="list-group-item" data-toggle="modal"  data-target="#edit-student-modal">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                     Edit
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="list-group-item" data-toggle="modal"  data-target="#remove-student-modal">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                     Remove
                                </a>
                            </div>
                        </div>
                        <br /><hr />
                        <div class="row">
                            <div class="col-md-4">
                                <?php if(!empty($student_details['profile_image_url'])):?>
                                    <img src="<?php echo $student_details['profile_image_url']; ?>" class="img-responsive img-rounded" alt="profile picture">
                                <?php else: ?>
                                    <img src="<?php echo base_url(); ?>assets/images/student_profile_placeholder.png" class="img-responsive img-rounded" alt="profile picture">
                                <?php endif; ?>

                            </div>
                            <div class="col-md-8"><br />
                                <div class="form-group">
                                    <label for="student-id">Student ID</label>
                                    <input type="text" class="form-control" id="student-id" placeholder="ABC123..." readonly value="<?php echo $student_details['student_id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="student-name">Student Name</label>
                                    <input type="text" class="form-control" id="student-name" placeholder="Name..." readonly value="<?php echo $student_details['student_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="student-section">Section</label>
                                    <input type="text" class="form-control" id="student-section" placeholder="Section..." readonly value="<?php echo $student_details['section']['name']; ?>">
                                </div>
                            </div>
                        </div><br /><hr />
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Attendance Record</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>Date</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Recitation Record</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th>Date</th>
                                                <th>Recitation</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- /Overview -->
                </div>
            </div>
        </section>
        <!-- /Main -->
                    