<?php
include_once('../settings/core.php');
include_once('../controllers/employee_controller.php');

if(isset($_POST['employee_login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$results = employee_login($email, $password);

	if($results[0]) {
		unset_session_variables();
		$_SESSION['employee_active'] = true;
		$_SESSION['employee_id'] = $results[1];
		header("Location: ../employee/view_bookings.php");
	} else {
		header("Location: employee_login.php?error=$results[1]");
	}
}
?>