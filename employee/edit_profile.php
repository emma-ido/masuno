<?php
include_once("../settings/core.php");
include_once("../actions/employee_functions.php");


$employee_id = getEmployeeId();
if($employee_id == -1) {
	header("Location: ../login/employee_login.php?error=You must be loggin in to continue");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/background.css">
	<script src="//cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
</head>
<body>
	<?php include_once("navbar.php"); ?>
	<br><br><br>
	<div class="container mx-auto">
		<form method="POST" action="edit_profile_process.php" style="text-align: center;">
			<textarea name="content"><?php print_employees_profile($employee_id); ?></textarea>
			<br>
			<input type="submit" class="btn btn-primary" value="Save Changes" name="edit_profile">
		</form>
	</div>

	<script type="text/javascript">
		CKEDITOR.replace('content')
	</script>
</body>
</html>