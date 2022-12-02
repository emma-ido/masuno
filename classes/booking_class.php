<?php
include_once('../settings/db_class.php');


class booking extends db_connection {


	function get_event_types() {
		$sql = "SELECT * from event_types";
		return $this->db_fetch_all($sql);
	}
}

?>