// JavaScript Document
$(document).ready(function(){
	var working = false;
	var employeeID = getUrlParameter('id');
	if( employeeID === undefined || employeeID == '' ){
		window.location.href = "employeemanagement.php";
	}
	populateForm();
	
	$('#formEditEmployee').submit(function(event){
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
			'employeeID'						: employeeID,
			'employeeName'						:$('input[name=employeeName]').val(),
			'employeeCode'						:$('input[name=employeeCode]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/editemployeeprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['adminloggedIn']){				
				//check if it has errors
                if(!data['editSuccess']){
                    $('#editEmployeeResponse').append('<div class="editError text-center red fontsize-xs">' + data['error'] + '</div>');
                }
                else{
					// redirect after editing
					//window.location.href = "profile.php";
					window.location.replace("employeemanagement.php"); // to go back to previous page and refresh
				}
			}
			else{
				// redirect to home page when user is not logged in as admin
                window.location.href = "index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            //window.location.href = "500.php";
		});
		
	});
	
	function populateForm(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'data/getemployeedataprocess.php',		//the url where we want to POST
				data		: {'employeeID': employeeID},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				$("#employeeName").val( data['employee']['name'] ); 
				$("#employeeCode").val( data['employee']['code'] );
			}
			else{
				window.location.href = "employeemanagement.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "500.php";
		});
	}

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO URL Parameter
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};
})

