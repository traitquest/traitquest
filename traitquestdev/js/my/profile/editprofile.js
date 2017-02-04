// JavaScript Document
$(document).ready(function(){
	var working = false;	
	var day, month, year;
	populateForm();
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SELECT A DATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#datepicker').datepicker()
		.on('changeDate', function(ev) {
			selectedDate = new Date(ev.date);
			day = selectedDate.getDate();
			month = selectedDate.getMonth() + 1; //months from 1-12
			year = selectedDate.getFullYear();
	});
	
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
			'phone'						:$('input[name=phone]').val(),
			'dobDay'					:day,
			'dobMonth'					:month,
			'dobYear'					:year,
			'nationality'				:$("#nationality").val(),
			'race'				   		:$("#race").val(),
			'religion'				    :$('input[name=religion]').val(),
			'maritalStatus'				:$("#maritalStatus").val(),
			'bio'				  		:$("#bio").val(),
			'address'				    :$("#address").val(),
			'emergencyContactName'			:$('input[name=emergencyContactName]').val(),
			'emergencyContactRelationship'	:$('input[name=emergencyContactRelationship]').val(),
			'emergencyContactPhone'			:$('input[name=emergencyContactPhone]').val(),
			'emergencyContactAltPhone'		:$('input[name=emergencyContactAltPhone]').val()
			
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/my/profile/editprofileprocess.php',		//the url where we want to POST
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
		
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			GO BACK TO PREVIOUS PAGE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	this.getElementById('editProfileCancel').addEventListener('click',function(){
		window.history.back();
	}, false);
	
	function populateForm(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'../../data/my/profile/getemployeeprocess.php',		//the url where we want to POST
				data		: {},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				$("#phone").val( data['employee']['phone'] ); 
				// Split timestamp into [ Y, M, D, h, m, s ]
				var t = data['employee']['dob'];
				var date = t.split(/[-]/);
				// Apply each element to the Date function
				var d = new Date(Date.UTC(date[0], date[1]-1, date[2]));
				year = date[0];
				month = date[1]-1;
				day = date[2];
				$('#datepicker').datepicker('setValue', d );
				$("#nationality").val( data['employee']['nationality'] ); 
				$("#race").val( data['employee']['race'] );
				$("#religion").val( data['employee']['religion'] );
				$("#maritalStatus").val( data['employee']['maritalstatus'] );
				$("#bio").val( data['employee']['bio'] );
				$("#address").val( data['employee']['address'] );
				$("#emergencyContactName").val( data['employee']['emergencycontactname'] );
				$("#emergencyContactRelationship").val( data['employee']['emergencycontactrelationship'] );
				$("#emergencyContactPhone").val( data['employee']['emergencycontactphone'] );
				$("#emergencyContactAltPhone").val( data['employee']['emergencycontactaltphone'] );
			}
			else{
				window.location.href = "../../index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){console.log(data);
			window.location.href = "../../500.php";
		});
	}
	
})


