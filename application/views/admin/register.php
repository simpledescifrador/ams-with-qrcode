
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 visible-md visible-lg"></div>
		<div class="col-md-4">
			<form class="form-container-li" action="<?php echo site_url('register/auth'); ?>" method="POST"> 
				<h3><center>Registration</center></h3>
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
				
				<div class="form-group">
					<label class="black-text" for="txt_username">Name</label><br>
					<input type="text" class="form-control" id="name" name="name">	
				</div>
				<div class="form-group">
					<label class="black-text" for="txt_username">Username</label><br>
					<input type="text" class="form-control" id="username" name="username">	
				</div>
				<div class="form-group ">
					<label class="black-text" for="txt_password">Password</label><br>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<div class="form-group ">
					<label class="black-text" for="txt_repeatPassword">Repeat Password</label><br>
					<input type="password" class="form-control" id="repeat" name="repeat_password">
				</div>
				<div>
					<button id="register" name="register" type="submit" class="btn btn-default btn-block btn-gradient">Sign up</button>
				</div>
			</form>
		</div>
	</div>
</div>