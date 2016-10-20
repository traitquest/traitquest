// JavaScript Document
$(document).ready(function(){
	var working = false;
	$("#companyName").focus();
	
	$('#formRegister').submit(function(event){
		
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors
		$('.columnError').remove();
        $('.registerSuccess').remove();
        $('.registerError').remove();
		$('.inputForm').each(function(){
            $(this).removeClass('error');
        });
				
		//get the form data
		var formData= {
			'company'				    :$('input[name=company]').val(),
			'email'						:$('input[name=email]').val(),
			'phone'						:$('input[name=phonenumber]').val(),
			'address'					:$("#address").val()
		};
		console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/registerprocess.php',		//the url where we want to POST
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
				//check if it has errors
                if(data['registered']){
                    $('#registerResponse').append('<div class="registerSuccess text-center green fontsize-xs">' + data['message'] + '</div>');
                    $('#formRegister')[0].reset();
                }
                else{
                    if(data['company']){
                        $('#columnName').find('.inputForm').addClass('error');
                        $('#columnName').append('<div class="columnError text-center red fontsize-xs">' + data['company'] + '</div>');
                    }
                    if(data['email']){
                        $('#columnEmail').find('.inputForm').addClass('error');
                        $('#columnEmail').append('<div class="columnError text-center red fontsize-xs">' + data['email'] + '</div>');
                    }
					if(data['phone']){
                        $('#columnPhoneNumber').find('.inputForm').addClass('error');
                        $('#columnPhoneNumber').append('<div class="columnError text-center red fontsize-xs">' + data['phone'] + '</div>');
                    }
					if(data['address']){
                        $('#columnAddress').find('.inputForm').addClass('error');
                        $('#columnAddress').append('<div class="columnError text-center red fontsize-xs">' + data['address'] + '</div>');
                    }
                    if(data['error']){
                        $('#registerResponse').append('<div class="registerError text-center red fontsize-xs">' + data['error'] + '</div>');
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
	
})