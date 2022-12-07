

function validateCustomerRegister() {

	const pass1 = $('#pass').val();
	const pass2 = $('#pass2').val();
	if(pass1 !== pass2) {
		$('#passError').html("Passwords do not match");
		return;
	} else {
		$('#passError').html("");
	}

	$('#customer_register_form').submit();
}