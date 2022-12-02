<?php
include_once("../settings/db_class.php");

class employee extends db_connection {

	function new_employee($first_name, $last_name, $email, $pass, $phone_number, $gender) {
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO employee(first_name, last_name, email, pass, phone_number, gender) VALUES('$first_name', '$last_name', '$email', '$pass', '$phone_number', '$gender')";

		if($this->emailExists($email)) {
			return array(false, "Account already exists. Login to your account");
		}

		$result = $this->db_query($sql);

		if($result) {
			return array($result, "Successfuly created account. Login to coninue");
		} else {
			return array($result, "Error creating new account");
		}
	}

	function select_all_employees() {
		$sql = "SELECT * FROM employee";
		return $this->db_fetch_all($sql);
	}

	function get_hourly_rate($employee_id) {
		$sql = "SELECT hourly_rate FROM employee WHERE id=$employee_id";
		$hourly_rate = $this->db_fetch_one($sql);
		if($this->db_count() == 0) {
			return -1;
		}
		return $hourly_rate["hourly_rate"];
	}

	function is_available_at_time($new_booking_start_time, $new_booking_end_time) {
		$dt = new DateTime($new_booking_start_time);
		$date = $dt->format('Y-m-d');
		$sql = "SELECT * FROM bookings WHERE DATE(start_time) = '$date' AND start_time <= '$new_booking_end_time' AND start_time >= '$new_booking_start_time'";
		$this->db_query($sql);
		if($this->db_count() > 0) {
			return false;
		}
		return true;
	}

	function select_all_employees_gen($gender) {
		$sql = "SELECT * FROM employee WHERE gender='$gender'";
		return $this->db_fetch_all($sql);
	}

	function update_profile($employee_id, $content) {
		$sql = "UPDATE employee SET employee_profile = '$content' WHERE id=$employee_id";
		return $this->db_query($sql);
	}

	function get_profile($employee_id) {
		$sql = "SELECT employee_profile FROM employee WHERE id=$employee_id";
		return $this->db_fetch_one($sql)["employee_profile"];
	}

	function login($email, $password) {
		if(!$this->emailExists($email)) {
			return array(false, "Email already exists");
		} else {
			$emplyee_from_db = $this->get_employee_with_email($email);
			return array(password_verify($password, $emplyee_from_db["pass"]), $emplyee_from_db["id"]);
		}
	}

	function emailExists($email) {
		$sql = "SELECT id FROM employee WHERE email = '$email'";
		$this->db_query($sql);
		return ($this->db_count() == 1);
	}

	function get_employee($id) {
		$sql = "SELECT * FROM employee WHERE id=$id";
		return $this->db_fetch_one($sql);
	}

	function get_employee_email($id) {
		$sql = "SELECT email FROM employee WHERE id=$id";
		return $this->db_fetch_one($sql)["email"];
	}

	function get_employee_name($id) {
		$sql = "SELECT first_name, last_name FROM employee WHERE id=$id";
		$names = $this->db_fetch_one($sql);
		return $names["first_name"] . " " .$names["last_name"];
	}

	function get_employee_with_email($email) {
		$sql = "SELECT * FROM employee WHERE email='$email'";
		return $this->db_fetch_one($sql);	
	}
}
?>