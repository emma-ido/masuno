<?php
include_once('../settings/core.php');
include_once('../controllers/employee_controller.php');
include_once('../controllers/customer_controller.php');
include_once('../actions/booking_functions.php');



if(isset($_GET['id'])) {

	$employee_id = $_GET['id'];
	$customer_id = getCustomerId();

	if($customer_id == -1) {
		header("Location: ../login/customer_login.php?error=You must be logged in to continue");
	}

	$customer_email = get_email($customer_id);

	$hourly_rate = get_hourly_rate($employee_id);
	if($hourly_rate == -1) {
		header("Location: search_for_employee.php");
	}
	// echo $hourly_rate;
	$employee_name = get_employee_name($employee_id);
	// echo $employee_name;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book Employee</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php include_once("navbar.php"); ?>
	<br>
	<br>
	<script type="text/javascript" src="../js/booking.js"></script>
	<div class="mx-auto" style="width: 65%;">
		<?php echo "<h2 class='font-weight-normal' style='text-align: center;'>Book Employee</h2>"; ?>
		<hr>
	  <form id="bookEmployeeForm" action="../actions/book_employee_process.php" method="POST">
	  	<?php echo "<input type='hidden' value='$customer_email' id='email-address'>"; ?>
	    <div class="row form-group">	        
	        <div class="col">
	        	<label>Employee Name</label>
	  			<?php echo "<input type='text' class='form-control' value='$employee_name' readonly>"; ?>
	        </div>
	        
	        <div class="col">
	        	<label>Hourly Rate</label>
	  			<?php echo "<input type='text' class='form-control' id='hourly_rate' value='$hourly_rate' readonly>"; ?>
	        </div>
	    </div>
	    <?php echo "<input type='hidden' name='employee_id' id='employee_id' value='$employee_id'>";
	    	  echo "<input type='hidden' name='customer_id' id='customer_id' value='$customer_id'>"; ?>
	    <div class="form-group">
	      <label for="amount">Total Amount <span class="font-weight-bold">(GHC)</span></label>
	      <input type="number" name="amount" class="form-control" value=0.0 id="amount" readonly>
	    </div>


	    <div class="form-group">
	      <label for="user_role">Event Type</label>
	      <select class="custom-select" name="event_type" id="inputGroupSelect01">
	        <?php get_event_type_select_options(); ?>
	      </select>
	    </div>

	    <span class="font-weight-bold badge badge-danger" id="timeError"></span>
	    <div class="row form-group">       
	        <div class="col">
	        	<label>Start Time</label>
	        	<?php  
	        	$today = date("Y-m-d H:i:s");
	        	$today .= "T00:00:00";
	        	echo "<input type='datetime-local' min='$today' class='form-control' onchange='calculateAmt()' name='start_time' id='start_time' required>";
	        	?>
	  			
	        </div>
	        
	        <div class="col">
	        	<label>Estimated End Time</label>
	  			<?php
	  			echo "<input type='datetime-local' min='$today' class='form-control' onchange='calculateAmt()' name='end_time' id='end_time' required>";
	  			?>
	        </div>
	    </div>

	    <div class="form-group">
	    	<label for="description">Description</label>
	    	<textarea name="description" maxlength="300" class="form-control" placeholder="Provide a brief description of the experience"></textarea>
	    </div>

	    <div class="form-group">
	    	<label for="address">Address</label>
	    	<textarea name="address" maxlength="500" class="form-control" placeholder="Include any landmarks and navigation tips" required></textarea>
	    </div>
	    <input type="hidden" value="book_employee" name="book_employee">
	    <div class="row">
	    	<div class="col">
	    		<input type="button" name="new_account" onclick="validateBookingForm()" value="Find Availability" class="btn btn-primary"></input>	
	    	</div>

	    	<div class="col" id="space_for_payment">
	    		
	    	</div>
	    </div>
	  </form>
	</div>

	<br><br>
</body>
</html>
<?php
}
?>