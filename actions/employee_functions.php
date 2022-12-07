<?php
include_once("../settings/core.php");
include_once("../controllers/employee_controller.php");


function print_employees_profile($employee_id) {
	echo get_employee_profile($employee_id);
}


function search_employees($gender=null) {
	$employees = null;
	if($gender != null) {
		$employees = select_all_employees_gen($gender);
	} else {
		$employees = select_all_employees();
	}
	// echo count($employees);
	$html = "<div class='row' style='text-align: center;'>";
	$i = 0;
	foreach($employees as $employee) {
		$employee_id = $employee["id"];
		$first_name = $employee["first_name"];
		$last_name = $employee["last_name"];
		$employee_image = $employee["employee_image"];
		if($employee_image == null) {
			$employee_image = "../images/employee_images/milhouse_van_houten.jpg";
		}
		$hourly_rate = $employee["hourly_rate"];

		if($i == 4) {
			$i = 0;
			$html .= "</div>
					 <div class='row' style='text-align: center;'>";
		}

		$html .= "
				<div class='col' style='padding-bottom: 12px;'>
					<div class='card'>
						<a href='view_employee_profile.php?id=$employee_id'><img class='card-img-top' style='min-width:150px; max-height:190px;' src='$employee_image' alt='Card image cap'></a>
						<div class='card-body'>
							<h4>$first_name $last_name</h4>
							<span>Hourly Rate: <span class='font-weight-bold'>GHC $hourly_rate</span></span>
							<br><br>
							<a href='view_employee_profile.php?id=$employee_id' class='btn btn-outline-primary outline' role='button'>View Profile</a>
						</div>
					</div>
				</div>
		";
		$i++;
	}
	while($i != 4) {
		$html = $html. "<div class='col' style='padding-bottom: 12px;'>
						    
					    </div>
					    ";
		$i++;
	}

	$html = $html. "</div>";
	echo $html;
}
?>