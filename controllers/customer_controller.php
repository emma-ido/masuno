<?php
include_once("../classes/customer_class.php");

function customer_login($email, $password) {
	$customer = new customer();
	return $customer->login($email, $password);
}

function get_customer_by_id($id) {
	$customer = new customer();
	return $customer->get_customer_by_id($id);
}

function get_email($id) {
	$customer = new customer();
	return $customer->get_email($id);
}

function get_customer_name($customer_id) {
	$customer = new customer();
	return $customer->get_customer_name($customer_id);
}

function get_phone_number($id) {
	$customer = new customer();
	return $customer->get_phone_number($id);
}

//       new_customer($first_name, $last_name, $email, $pass, $phone_number, $gender)
function new_customer($first_name, $last_name, $email, $pass, $phone_number, $gender) {
	$customer = new customer();
	return $customer->new_customer($first_name, $last_name, $email, $pass, $phone_number, $gender);
}
?>