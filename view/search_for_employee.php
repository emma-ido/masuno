<?php
include_once("../settings/core.php");
include_once("../actions/employee_functions.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search For Employee</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php include_once("navbar.php") ?>
	<br><br>
	<div class="mx-auto" style="width: 95%;">
		
	    <div style="text-align: center;">
	    	<h4>Find Employee</h4>
		    <a style="border-bottom-left-radius: 20px;border-top-left-radius: 20px;" href="search_for_employee.php" class="btn btn-primary">RESET</a> <a href="search_for_employee.php?gender=M" class="btn btn-primary">MALE</a> <a style="border-bottom-right-radius: 20px;border-top-right-radius: 20px;" href="search_for_employee.php?gender=F" class="btn btn-primary">FEMALE</a>
		</div>
	    <hr style="width: 75%;">
		<?php
			if(isset($_GET["gender"])) {
				$gender = $_GET["gender"];

				if($gender === "M" || $gender === "m" || $gender === "F" || $gender === "f") {
					search_employees($gender);
				} else {
					search_employees();
				}
			} else {
				search_employees();
			}
		?>
	</div>
</body>
</html>