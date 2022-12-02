<?php
include_once("../controllers/employee_controller.php");


if(isset($_POST["check_employee_availability"])) {

	$start_time = $_POST["start_time"];
	$end_time = $_POST["end_time"];
	
	if(is_available_at_time($start_time, $end_time)) {
		echo "YES";
	} else {
		echo "NO";
	}
}

?>