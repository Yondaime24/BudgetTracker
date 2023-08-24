$(function(){
	var $registerForm = $("#updateExpenses");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");
	
	$.validator.addMethod("amountvalue", function (value, element){
		return this.optional(element) || /^[0-9\.]+$/i.test(value);
	}, "Must consist of numbers only!");

	$.validator.addMethod("lettersonly", function (value, element){
		return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
	}, "Must consist of letters only!");

	if ($registerForm.length) {
		$registerForm.validate({
			rules:{
				amount:{
					required: true,
					noSpace: true,
					amountvalue: true,
				}, 
				expensename:{
					required: true,
					noSpace: true,
					lettersonly: true
				}
			},
			messages:{
				amount:{
					required: 'Please enter amount!',
				},
				expensename:{
					required: 'Please enter expense name!',
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})