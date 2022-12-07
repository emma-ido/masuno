<?php
include_once('../classes/booking_class.php');


function insert_booking($customer_id, $employee_id, $event_type, $start_time, $end_time, $amount, $address, $description) {
	$booking = new booking();
	return $booking->insert_booking($customer_id, $employee_id, $event_type, $start_time, $end_time, $amount, $address, $description);
}

function get_reviews($employee_id, $customer_id, $booking_id) {
	$booking = new booking();
	return $booking->get_reviews($employee_id, $customer_id, $booking_id);
}

function update_review($employee_id, $customer_id, $booking_id, $comments, $stars) {
	$booking = new booking();
	return $booking->update_review($employee_id, $customer_id, $booking_id, $comments, $stars);
}

function get_employees_reviews($employee_id) {
	$booking = new booking();
	return $booking->get_employees_reviews($employee_id);
}

function get_average_stars($employee_id) {
	$booking = new booking();
	return $booking->get_average_stars($employee_id);
}

function get_booking_address($booking_id) {
	$booking = new booking();
	return $booking->get_booking_address($booking_id);
}

function get_booking_description($booking_id) {
	$booking = new booking();
	return $booking->get_booking_description($booking_id);
}

function delete_review($employee_id, $customer_id, $booking_id) {
	$booking = new booking();
	return $booking->delete_review($employee_id, $customer_id, $booking_id);
}

function insert_new_review($employee_id, $customer_id, $booking_id, $comments, $stars) {
	$booking = new booking();
	return $booking->insert_new_review($employee_id, $customer_id, $booking_id, $comments, $stars);
}

function get_event_types() {
	$booking = new booking();
	return $booking->get_event_types();
}

function pay_for_booking($id) {
	$booking = new booking();
	return $booking->pay_for_booking($id);
}

function find_my_bookings_customer($customer_id, $status) {
	$booking = new booking();
	return $booking->find_my_bookings_customer($customer_id, $status);
}

function accept_booking($id) {
	$booking = new booking();
	return $booking->accept_booking($id);
}

function reject_booking($id) {
	$booking = new booking();
	return $booking->reject_booking($id);
}

function find_my_bookings($employee_id, $status) {
	$booking = new booking();
	return $booking->find_my_bookings($employee_id, $status);
}


?>