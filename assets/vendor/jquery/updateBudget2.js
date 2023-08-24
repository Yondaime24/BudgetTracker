$(function(){
	var $registerForm = $("#updateAmount");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");
	
	$.validator.addMethod("amountvalue", function (value, element){
		return this.optional(element) || /^[0-9\.]+$/i.test(value);
	}, "Must consist of numbers only!");

	if ($registerForm.length) {
		$registerForm.validate({
			rules:{
				amount:{
					required: true,
					noSpace: true,
					amountvalue: true,
				}
			},
			messages:{
				amount:{
					required: 'Please enter amount!',
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})