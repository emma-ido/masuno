<?php
include_once("../settings/db_class.php");

class customer extends db_connection {


	function new_customer($first_name, $last_name, $email, $pass, $phone_number, $gender) {
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO customer(first_name, last_name, email, pass, phone_number, gender) VALUES ('$first_name', '$last_name', '$email', '$pass', '$phone_number', '$gender')";
		
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

	/**
	 * Return true if email exists in customer table, sinon false
	 * */
	function emailExists($email) {
		$sql = "SELECT id FROM customer WHERE email = '$email'";
		$this->db_query($sql);
		return ($this->db_count() == 1);
	}

	function login($email, $password) {
		if(!$this->emailExists($email)) {
			return array(false, "Email or password incorrect");
		} else {
			$customerFromDb = $this->get_customer_with_email($email);
			
			return array(password_verify($password, $customerFromDb["pass"]), $customerFromDb["id"]);
		}
	}

	function get_customer_by_id($id) {
		$sql = "SELECT * FROM customer WHERE id=$id";
		return $this->db_fetch_one($sql);
	}

	function get_id_from_email($email) {
		$sql = "SELECT id FROM customer WHERE email='$email'";
		return $this->db_fetch_one($sql)["id"];
	}

	function get_customer_with_email($email) {
		$sql = "SELECT * FROM customer WHERE email='$email'";
		return $this->db_fetch_one($sql);
	}

	function get_customer_name($id) {
		$sql = "SELECT first_name, last_name FROM customer WHERE id=$id";
		$result = $this->db_fetch_one($sql);
		return $result["first_name"]. " " .$result["last_name"];
	}

	function get_phone_number($id) {
		$sql = "SELECT phone_number FROM customer WHERE id=$id";
		return $this->db_fetch_one($sql)["phone_number"];
	}

	function get_email($id) {
		$sql = "SELECT email FROM customer WHERE id=$id";
		return $this->db_fetch_one($sql)["email"];
	}
}

?>