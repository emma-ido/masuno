<?php
include_once("../settings/core.php");
include_once("../actions/employee_functions.php");
include_once("../actions/booking_functions.php");



if(isset($_GET["id"])) {
	$employee_id = $_GET["id"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Employee Profile</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php include_once("navbar.php") ?>
	<br><br><br>
	<div class="mx-auto">
		<div class="container">
			<div class="mx-auto">
				<span class="font-weight-bold" style="font-size: x-large;">Book <?php echo get_employee_name($employee_id); ?></span>
				<span style="color: white;">pp</span>
				<?php echo "<a href='book_employee.php?id=$employee_id' class='btn btn-primary'><span class='font-weight-bold'>Book</span></a>"; ?>
				<hr>
			</div>
		</div>
	</div>
	<br>
	<div class="container">
		<?php
			print_employees_profile($employee_id);
		?>
	</div>

	<div class="container" >
		<br><br><br>
		<hr>
		<h2 style="text-align: center;">View This Employees Reviews</h2>
		<?php get_employees_average_stars($employee_id); ?>
		<hr>
		<table class="table table-hover">
			  <thead class="thead-dark">
			    <tr>
			    	<th scope="col">Rating</th>
			        <th scope="col">Comment</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php get_employees_reviews_tabular($employee_id); ?>
			  </tbody>
		</table>
	</div>
</body>
</html>




<?php
} else {
	header("Location: ../index.php");
}
?>