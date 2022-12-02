<?php
include_once('../controllers/booking_controller.php');




function get_event_type_select_options() {
	$event_types = get_event_types();
	$html = "";
	foreach($event_types as $event_type) {
		$event = $event_type["event_type"];
		$html .= "<option value='$event'>$event</option>";
	}
	echo $html;
}

?>