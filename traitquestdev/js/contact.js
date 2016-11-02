// JavaScript Document
$(document).ready(function(){
	var working = false;
	
	
	$('#formContact').submit(function(event){
		event.preventDefault();
		var selectorSubject = document.getElementById("subject");
		var selectedSubject = selectorSubject.options[selectorSubject.selectedIndex].value;
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
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
			working = false;
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
					$('#columnContactName').append('<div class="columnMessageError text-center red fontsize-xs">' + data['name'] + '</div>');
				}
				if(data['email']){
					$('#columnContactEmail').find('.inputMessageForm').addClass('error');
					$('#columnContactEmail').append('<div class="columnMessageError text-center red fontsize-xs">' + data['email'] + '</div>');
				}
				if(data['message']){
					$('#columnMessage').find('.inputMessageForm').addClass('error');
					$('#columnMessage').append('<div class="columnMessageError text-center red fontsize-xs">' + data['message'] + '</div>');
				}
				
			}

		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500.php";
		});
		
	});
	
})