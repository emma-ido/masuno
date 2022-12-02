<?php
include_once("../settings/core.php");
include_once("../controllers/employee_controller.php");


if(isset($_POST["edit_profile"])) {
	
	$employee_id = getEmployeeId();
	if($employee_id == -1) {
		header("Location: ../login/employee_login.php?error=You must first be logged in");
	}

	$content = $_POST["content"];

	if(update_profile($employee_id, $content)) {
		header("Location: index.php?success=Successfuly updated profile");
	} else {
		header("Location: index.php?error=Failed to update profile");
	}

	// echo $content;
} else {
	header("Location: ../login/employee_login.php?error=You must first be logged in");
}

?>