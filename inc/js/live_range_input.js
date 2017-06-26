$(function(){
	$("#select_prix").after('<span id="range_input"></span>');
	$("#select_prix").live('change', function(){
		var valof = $(this).val();
		$('#range_input').text("maximum : "+valof+" €");
	});
});