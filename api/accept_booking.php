<?php
include_once("../settings/core.php");
include_once("../controllers/booking_controller.php");


if(isset($_POST["accept_booking"])) {
	$booking_id = $_POST["booking_id"];

	if(accept_booking($booking_id)) {
		echo "YES";
	} else {
		echo "NO";
	}
}


?>