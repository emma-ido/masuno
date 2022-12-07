<?php
include_once('../settings/core.php');
include_once('../actions/booking_functions.php');
include_once('../controllers/customer_controller.php');

$customer_id = getCustomerId();
$email = get_email($customer_id);
if($customer_id == -1) {
	header("Location: ../login/customer_login.php?error=You must be logged in to continue");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bookings</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

	<?php include_once("navbar.php") ?>
    <br><br>

	<script src="https://js.paystack.co/v1/inline.js"></script>
	<script type="text/javascript" src="../js/booking.js"></script>
	<?php echo "<input type='hidden' id='email-address' value='$email'>"; ?>
	<div style="text-align: center;">
    	<h4>Manage Bookings</h4>
    	<a href="past_bookings.php" style="border-bottom-left-radius: 20px;border-top-left-radius: 20px;" class="btn btn-primary">RESET</a>
	    <a href="past_bookings.php?status=Rejected" class="btn btn-danger">REJECTED</a> <a href="past_bookings.php?status=Accepted" class="btn btn-info">ACCEPTED</a> <a href="past_bookings.php?status=Pending" class="btn btn-warning">PENDING</a> <a style="border-bottom-right-radius: 20px;border-top-right-radius: 20px;" href="past_bookings.php?status=Paid" class="btn btn-success">PAID</a> <br><br><br>
	</div>

	<div class="mx-auto" style='text-align: center;'>
		<?php
		    if(isset($_GET["error"])) {
		    	echo "<span style='text-align: center;' class='badge badge-danger'>$_GET[error]</span>";
		    } else if(isset($_GET["success"])) {
		    	echo "<span class='badge badge-success'>$_GET[success]</span>";
		    } 
	  	?>
		<div class="container">
			<table class="table table-hover">
			  <thead class="thead-dark">
			    <tr>
			    	<th scope="col">Employee</th>
			    	<th scope="col">Start</th>
			    	<th scope="col">End</th>
			        <th scope="col">Event Type</th>
			        <th scope="col">Info</th>
			        <th scope="col">Price (GHC)</th>
			        <th scope="col">Status</th>
			    </tr>
			  </thead>
			  <tbody>

			    <?php 
			    	if(isset($_GET["status"])) {
			    		$status = $_GET["status"];
			    		if($status == "Pending" || $status == "Accepted" || $status == "Rejected" || $status == "Paid") {
			    			get_bookings_tabular_customer($customer_id, $status);	
			    		}
			    	} else {
			    		get_bookings_tabular_customer($customer_id, null);
			    	}
			    ?>
			    
			  </tbody>
			</table>
		</div>
	</div>

	<!-- Button trigger modal -->
	<button type="button" id="trigger_button" style="display: none;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
	  Launch demo modal
	</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Booking details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<span><span class="font-weight-bold">Description:</span> <span id="description-field"></span></span>
	      	<br><br>
	        <span><span class="font-weight-bold">Address: </span><span id="address-field"></span></span>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>