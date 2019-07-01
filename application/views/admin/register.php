<!DOCTYPE html>
<html lang="en">
  	<head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/primary.css">
	    <title>Attendance Monitoring</title>
  	</head>
  	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 visible-md visible-lg"></div>
				<div class="col-md-4">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
					<form class="form-container-li" action="" method="POST"> 
						<img class="center-block" src="<?php echo base_url(); ?>assets/icons/icons8_school_120px.png">
						
						<div class="">
						    <label class="black-text" for="txt_username">Username</label><br>
						    <div class="input-group">
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						    	<input type="text" class="form-control" id="username" name="username">	
						    </div>
						</div>

						<div class="form-group ">
						    <label class="black-text" for="txt_password">Password</label><br>
						    <div class="input-group">
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						    	<input type="password" class="form-control" id="password" name="password">
						    </div>
						</div>
                        <div class="form-group ">
						    <label class="black-text" for="txt_repeatPassword">Repeat Password</label><br>
						    <div class="input-group">
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						    	<input type="password" class="form-control" id="repeat" name="repeat">
						    </div>
						</div>
                        <div>
                            <button id="register" name="register" type="button" class="btn btn-default btn-block btn-gradient">Sign up</button>
                            <button id="cancel" type="button" class="btn btn-link btn-block white-text">Cancel</button></div>
					</form>
				</div>
			</div>
		</div>
	    <!-- Bootstrap JS -->
	    <script src="<?php echo base_url(); ?>vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>  
  	</body>
</html>