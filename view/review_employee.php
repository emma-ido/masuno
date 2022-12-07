<?php
include_once("../settings/core.php");
include_once("../actions/booking_functions.php");


if(isset($_GET["c_id"]) && isset($_GET["e_id"]) && isset($_GET["b_id"])) {
	$employee_id = $_GET["e_id"];
	$customer_id = $_GET["c_id"];
	$booking_id = $_GET["b_id"];

	if(getCustomerId() != $customer_id) {
		header("Location: past_bookings.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Review Employee</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php include_once("navbar.php") ?>
	<script type="text/javascript" src="../js/review.js"></script>
	<br><br><br>
	<div class="mx-auto">
		<div class="container">
			<h4>Leave a review</h4>
			<hr>
			<?php echo get_review_to_edit($employee_id, $customer_id, $booking_id); }?>
		</div>
	</div>

</body>
</html>