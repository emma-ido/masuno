<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php
	    if(isset($_GET["error"])) {
	    	echo "<span class='badge badge-danger'>$_GET[error]</span>";
	    } else if(isset($_GET["success"])) {
	    	echo "<span class='badge badge-success'>$_GET[success]</span>";
	    } 
  	?>

	<form action="customer_login_process.php" method="POST">
		<input type="email" name="email" placeholder="email">
		<input type="password" name="password" placeholder="password">
		<input type="submit" value="login" name="customer_login">
	</form>

</body>
</html>