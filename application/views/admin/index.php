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
	    <title><?php echo $title; ?></title>
  	</head>
  	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2 visible-md visible-lg"></div>
				<div class="col-md-4">
					<?php echo form_open('login/auth', array('class' => 'form-container-li')); ?> 
						<img class="center-block" src="<?php echo base_url(); ?>assets/icons/icons8_school_120px.png">
						<p class="para-title">Attendance</p>
						<hr class="line-title">
						<p class="para-subtitle">Monitoring</p>

						<!-- Display Login Form Validation Alert -->
						<?php if($this->session->flashdata('validate_msg') != null): ?>
							<div class="alert alert-dismissible alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<small><?php echo $this->session->flashdata('validate_msg'); ?>
							</div>
						<?php endif; ?>

						<!-- Display Login Auth Error Alert -->
						<?php if($this->session->flashdata('error_msg') != null): ?>
							<div class="alert alert-dismissible alert-danger">
  								<button type="submit" class="close" data-dismiss="alert">&times;</button>
						  		<?php echo $this->session->flashdata('error_msg'); ?></small>
						  	</div>
						<?php endif; ?>

						<div class="">
						    <label class="black-text" for="txt_username">Username</label><br>
						    <div class="input-group">
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						    	<input type="text" class="form-control" id="username" name="username">	
						    </div>
						</div>
						<div class="form-group">
						    <label class="black-text"for="txt_password">Password</label><br>
						    <div class="input-group">
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						    	<input type="password" class="form-control" id="txt_password" name="password">
						    </div>
						</div>
						<button id="login" type="submit" class="btn btn-default btn-block btn-gradient">Sign in</button>

						<button id="forgotPassword" type="button" class="btn btn-link btn-block white-text">Forgot Password?</button>
					<?php echo form_close(); ?>  <!-- End of Form -->
				</div>
			</div>
		</div>
	    <!-- Bootstrap JS -->
	    <script src="<?php echo base_url(); ?>vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>  
	    <script type="text/javascript">
		   	document.getElementById("forgotPassword").onclick = function() {
		        location.href = "<?php echo base_url(); ?>forgot";
		    };
		    // document.getElementById("login").onclick = function(){
		    // 	location.href = "<?php echo base_url() ;?>login/auth";
		    // }
		</script>
  	</body>
</html>