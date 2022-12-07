<?php
include_once("../settings/core.php");
include_once("../controllers/booking_controller.php");

if (isset($_POST["book_employee"])) {

	$customer_id = $_POST['customer_id'];
	$employee_id = $_POST['employee_id'];
	$event_type = $_POST['event_type'];
	$start_time = $_POST['start_time'];
	$end_time = $_POST['end_time'];
	$amount = $_POST['amount'];
	$address = $_POST['address'];
	$description = $_POST['description'];
	
	if(insert_booking($customer_id, $employee_id, $event_type, $start_time, $end_time, $amount, $address, $description)) {
		header("Location: ../view/past_bookings.php?success=Your Booking is being proccessed");
	} else {
		// header("Location: ");
	}
}

?>