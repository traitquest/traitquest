// JavaScript Document
$(document).ready(function(){
	var working = false;
	populateForm();
	
	$('#formEditProfile').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors
		$('.columnError').remove();
        $('.editSuccess').remove();
        $('.editError').remove();
		$('.inputForm').each(function(){
            $(this).removeClass('error');
        });
				
		//get the form data
		var formData= {
			'address'				    :$("#address").val(),
			'phone'						:$('input[name=phone]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/editprofileprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['loggedIn']){				
				//check if it has errors
                if(!data['editSuccess']){
                    $('#editResponse').append('<div class="editError text-center red fontsize-xs">' + data['error'] + '</div>');
                }
                else{
					// redirect after editing
					window.location.href = "profile.php";
				}
			}
			else{
				// redirect to home page when user is not logged in
                window.location.href = "index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
})


function populateForm(){
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/getemployeeprocess.php',		//the url where we want to POST
			data		: {},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){
		if(data['return']){
			$("#address").val( data['employee']['address'] ); 
			$("#phone").val( data['employee']['phone'] );
		}
		else{
			window.location.href = "index.php";
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "500.php";
	});
}