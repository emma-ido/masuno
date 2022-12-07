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

	function is_available_at_time($new_booking_start_time, $new_booking_end_time, $employee_id) {
		$dt = new DateTime($new_booking_start_time);
		$date = $dt->format('Y-m-d');
		$sql = "SELECT start_time, end_time FROM bookings WHERE DATE(start_time) = '$date' AND status != 'Rejected'";

		//SELECT * FROM bookings WHERE DATE(start_time) = '$date' AND start_time <= '$new_booking_end_time' OR end_time > '$new_booking_start_time'
		// "SELECT * FROM bookings WHERE DATE(start_time) = '$date' AND start_time <= '$new_booking_end_time' AND start_time >= '$new_booking_start_time'"
		$times = $this->db_fetch_all($sql);
		if($this->db_count() > 1) {
			return false;
		}
		if($this->db_count() == 0) {
			return true;
		}

		$current_time = array($this->convert_to_epoch($times[0]["start_time"]), $this->convert_to_epoch($times[0]["end_time"]));
		$new_time = array($this->convert_to_epoch($new_booking_start_time), $this->convert_to_epoch($new_booking_end_time));

		$intervals = array();
		if($new_time[0] < $current_time[0]) {
			$intervals[0] = $new_time;
			$intervals[1] = $current_time;
		} else {
			$intervals[0] = $current_time;
			$intervals[1] = $new_time;
		}

		return !($intervals[0][1] >= $intervals[1][0]);
		// if($this->db_count() > 0) {
		// 	return false;
		// }
		// return true;
	}

	function convert_to_epoch($datetime) {
		$dt = new DateTime($datetime);
		return $dt->format('U');
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
			return array(false, "Email or password incorrect");
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


// $employee = new employee();
// $new_booking_start_time = '2022-12-06 8:00:00';
// $new_booking_end_time = '2022-12-06 10:59:00';
// if($employee->is_available_at_time($new_booking_start_time, $new_booking_end_time, 2)) {
// 	echo "<br><br>AVAILABLE<br><br>";
// } else {
// 	echo "<br><br>UNAVAILABLE<br><br>";
// }
?>