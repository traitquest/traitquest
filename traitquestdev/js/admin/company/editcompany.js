// JavaScript Document
$(document).ready(function(){
	var working = false;
	populateForm();
	
	$('#formEditCompany').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors
		$('#editResponse').empty();
				
		//get the form data
		var formData= {
			'address'				    :$("#address").val(),
			'phone'						:$('input[name=phone]').val(),
			'fax'						:$('input[name=fax]').val(),
			'website'					:$('input[name=website]').val(),
			'description'				:$("#description").val(),
			'vision'					:$("#vision").val(),
			'mission'					:$("#mission").val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/company/editcompanyprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['adminLoggedIn']){				
				//check if it has errors
                if(!data['editSuccess']){
					$('#editResponse').append('<div class="editError text-center red fontsize-xs">' + data['error'] + '</div>');
                }
                else{
					// redirect after editing
					window.history.back();
				}
			}
			else{
				// redirect to home page when user is not logged in
                window.location.href = "../../index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "../../500.php";
		});
		
	});
	
	this.getElementById('editCompanyCancel').addEventListener('click',function(){
		window.history.back();
	}, false);
})


function populateForm(){
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/company/getcompanyprocess.php',		//the url where we want to POST
			data		: {},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){
		if(data['return']){
			$("#address").val( data['company']['address'] ); 
			$("#phone").val( data['company']['phone'] );
			$("#fax").val( data['company']['fax'] );
			$("#website").val( data['company']['website'] );
			$("#description").val( data['company']['description'] );
			$("#vision").val( data['company']['vision'] );
			$("#mission").val( data['company']['mission'] );
		}
		else{
			window.location.href = "../../index.php";
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "../../500.php";
	});
}