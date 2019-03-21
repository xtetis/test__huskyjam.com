






$(function () {



	$('.datestartend').mask("99:99");


	$(".floatval").on("keypress", function (e) {	
		return (e.which !== 8 && e.which !== 0 && (e.which !== 46 || $(this).val().indexOf(".") !== -1) && (e.which < 48 || e.which > 57)) ? false : true;
	});

});