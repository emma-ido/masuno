<?php
include_once('../settings/core.php');
include_once('../controllers/customer_controller.php');

if(isset($_POST['customer_login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$results = customer_login($email, $password);

	if($results[0]) {
		unset_session_variables();
		$_SESSION['customer_active'] = true;
		$_SESSION['customer_id'] = $results[1];
		header("Location: ../index.php");
	} else {
		header("Location: customer_login.php?error=$results[1]");
	}
}

?>