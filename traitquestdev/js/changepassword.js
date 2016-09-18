// JavaScript Document
$(document).ready(function(){
	var working = false;
	$("#oldPassword").focus();
	
	$('#formChangePassword').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors	
        $('.error').remove();
        $('.success').remove();
		
		//get the form data
		var formData= {
			'oldPassword'					:$('input[name=oldPassword]').val(),
			'newPassword'					:$('input[name=newPassword]').val(),
			'retypePassword'				:$('input[name=retypePassword]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/changepasswordprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['loggedIn'])
			{			
				//check if it has errors or password has been reset
                if(data['passwordChanged']){
					$('#formChangePassword')[0].reset();
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
				// redirect to login page when user is not logged in
                window.location.href = "login";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500";
		});
		
	});
	
})