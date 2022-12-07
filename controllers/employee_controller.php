<?php
include_once("../classes/employee_class.php");

function new_employee($first_name, $last_name, $email, $pass, $phone_number, $gender) {
	$employee = new employee();
	return $employee->new_employee($first_name, $last_name, $email, $pass, $phone_number, $gender);
}

function get_hourly_rate($employee_id) {
	$employee = new employee();
	return $employee->get_hourly_rate($employee_id);
}

function is_available_at_time($new_booking_start_time, $new_booking_end_time, $employee_id) {
	$employee = new employee();
	return $employee->is_available_at_time($new_booking_start_time, $new_booking_end_time, $employee_id);
}

function employee_login($email, $password) {
	$employee = new employee();
	return $employee->login($email, $password);
}

function update_profile($employee_id, $content) {
	$employee = new employee();
	return $employee->update_profile($employee_id, $content);
}

function get_employee_name($id) {
	$employee = new employee();
	return $employee->get_employee_name($id);
}

function get_employee_profile($employee_id) {
	$employee = new employee();
	return $employee->get_profile($employee_id);
}

function select_all_employees() {
	$employee = new employee();
	return $employee->select_all_employees();
}

function select_all_employees_gen($gender) {
	$employee = new employee();
	return $employee->select_all_employees_gen($gender);
}

?>