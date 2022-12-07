<?php
include_once("../controllers/booking_controller.php");



if(isset($_GET['description'])) {
	$booking_id = $_GET['booking_id'];

	echo get_booking_description($booking_id);
} else if(isset($_GET['address'])) {
	$booking_id = $_GET['booking_id'];

	echo get_booking_address($booking_id);
}

?>