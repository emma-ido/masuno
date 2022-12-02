



function validateBookingForm() {
	var start_time = $('#start_time');
	var end_time = $('#end_time');

	// console.log(start_time.val());
	// console.log(end_time.val());

	var startTime = new Date(start_time.val());
	var endTime = new Date(end_time.val());

	if(endTime.getTime() <= startTime.getTime()) {
		// error messages
		$("#timeError").html("End time must be greater than start");
		// console.log("End time must be greater than start");
		return;
	}
	$("#timeError").html("");

	if(startTime.getMonth() != endTime.getMonth() || startTime.getDate() != endTime.getDate() || 
		startTime.getFullYear() != endTime.getFullYear()) {
		$("#timeError").html("Booking must be done on the same day");
		return;
	}
	$("#timeError").html("");

	checkAvailability();
}


function checkAvailability() {
	$.post('../api/booking_api.php', 
		{check_employee_availability: 'yes', start_time: $('#start_time').val(), end_time: $('#end_time').val()},
		function(data) {
			if(data == "NO") {
				// error messages
				// console.log("failed");
				$('#payment_button').remove();
			} else {
				$("#space_for_payment").append("<button id='payment_button' class='btn btn-success'>Proceed to payment</button>");
				// console.log("success");
			}
		}
	);
	
}