





function setStar(star_number) {
	$('#stars').val(star_number);

	for (var i = 1; i < 6; i++) {
		if(i <= star_number) {
			//fill
			$('#star_' + i).attr('src', '../images/assets/star_filled.svg');
		} else {
			//unfill
			$('#star_' + i).attr('src', '../images/assets/star_blank.svg');
		}
	}
}