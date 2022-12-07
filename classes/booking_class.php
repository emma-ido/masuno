<?php
include_once('../settings/db_class.php');


class booking extends db_connection {


	function insert_booking($customer_id, $employee_id, $event_type, $start_time, $end_time, $amount, $address, $description) {
		$sql = "INSERT INTO bookings(customer_id, employee_id, event_type, start_time, end_time, amount, address, description) VALUES($customer_id, $employee_id, '$event_type', '$start_time', '$end_time', $amount, '$address', '$description')";
		return $this->db_query($sql);
	}


	function insert_new_review($employee_id, $customer_id, $booking_id, $comments, $stars) {
		$sql = "INSERT INTO review(employee_id, customer_id, booking_id, comments, stars) VALUES 
		($employee_id, $customer_id, $booking_id, '$comments', $stars)";
		return $this->db_query($sql);
	}

	function update_review($employee_id, $customer_id, $booking_id, $comments, $stars) {
		$sql = "UPDATE review SET comments='$comments', stars=$stars WHERE employee_id=$employee_id AND customer_id=$customer_id AND booking_id=$booking_id";
		return $this->db_query($sql);
	}

	function get_reviews($employee_id, $customer_id, $booking_id) {
		$sql = "SELECT comments, stars FROM review WHERE employee_id=$employee_id AND customer_id=$customer_id AND booking_id=$booking_id";
		return $this->db_fetch_one($sql);
	}

	function get_booking_description($booking_id) {
		$sql = "SELECT description FROM bookings WHERE id=$booking_id";
		return $this->db_fetch_one($sql)["description"];
	}

	function get_booking_address($booking_id) {
		$sql = "SELECT address FROM bookings WHERE id=$booking_id";
		return $this->db_fetch_one($sql)["address"];
	}

	function get_employees_reviews($employee_id) {
		$sql = "SELECT comments, stars FROM review WHERE employee_id=$employee_id";
		return $this->db_fetch_all($sql);
	}

	function get_average_stars($employee_id) {
		$sql = "SELECT SUM(stars), COUNT(stars) FROM review WHERE employee_id=$employee_id";
		return $this->db_fetch_one($sql);
	}

	function delete_review($employee_id, $customer_id, $booking_id) {
		$sql = "DELETE FROM review WHERE employee_id=$employee_id AND customer_id=$customer_id AND booking_id=$booking_id";
		return $this->db_query($sql);
	}

	function get_event_types() {
		$sql = "SELECT * from event_types";
		return $this->db_fetch_all($sql);
	}

	function accept_booking($id) {
		$sql = "UPDATE bookings SET status = 'Accepted' WHERE id=$id";
		return $this->db_query($sql);
	}

	function reject_booking($id) {
		$sql = "UPDATE bookings SET status = 'Rejected' WHERE id=$id";
		return $this->db_query($sql);
	}

	function pay_for_booking($id) {
		$sql = "UPDATE bookings SET status = 'Paid' WHERE id=$id";
		return $this->db_query($sql);
	}

	function find_my_bookings_customer($customer_id, $status=null) {
		$sql = "";
		if($status == null) {
			$sql = "SELECT * FROM bookings WHERE customer_id=$customer_id";
		} else {
			$sql = "SELECT * FROM bookings WHERE customer_id=$customer_id AND status='$status'";
		}
		return $this->db_fetch_all($sql);
	}

	function find_my_bookings($employee_id, $status=null) {
		$sql = "";
		if($status == null) {
			$sql = "SELECT * FROM bookings WHERE employee_id=$employee_id";
		} else {
			$sql = "SELECT * FROM bookings WHERE employee_id=$employee_id AND status='$status'";
		}
		return $this->db_fetch_all($sql);
	}
}

?>