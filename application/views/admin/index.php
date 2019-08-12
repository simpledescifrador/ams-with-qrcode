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
		<?php echo link_tag('favicon.png', 'shortcut icon', 'image/png'); ?>
	    <title><?php echo $title; ?></title>
  	</head>
  	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 visible-md visible-lg"></div>
				<div class="col-md-4">
					<?php echo form_open('login/auth', array('class' => 'form-container-li')); ?> 
						<img class="center-text" src="<?php echo base_url();?>assets/images/logo.png" alt="logo" width="100px" height="100px" />
						<h4 align="center">Login</h4>

						<!-- Display Login Form Validation Alert -->
						<?php if($this->session->flashdata('validate_msg') != null): ?>
							<div class="alert alert-dismissible alert-danger" role="alert">
								<span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
								<small><?php echo $this->session->flashdata('validate_msg'); ?></small>
							</div>
						<?php endif; ?>

						<!-- Display Login Auth Error Alert -->
						<?php if($this->session->flashdata('error_msg') != null): ?>
							<div class="alert alert-dismissible alert-danger" role="alert">
								<span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
						  		<small><?php echo $this->session->flashdata('error_msg'); ?></small>
						  	</div>
						<?php endif; ?>

						<div class="">
						    <label class="black-text" for="txt_username">Username</label><br>
						    	<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">	
						</div>
						<div class="form-group" style="margin-top:5px;">
						    <label class="black-text" for="txt_password">Password</label><br>
						    	<input type="password" class="form-control" id="txt_password" name="password" placeholder="Enter your password" data-toggle="password">
						</div>
						<button id="login" type="submit" class="btn btn-primary btn-block btn-gradient">Sign in</button>
					<?php echo form_close(); ?>  <!-- End of Form -->
				</div>
			</div>
		</div>
		<!-- Bootstrap core JavaScript--> 
		<script src="<?php echo base_url() ;?>assets/js/jquery.min.js"></script>
	    <!-- Bootstrap JS -->
		<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>  
		
		<!-- Bootstrap Show Password -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-show-password.js"></script>  
	    <script type="text/javascript">
		   	document.getElementById("forgotPassword").onclick = function() {
		        location.href = "<?php echo base_url(); ?>forgot";
		    };
		    // document.getElementById("login").onclick = function(){
		    // 	location.href = "<?php echo base_url() ;?>login/auth";
			// }
			$("#txt_password").password('toggle');
		</script>
  	</body>
</html>