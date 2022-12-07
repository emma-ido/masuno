

function calculateAmt() {
	$('#payment_button').remove();
	// console.log("I have changed");
	const hourlyRate = $("#hourly_rate").val();

	var start_time = $('#start_time');
	var end_time = $('#end_time');

	var startTime = new Date(start_time.val());
	var endTime = new Date(end_time.val());	

	// console.log(end_time.val());
	// console.log(start_time.val());

	if(end_time.val() != "" && start_time.val() != "") {
		var hours = (endTime.getHours() + (endTime.getMinutes()/60)) - (startTime.getHours() + (startTime.getMinutes()/60));
		var amount = hours * hourlyRate;
		var newAmount = amount.toFixed(2);
		$('#amount').val(newAmount);//(Math.round(amount) * 100) /100
	}
}


function validateBookingForm() {
	$('#payment_button').remove();
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
		{check_employee_availability: 'yes', start_time: $('#start_time').val(), end_time: $('#end_time').val(), employee_id: $('#employee_id').val()},
		function(data) {
			if(data == "NO") {
				// error messages
				$('#timeError').html("Employee is not available at that time. Select another time");
			} else {
				$('#timeError').html("");
				$("#space_for_payment").append("<button id='payment_button' onclick='confirmAndSubmit()' class='btn btn-success'>Confirm Booking</button>");
				// console.log("success");
				
			}
		}
	);
}

function getCustomerInfo(customerId) {
	$.get("../api/customer_api.php", {email: "yes", customer_id: customerId}, 
		function(data) {
			$("#email-field").html(data);
		}
	);

	$.get("../api/customer_api.php", {phone: "yes", customer_id: customerId}, 
		function(data) {
			$("#phone-field").html(data);
		}
	);

	$.get("../api/customer_api.php", {name: "yes", customer_id: customerId}, 
		function(data) {
			$("#name-field").html(data);
		}
	);
	$('#customer_details_trigger').click();
}

function getBookingInfo(bookingId) {
	getBookingDescription(bookingId);
	getBookingAddress(bookingId);
	$('#trigger_button').click();
}

function getBookingDescription(bookingId) {
	$.get("../api/booking_description_and_address.php", {description: "yes", booking_id: bookingId}, 
		function(data) {
			$("#description-field").html(data);
		}
	);
}


function getBookingAddress(bookingId) {
	$.get("../api/booking_description_and_address.php", {address: "yes", booking_id: bookingId}, 
		function(data) {
			$("#address-field").html(data);
		}
	);	
}


function acceptBooking(bookingId) {
	$.post('../api/accept_booking.php', {accept_booking: "accept_booking", booking_id: bookingId},
		function(data) {
			if(data == "YES") {
				location.reload();
			} else {
				location.reload();
			}
		}
		);
}

function rejectBooking(bookingId) {
	$.post('../api/reject_booking.php', {reject_booking: "reject_booking", booking_id: bookingId},
		function(data) {
			if(data == "YES") {
				location.reload();
			} else {
				location.reload();
			}
		}
		);
}

function confirmAndSubmit() {
	$('#bookEmployeeForm').submit();
}

function payWithPaystack(amount, bookingId) {
	// $('#exampleModal').modal('hide');
  event.preventDefault();

  let handler = PaystackPop.setup({
    // key: 'pk_test_xxxxxxxxxx', // Replace with your public key
    // my test_key: pk_test_618b2a128cb38615a9db7357f9d5e8b5b85ebb13
    // live key: pk_live_bd5356607a881f3a0d6843b75d3172b74b9675cd
    key: 'pk_test_618b2a128cb38615a9db7357f9d5e8b5b85ebb13',
    email: document.getElementById("email-address").value,
    currency: 'GHS',
    amount: amount * 100,//document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      // alert(response);
      // console.log(response);

      if(response.status == "success") {
      	// $.get('../actions/process_paystack.php?ref=' + response.reference, function(data) {
        // 	alert(data);
      	// });	
      	// // demo(3000);
      	$.post('../api/pay_for_booking.php', {pay_for_booking: "pay", booking_id: bookingId}, 
      		function(data) {
      			if(data == "YES") {
					location.reload();
				} else {
					location.reload();
				}
      		}
      		);
      } else {
      	alert("Transaction Failed!");
      }
      

      // $('#select_seats_form').submit();
    
    }
  });

  handler.openIframe();
}