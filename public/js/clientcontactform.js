$(function() {
	$.datepicker.setDefaults({
		dateFormat: 'dd/mm/yy'
	});
	
	$("#last_contact").datepicker();
	$("#next_contact").datepicker();
});