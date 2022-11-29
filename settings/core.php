<?php
//start session
session_start(); 

//for header redirection
ob_start();

//funtion to check for login
function isEmployee() {
	if(!isset($_SESSION['employee_active']) || $_SESSION['employee_active'] == false) {
		return false;
	} else if(isset($_SESSION['employee_active']) && isset($_SESSION['employee_id'])) {
		return true;
	} else {
		return false;
	}
}

function isCustomer() {
	if(!isset($_SESSION['customer_active']) || $_SESSION['customer_active'] == false) {
		return false;
	} else if(isset($_SESSION['customer_active']) && isset($_SESSION['customer_id'])) {
		return true;
	} else {
		return false;
	}
}

//function to get user ID
function getCustomerId() {
	if(isCustomer()) {
		return $_SESSION['customer_id'];
	}
	return -1;
}

function getEmployeeId() {
	if(isEmployee()) {
		return $_SESSION['employee_id'];
	}
	return -1;
}


//function to check for role (admin, customer, etc)


// function to unset session variables
function unset_session_variables() {
	$helper = array_keys($_SESSION);
    foreach ($helper as $key) {
        unset($_SESSION[$key]);
    }
}
?>