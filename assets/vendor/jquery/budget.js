$(function(){
	var $budgetForm = $("#addBudget");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");

	$.validator.addMethod("numbersonly", function (value, element){
		return this.optional(element) || /^[0-9]+$/i.test(value);
	}, "Must consist of numbers only!");

	if ($budgetForm.length) {
		$budgetForm.validate({
			rules:{
				amount:{
					required: true,
					noSpace: true,
					numbersonly: true
				}
			},
			messages:{
				amount:{
					required: 'Please enter amount!',
					numbersonly: 'Must consist of numbers only!'
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})