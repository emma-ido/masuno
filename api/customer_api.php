<?php
include_once("../controllers/customer_controller.php");


if(isset($_GET['email'])) {
	$customer_id = $_GET['customer_id'];

	echo get_email($customer_id);
} else if(isset($_GET['phone'])) {
	$customer_id = $_GET['customer_id'];

	echo get_phone_number($customer_id);
} else if ($_GET['name']) {
	$customer_id = $_GET['customer_id'];

	echo get_customer_name($customer_id);
}

?>