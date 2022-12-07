<?php
include_once('../controllers/booking_controller.php');
include_once("../controllers/employee_controller.php");



function get_review_to_edit($employee_id, $customer_id, $booking_id) {
	$review = get_reviews($employee_id, $customer_id, $booking_id);

	$html = "";

	$stars = 0;
	$comment = "";
	$path = "../actions/insert_review_process.php";
	if($review != null) {
		$stars = $review["stars"];
		$comment = $review["comments"];
		$path = '../actions/update_review_process.php';
	}
	$star_html = "";
	$i = 0;
	for ($i; $i < $stars ; $i++) {
		$curr = $i+1;
		$star_html .= "<img id='star_$curr' onclick='setStar($curr)' src='../images/assets/star_filled.svg'>";

	}

	while ($i != 5) {
		$curr = $i+1;
		$star_html .= "<img id='star_$curr' onclick='setStar($curr)' src='../images/assets/star_blank.svg'>";
		$i++;
	}

	$html .= "
	<form method='POST' action='$path'>
			<input type='hidden' id='stars' name='stars' value='$stars'>
			<input type='hidden' name='e_id' value='$employee_id'>
			<input type='hidden' name='c_id' value='$customer_id'>
			<input type='hidden' name='b_id' value='$booking_id'>

				<div class='row'>
					$star_html
				</div>
				
				<br>
			  <textarea class='form-control' name='comment' placeholder='Describe your experience (optional)'>$comment</textarea>
			  <br>
			  <button type='submit' class='btn btn-primary'>Save</button> <a href='../actions/delete_review_process.php?c_id=$customer_id&e_id=$employee_id&b_id=$booking_id' class='btn btn-danger' role='button'>Delete</a>
			  </form>";

	echo $html;
}

function get_bookings_tabular_customer($customer_id, $status) {
	$bookings = find_my_bookings_customer($customer_id, $status);
	$html = "";
	foreach($bookings as $booking) {
		$booking_id = $booking["id"];
		// "F d, Y h:i:s
		$employee_id = $booking["employee_id"];
		$today = new DateTime(date("Y-m-d H:i:s"));
		$start_time = $booking["start_time"];
		$dt = new DateTime($start_time);
		$start_date = $dt->format('F d, Y');
		$start_time = $dt->format('h:i A');

		$end_time = $booking["end_time"];
		$dt = new DateTime($end_time);
		$end_time = $dt->format('h:i A');
		$end_date = $dt->format('F d, Y');

		$event_type = $booking["event_type"];
		$price = $booking["amount"];
		$status = $booking["status"];
		$employee_id = $booking["employee_id"];
		$employee_name = get_employee_name($employee_id);
		$buttons = "";
		if($status == "Accepted") {
			$buttons = "<a href='#' class='btn btn-outline-success' onclick='payWithPaystack($price, $booking_id)' role='button'>Pay Now</a>";
		} else if($status == "Rejected") {
			$buttons = "<a href='#' class='btn btn-danger disabled' role='button' aria-disabled='true'>Rejected</a>";
		} else if($status == "Paid") {
			$buttons = "<a href='#' class='btn btn-success disabled' role='button' aria-disabled='true'>Paid</a>";
			if($today > $dt) {
				$buttons .= " <a href='review_employee.php?c_id=$customer_id&e_id=$employee_id&b_id=$booking_id' class='btn btn-primary' role='button'>Review</a>";
			}
		} else {
			$buttons = "<a href='#' class='btn btn-outline-primary disabled' role='button' aria-disabled='true'>Pending</a>"; 
		}
		$html .= "<tr>
					  <td><a href='../view/view_employee_profile.php?id=$employee_id'>$employee_name</a></td>
				      <td>$start_date<br>$start_time</td>
				      <td>$end_date<br>$end_time</td>
				      <td>$event_type</td>
				      <td><button onclick='getBookingInfo($booking_id)' class='btn btn-outline-primary' type='button'>Details</button></td>
				      <td>$price</td>
				      <td colspan='2'>$buttons</td>
				  </tr>";
	}
	echo $html;
}


function get_bookings_tabular($employee_id, $status) {
	$bookings = find_my_bookings($employee_id, $status);
	$html = "";
	foreach($bookings as $booking) {
		$booking_id = $booking["id"];
		// "F d, Y h:i:s

		$start_time = $booking["start_time"];
		$dt = new DateTime($start_time);
		$start_time = $dt->format('h:i A');
		$start_date = $dt->format('F d, Y');

		$end_time = $booking["end_time"];
		$dt = new DateTime($end_time);
		$end_time = $dt->format('h:i A');
		$end_date = $dt->format('F d, Y');

		$event_type = $booking["event_type"];
		$status = $booking["status"];
		$buttons = "";
		$price = $booking["amount"];
		$customer_id = $booking["customer_id"];
		if($status == "Accepted") {
			$buttons = "<a href='#' class='btn btn-outline-primary disabled' role='button' aria-disabled='true'>Accepted</a>";
		} else if($status == "Rejected") {
			$buttons = "<a href='#' class='btn btn-outline-danger disabled' role='button' aria-disabled='true'>Rejected</a>";
		} else if($status == "Paid") {
			$buttons = "<a href='#' class='btn btn-outline-success disabled' role='button' aria-disabled='true'>Paid</a>";
		} else {
			$buttons = "<a href='#' class='btn btn-primary' role='button' onclick='acceptBooking($booking_id)'>Accept</a>
			<a href='#' class='btn btn-danger' onclick='rejectBooking($booking_id)' role='button'>Reject</a>"; 
		}
		$html .= "<tr>
					  <td><button onclick='getCustomerInfo($customer_id)' class='btn btn-outline-primary'>Customer Info</button></td>
				      <td>$start_date<br>$start_time</td>
				      <td>$end_date<br>$end_time</td>
				      <td>$event_type</td>
				      <td><button onclick='getBookingInfo($booking_id)' class='btn btn-outline-primary' type='button'>Details</button></td>
				      <td>$price</td>
				      <td colspan='2'>$buttons</td>
				  </tr>";
	}
	echo $html;
}


function get_event_type_select_options() {
	$event_types = get_event_types();
	$html = "";
	foreach($event_types as $event_type) {
		$event = $event_type["event_type"];
		$html .= "<option value='$event'>$event</option>";
	}
	echo $html;
}

function get_employees_average_stars($employee_id) {
	// SUM(stars), COUNT(stars)
	$output = get_average_stars($employee_id);
	$sum = $output["SUM(stars)"];
	$count = $output["COUNT(stars)"];
	$avg = 0;
	if($count != 0) {
		$avg = $sum/$count;
	}
	echo "<span><span class='font-weight-bold'>Average Rating:</span> " .round($avg, 2). "/5 [$count rating(s)]</span>";
}

function get_employees_reviews_tabular($employee_id) {
	$reviews = get_employees_reviews($employee_id);
	$html = "";

	
	foreach($reviews as $review) {
		$comment = $review["comments"];
		$stars = $review["stars"];

		$star_html = "";
		$i = 0;
		for ($i; $i < $stars ; $i++) {
			$curr = $i+1;
			$star_html .= "<img id='star_$curr' onclick='setStar($curr)' src='../images/assets/star_filled.svg'>";

		}

		while ($i != 5) {
			$curr = $i+1;
			$star_html .= "<img id='star_$curr' onclick='setStar($curr)' src='../images/assets/star_blank.svg'>";
			$i++;
		}

		$html .= "
		<tr>
			<td>$star_html</td>
			<td>$comment</td>
		</tr>
		";
	}
	echo $html;
}

?>