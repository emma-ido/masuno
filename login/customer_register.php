<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer Register</title>
</head>
<body>

	<form action="customer_register_process.php" method="POST">
		<input type="text" name="fname" placeholder="first name">
		<input type="text" name="lname" placeholder="last name">
		<input type="email" name="email" placeholder="email">
		<input type="password" name="pass" placeholder="password">
		<input type="text" name="contact" placeholder="Phone number">

		<input type="radio" id="gender1" name="gender" value="M">
		<label for="gender1">Male</label>
		<input type="radio" id="gender2" name="gender" value="F">
		<label for="gender2">Female</label>
		<input type="submit" value="Create Account" name="customer_register">
	</form>

</body>
</html>