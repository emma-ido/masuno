<?php
include_once("../classes/employee_class.php");

function new_employee($first_name, $last_name, $email, $pass, $phone_number, $gender) {
	$employee = new Employee();
	return $employee->new_employee($first_name, $last_name, $email, $pass, $phone_number, $gender);
}

function employee_login($email, $password) {
	$employee = new Employee();
	return $employee->login($email, $password);
}

?>