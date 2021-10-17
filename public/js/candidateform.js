$(function() {
	$.datepicker.setDefaults({
		dateFormat: 'dd/mm/yy'
	});

	$("#dob").datepicker();
	$("#moved_on").datepicker();
	$("#available").datepicker();
	$("#last_contact").datepicker();
	$("#next_contact").datepicker();
});