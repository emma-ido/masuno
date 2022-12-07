<?php
include_once("../settings/core.php");
include_once("../controllers/booking_controller.php");

if(isset($_POST["c_id"]) && isset($_POST["e_id"]) && isset($_POST["b_id"])) {
	$employee_id = $_POST["e_id"];
	$customer_id = $_POST["c_id"];
	$booking_id = $_POST["b_id"];
	$comments = $_POST["comment"];
	$stars = $_POST["stars"];

	if(insert_new_review($employee_id, $customer_id, $booking_id, $comments, $stars)) {
		header("Location: ../view/past_bookings.php?success=Review Addedd Successfuly");
	} else {
		header("Locatino: ../view/past_bookings.php?error=Unable to Add review");
	}
}



?>