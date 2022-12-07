<?php
include_once("../settings/core.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php include_once("../view/navbar.php"); ?>
	<br><br><br>
	<div class="container">
		<form action="employee_login_process.php" method="POST">
			<h3>Login to your employee account</h3>
			<hr>
			<?php
			    if(isset($_GET["error"])) {
			    	echo "<span class='badge badge-danger'>$_GET[error]</span>";
			    } else if(isset($_GET["success"])) {
			    	echo "<span class='badge badge-success'>$_GET[success]</span>";
			    } 
		  	?>
			<div class="form-row align-items-center">
				<div class="col-auto">
					<input class="form-control" type="email" name="email" placeholder="Email">
				</div>
				<div class="col-auto">
					<input type="password" class="form-control" name="password" placeholder="Password">		
				</div>
					<input type="hidden" value="login" name="employee_login">
				<div class="col-auto">
					<button type="submit" class="btn btn-primary">Log in</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>