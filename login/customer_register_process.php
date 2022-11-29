<?php
include_once('../settings/core.php');
include_once('../controllers/customer_controller.php');


if(isset($_POST['customer_register'])) {

	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$phone_number = $_POST['contact'];
	$gender = $_POST['gender'];

	$result = new_customer($first_name, $last_name, $email, $pass, $phone_number, $gender);
	if($result[0]) {
		header("Location: customer_login.php?success=$result[1]");
	} else {
		header("Location: customer_register.php?error=$result[1]");
	}
} else {
	header("Location: ../index.php");
}
?>