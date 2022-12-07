<?php
include_once("../settings/core.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer Register</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php include_once("../view/navbar.php"); ?>
	<script type="text/javascript" src="../js/form.js"></script>
	<br><br><br>
	<div class="container">
	<form action="customer_register_process.php" id="customer_register_form" method="POST">
		<h3>Create An Account</h3>
		<hr>
		<?php
		    if(isset($_GET["error"])) {
		    	echo "<span class='badge badge-danger'>$_GET[error]</span>";
		    } else if(isset($_GET["success"])) {
		    	echo "<span class='badge badge-success'>$_GET[success]</span>";
		    } 
	  	?>
		<div class="form-row">
		    <div class="form-group col-md-6">
		      <input type="text" name="fname" class="form-control" placeholder="First name" required>
		    </div>
		    <div class="form-group col-md-6">
		      <input type="text" name="lname" class="form-control" placeholder="Last name" required>
		    </div>
		</div>

		<div class="form-group">
			<input type="email" class="form-control" name="email" placeholder="Email" required>
		</div>

		<span class='badge badge-danger' id="passError"></span>
		<div class="form-row">
		    <div class="form-group col-md-6">
				<input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
		    </div>
		    <div class="form-group col-md-6">
		    	<input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password" required>
		    </div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<input type="text" class="form-control" name="contact" placeholder="Phone number" required>
			</div>
		</div>
		<div class="form-group">
			<div class="form-check">
				<input type="radio" class="form-check-input" id="gender1" name="gender" value="M">
				<label for="gender1" class="form-check-label">Male</label>
			</div>
		</div>

		<div class="form-group">
			<div class="form-check">
				<input type="radio" id="gender2" class="form-check-input" name="gender" value="F">
				<label for="gender2" class="form-check-label">Female</label>
			</div>
		</div>

		<input type="hidden" name="customer_register" value="create">
		<input type="button" class="btn btn-primary" onclick="validateCustomerRegister()" value="Create Account">
	</form>
	</div>

</body>
</html>