<?php
include_once("../settings/core.php");
include_once("../controllers/booking_controller.php");

if(isset($_GET["c_id"]) && isset($_GET["e_id"]) && isset($_GET["b_id"])) {
	$employee_id = $_GET["e_id"];
	$customer_id = $_GET["c_id"];
	$booking_id = $_GET["b_id"];

	if(delete_review($employee_id, $customer_id, $booking_id)) {
		header("Location: ../view/past_bookings.php?success=Review Deleted Successfuly");
	} else {
		header("Locatino: ../view/past_bookings.php?error=Unable to delete review");
	}
}
?>