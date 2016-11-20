// JavaScript Document
$(document).ready(function(){
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
			LOGIN
	~~~~~~~~~~~~~~~~~~~~~~~~~~ */	
	var loginWorking = false;
	$('#formEmployeeLogin').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (loginWorking) return false;
		loginWorking = true;
		//clearing messages and errors	
		$('.columnLoginError').remove();
        $('.loginError').remove();
		$('.inputLoginForm').each(function(){
            $(this).removeClass('error');
        });
		
		//get the form data
		var formData= {
			'name'				    :$('input[name=loginCompany]').val(),
			'email'					:$('input[name=loginEmail]').val(),
			'password'				:$('input[name=loginPassword]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/loginprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			loginWorking = false;
			//here we will handle errors and validation messages
			if(!data['loggedIn'])
			{	
				$('input[name=loginPassword]').val('');
				//check if it has errors
                if(data['login']){
					$('#formEmployeeLogin')[0].reset();
					
					// redirect to home page when user is logged in
					window.location.href = "home.php";
                }
                else{
                    if(data['name']){
                        $('#columnLoginCompany').find('.inputLoginForm').addClass('error');
                        $('#columnLoginCompany').append('<div class="columnLoginError text-center red fontsize-s">' + data['name'] + '</div>');
                    }
                    if(data['email']){
                        $('#columnLoginEmail').find('.inputLoginForm').addClass('error');
                        $('#columnLoginEmail').append('<div class="columnLoginError text-center red fontsize-s">' + data['email'] + '</div>');
                    }
                    if(data['error']){
                        $('#loginResponse').append('<div class="loginError text-center red fontsize-s">' + data['error'] + '</div>');
                    }
                }
			}
			else{
				// redirect to home page when user is logged in
                window.location.href = "home.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
			COMPANY LOGIN
	~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	var companyLoginWorking = false;
	$('#formCompanyLogin').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (companyLoginWorking) return false;
		companyLoginWorking = true;
		
		//clearing messages and errors	
		$('.columnCompanyLoginError').remove();
        $('.companyLoginError').remove();
		$('.inputCompanyLoginForm').each(function(){
            $(this).removeClass('error');
        });
		
		//get the form data
		var formData= {
			'name'				    :$('input[name=companyLoginCompany]').val(),
			'email'					:$('input[name=companyLoginEmail]').val(),
			'password'				:$('input[name=companyLoginPassword]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/companyloginprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			companyLoginWorking = false;	
			//here we will handle errors and validation messages
			if(!data['companyLoggedIn'])
			{	
				$('input[name=companyLoginPassword]').val('');
				//check if it has errors
                if(data['login']){
					$('#formCompanyLogin')[0].reset();
					
					// redirect to home page when user is logged in
					window.location.href = "admin.php";
                }
                else{
                    if(data['name']){
                        $('#columnCompanyLoginCompany').find('.inputCompanyLoginForm').addClass('error');
                        $('#columnCompanyLoginCompany').append('<div class="companyLoginError text-center red fontsize-s">' + data['name'] + '</div>');
                    }
                    if(data['email']){
                        $('#columnCompanyLoginEmail').find('.inputCompanyLoginForm').addClass('error');
                        $('#columnCompanyLoginEmail').append('<div class="companyLoginError text-center red fontsize-s">' + data['email'] + '</div>');
                    }
                    if(data['error']){
                        $('#companyLoginResponse').append('<div class="companyLoginError text-center red fontsize-s">' + data['error'] + '</div>');
                    }
                }
			}
			else{
				// redirect to home page when user is logged in
                window.location.href = "admin.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
			FORGOTTEN PASSWORD
	~~~~~~~~~~~~~~~~~~~~~~~~~~ */	
	var forgottenPasswordWorking = false;	
	$('#formForgottenPassword').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (forgottenPasswordWorking) return false;
		forgottenPasswordWorking = true;
		
		//clearing messages and errors	
        $('.forgottenPasswordError').remove();
        $('.forgottenPasswordSuccess').remove();
		
		//get the form data
		var formData= {
			'email'					:$('input[name=forgottenPasswordEmail]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/forgottenpasswordprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			forgottenPasswordWorking = false;
			//here we will handle errors and validation messages
			if(!data['loggedIn'])
			{			
				//check if it has errors or password has been reset
                if(data['passwordReset']){
					$('#formForgottenPassword')[0].reset();
					if(data['success']){
                        $('#forgottenPasswordResponse').append('<div class="forgottenPasswordSuccess text-center green fontsize-s">' + data['success'] + '</div>');
                    }
                }
                else{
                    if(data['error']){
                        $('#forgottenPasswordResponse').append('<div class="forgottenPasswordError text-center red fontsize-s">' + data['error'] + '</div>');
                    }
                }
			}
			else{
				// redirect to home page when user is logged in
                window.location.href = "home.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
			REGISTER
	~~~~~~~~~~~~~~~~~~~~~~~~~~ */	
	var registerWorking = false;	
	$('#formRegister').submit(function(event){
		
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (registerWorking) return false;
		registerWorking = true;
		
		//clearing messages and errors
		$('.columnRegisterError').remove();
        $('.registerSuccess').remove();
        $('.registerError').remove();
		$('.inputRegisterForm').each(function(){
            $(this).removeClass('error');
        });
				
		//get the form data
		var formData= {
			'company'				    :$('input[name=registerCompany]').val(),
			'name'						:$('input[name=registerName]').val(),
			'email'						:$('input[name=registerEmail]').val(),
			'phone'						:$('input[name=registerPhoneNumber]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/registerprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			registerWorking = false;
			//here we will handle errors and validation messages
			if(!data['userLoggedIn'])
			{	
				//check if it has errors
                if(data['registered']){
                    $('#registerResponse').append('<div class="registerSuccess text-center green fontsize-s">' + data['message'] + '</div>');
                    $('#formRegister')[0].reset();
                }
                else{
                    if(data['company']){
                        $('#columnRegisterCompanyName').find('.inputRegisterForm').addClass('error');
                        $('#columnRegisterCompanyName').append('<div class="columnRegisterError text-center red fontsize-s">' + data['company'] + '</div>');
                    }
					if(data['name']){
                        $('#columnRegisterName').find('.inputRegisterForm').addClass('error');
                        $('#columnRegisterName').append('<div class="columnRegisterError text-center red fontsize-s">' + data['name'] + '</div>');
                    }
                    if(data['email']){
                        $('#columnRegisterEmail').find('.inputRegisterForm').addClass('error');
                        $('#columnRegisterEmail').append('<div class="columnRegisterError text-center red fontsize-s">' + data['email'] + '</div>');
                    }
					if(data['phone']){
                        $('#columnRegisterPhoneNumber').find('.inputRegisterForm').addClass('error');
                        $('#columnRegisterPhoneNumber').append('<div class="columnRegisterError text-center red fontsize-s">' + data['phone'] + '</div>');
                    }
                    if(data['error']){
                        $('#registerResponse').append('<div class="registerError text-center red fontsize-s">' + data['error'] + '</div>');
                    }
                }
			}
			else{
				// redirect to home page when user is logged in
                window.location.href = "home.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
			CONTACT
	~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	var contactWorking = false;	
	$('#formContact').submit(function(event){
		event.preventDefault();
		var selectorSubject = document.getElementById("subject");
		var selectedSubject = selectorSubject.options[selectorSubject.selectedIndex].value;
		
		//to prevent multiple submission when multiple click on submit button
		if (contactWorking) return false;
		contactWorking = true;
		
		//clearing messages and errors	
		$('.columnMessageError').remove();
		$('.columnMessageSuccess').remove();
		$('.inputMessageForm').each(function(){
            $(this).removeClass('error');
        });
		
		//get the form data
		var formData= {
			'name'				    :$('input[name=name]').val(),
			'email'					:$('input[name=contactemail]').val(),
			'subject'				:selectedSubject,
			'message'				:$("#message").val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/contactprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			contactWorking = false;
			//here we will handle errors and validation messages

			//check if it has errors
			if(data['sentMessage']){
				$('#formContact')[0].reset();
				
				if(data['response']){
					$('#contactResponse').append('<div class="columnMessageSuccess text-center green fontsize-xs">' + data['response'] + '</div>');
				}
			}
			else{
				if(data['name']){
					$('#columnContactName').find('.inputMessageForm').addClass('error');
					$('#columnContactName').append('<div class="columnMessageError text-center red fontsize-s">' + data['name'] + '</div>');
				}
				if(data['email']){
					$('#columnContactEmail').find('.inputMessageForm').addClass('error');
					$('#columnContactEmail').append('<div class="columnMessageError text-center red fontsize-s">' + data['email'] + '</div>');
				}
				if(data['message']){
					$('#columnMessage').find('.inputMessageForm').addClass('error');
					$('#columnMessage').append('<div class="columnMessageError text-center red fontsize-s">' + data['message'] + '</div>');
				}
				
			}

		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
	
})