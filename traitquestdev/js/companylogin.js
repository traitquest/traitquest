// JavaScript Document
$(document).ready(function(){
	var working = false;
	$("#companyName").focus();
	
	$('#formCompanyLogin').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors	
		$('.columnError').remove();
        $('.loginError').remove();
		$('.inputForm').each(function(){
            $(this).removeClass('error');
        });
		
		//get the form data
		var formData= {
			'name'				    :$('input[name=company]').val(),
			'email'					:$('input[name=email]').val(),
			'password'				:$('input[name=password]').val()
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
			working = false;
			//here we will handle errors and validation messages
			if(!data['companyLoggedIn'])
			{	
				$('input[name=password]').val('');
				//check if it has errors
                if(data['login']){
					$('#formCompanyLogin')[0].reset();
					
					// redirect to home page when user is logged in
					window.location.href = "admin.php";
                }
                else{
                    if(data['name']){
                        $('#columnCompany').find('.inputForm').addClass('error');
                        $('#columnCompany').append('<div class="columnError text-center red fontsize-xs">' + data['name'] + '</div>');
                    }
                    if(data['email']){
                        $('#columnEmail').find('.inputForm').addClass('error');
                        $('#columnEmail').append('<div class="columnError text-center red fontsize-xs">' + data['email'] + '</div>');
                    }
                    if(data['error']){
                        $('#loginResponse').append('<div class="loginError text-center red fontsize-xs">' + data['error'] + '</div>');
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
	
})