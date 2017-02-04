// JavaScript Document
$(document).ready(function(){
	var employeeID = getUrlParameter('id');
	if( employeeID === undefined || employeeID == '' ){
		window.location.href = "all.php";
	}
	$('#editlink').attr('href', 'edit.php?id='+employeeID);
	populateData();
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO POPULATE THE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function populateData(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'../../data/admin/employee/getemployeedataprocess.php',		//the url where we want to POST
				data		: {'employeeID': employeeID},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				// General
				$("#employeePic").attr('src', data['employee']['imagelink'] );
				$("#employeeName").append( data['employee']['name'] ); 
				$("#employeeEmail").append( data['employee']['email'] ); 
				$("#employeeDepartment").append( data['department']['name'] );
				$("#employeeExt").append( data['employee']['ext'] );
				$("#employeeHiredDate").append( data['employee']['hireddate'] );
				
				// Personal info
				$("#employeePhone").append( data['employee']['phone'] );
				$("#employeeDOB").append( data['employee']['dob'] );
				$("#employeeNationality").append( data['employee']['nationality'] );
				$("#employeeRace").append( data['employee']['race'] );
				$("#employeeReligion").append( data['employee']['religion'] );
				$("#employeeMaritalStatus").append( data['employee']['maritalstatus'] );
				$("#employeeBio").append( data['employee']['bio'] );
				
				// Employee info
				$("#employeeCode").append( data['employee']['code'] );
				$("#employeeAddress").append( data['employee']['address'] );
				$("#employeeBank").append( data['employee']['bank'] );
				$("#employeeEpf").append( data['employee']['epf'] );
				$("#employeeSocso").append( data['employee']['socso'] );
				
				// Emergency contact info
				$("#employeeEmergencyContactName").append( data['employee']['emergencycontactname'] );
				$("#employeeEmergencyContactRelationship").append( data['employee']['emergencycontactrelationship'] );
				$("#employeeEmergencyContactPhone").append( data['employee']['emergencycontactphone'] );
				$("#employeeEmergencyContactAltPhone").append( data['employee']['emergencycontactaltphone'] );
			}
			else{
				// go back to previous page
				window.history.back();
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
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

