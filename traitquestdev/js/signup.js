// JavaScript Document
$(document).ready(function(){
	var working = false;
	$("#companyName").focus();
	
	$('#formCompanySignUp').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors
		$('.columnError').remove();
        $('.signupSuccess').remove();
        $('.signupError').remove();
		$('.inputForm').each(function(){
            $(this).removeClass('error');
        });
				
		//get the form data
		var formData= {
			'name'				    :$('input[name=company]').val(),
			'email'					:$('input[name=email]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/signupprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(!data['userLoggedIn'])
			{	
				$('input[name=password]').val('');
				//check if it has errors
                if(data['registered']){
                    $('#signupResponse').append('<div class="signupSuccess">' + data['message'] + '</div>');
                    $('#formCompanySignUp')[0].reset();
                }
                else{
                    if(data['name']){
                        $('#columnCompany').find('.inputForm').addClass('error');
                        $('#columnCompany').append('<div class="columnError">' + data['name'] + '</div>');
                    }
                    if(data['email']){
                        $('#columnEmail').find('.inputForm').addClass('error');
                        $('#columnEmail').append('<div class="columnError">' + data['email'] + '</div>');
                    }
                    if(data['error']){
                        $('#signupResponse').append('<div class="signupError">' + data['error'] + '</div>');
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