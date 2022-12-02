<?php
include_once('../classes/booking_class.php');


function get_event_types() {
	$booking = new booking();
	return $booking->get_event_types();
}

?>