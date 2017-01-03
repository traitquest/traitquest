// JavaScript Document
$(document).ready(function(){
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
		console.log(formData);
		
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
            //window.location.href = "500.php";
		});
		
	});
	
})