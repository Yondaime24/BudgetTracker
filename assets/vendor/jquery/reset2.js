$(function(){
	var $loginForm = $("#reset");

	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Spaces are not allowed!");
	
	$.validator.addMethod("usernamevalues", function (value, element){
		return this.optional(element) || /^[a-zA-Z0-9\.\_\@\s]+$/i.test(value);
	}, "Must consist of alphabetical, numeric, dot, @ and underscore only!");

	if ($loginForm.length) {
		$loginForm.validate({
			rules:{
				email_address:{
					required: true,
					noSpace: true
				},
				password:{
					required: true,
					minlength: 8
				}
			},
			messages:{
				email_address:{
					required: 'Please enter email address!'
				},
				password: {
					required: 'Please enter password!',
					minlength: 'Password length must be equal or greater than 8'
				}
			},
			errorPlacement: function(error, element){
				error.appendTo(element.parents(".validate"));
			}
		})
	}
})