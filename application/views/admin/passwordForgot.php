<!DOCTYPE html>
<html lang="en">
  	<head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href=<?php echo base_url() ;?>assets/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css>
	    <!-- Custom CSS -->
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ;?>assets/css/secondary.css">
	    <title><?php echo $title; ?></title>
  	</head>

  	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<form class="form-container-fp">
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">

								<h4><b><center><span><i class="glyphicon glyphicon-lock"></i></span> Forgot Password </center></b></h4>

								<div class="form-group">
								    <label class="center-text" for="txt_question1">What is your mother's maiden name?</label><br>
								    <input type="text" class="form-control" style="text-align: center; id="txt_question1">
								</div>
								<div class="form-group">
								    <label class="center-text" for="txt_question1">What university did you attend?</label><br>
								    <input type="text" class="form-control" style="text-align: center; id="txt_question2">
								</div>
								<div class="form-group">
								    <label class="center-text" for="txt_question1">New Password</label><br>
								    <input type="password" class="form-control" style="text-align: center; id="txt_question1">
								</div>
								<div class="form-group">
								    <label class="center-text" for="txt_question1">Repeat Password</label><br>
								    <input type="password" class="form-control" style="text-align: center; id="txt_question1">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<button type="button" class="btn btn-default  btn-block btn-gradient">Submit</button>
								<button id="btn_cancel" type="button" class="btn btn-link btn-block white-text">Cancel</button>
								<script type="text/javascript">
								    document.getElementById("btn_cancel").onclick = function () {
								        location.href = "<?php echo base_url() ;?>login";
								    };
								</script>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	    <!-- Bootstrap JS -->
	    <script src="<?php echo base_url() ;?> assets/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
  	</body>
</html>