// JavaScript Document
$(document).ready(function(){
	var working = false;
	$("#email").focus();
	
	$('#formForgottenPassword').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors	
        $('.error').remove();
        $('.success').remove();
		
		//get the form data
		var formData= {
			'email'					:$('input[name=email]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/forgottenpasswordprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(!data['loggedIn'])
			{			
				//check if it has errors or password has been reset
                if(data['passwordReset']){
					$('#formForgottenPassword')[0].reset();
					if(data['success']){
                        $('#response').append('<div class="success">' + data['success'] + '</div>');
                    }
                }
                else{
                    if(data['error']){
                        $('#response').append('<div class="error">' + data['error'] + '</div>');
                    }
                }
			}
			else{
				// redirect to home page when user is logged in
                window.location.href = "home";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500";
		});
		
	});
	
})