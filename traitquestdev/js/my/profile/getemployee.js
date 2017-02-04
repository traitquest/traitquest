// JavaScript Document
$(document).ready(function(){
	var employeeID = getUrlParameter('id');
	if( employeeID === undefined || employeeID == '' ){
		employeeID = 0;
	}
	populateData();

	function populateData(){
		/* ~~~~~~~~~~~~~~~~~~~~~~~~~
			GET EMPLOYEE DATA
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'../../data/my/profile/getemployeeprocess.php',		//the url where we want to POST
				data		: {'employeeID': employeeID},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				if(!data['ownProfile']){
					$(".private").each(function(){
						$(this).remove();
					});
					$("#uploadPicButton").remove();
					$("#editProfileButton").remove();
				}
				else{
					// for private data
					$("#employeeBank").append( data['employee']['bank'] );
					$("#employeeEpf").append( data['employee']['epf'] );
					$("#employeeSocso").append( data['employee']['socso'] );	
				}
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
				
				// Emergency contact info
				$("#employeeEmergencyContactName").append( data['employee']['emergencycontactname'] );
				$("#employeeEmergencyContactRelationship").append( data['employee']['emergencycontactrelationship'] );
				$("#employeeEmergencyContactPhone").append( data['employee']['emergencycontactphone'] );
				$("#employeeEmergencyContactAltPhone").append( data['employee']['emergencycontactaltphone'] );
			}
			else{
				window.location.href = "../../index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
		});
		
		/* ~~~~~~~~~~~~~~~~~~~~~~~~~
		GET SUPERVISOR/SUBORDINATE DATA
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'../../data/my/profile/getsupervisorsubordinate.php',		//the url where we want to POST
				data		: {'employeeID': employeeID},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				var html;
				// for supervisors
				var supervisorTarget = $('#superiorList');
				if(data['superiorResponse'] == 'noResult'){
					html = '<p>No records found</p>';
					supervisorTarget.append(html);
				}
				else{
					var superiorResultNumber = data['superior'].length;
								
					for(var i=0; i<superiorResultNumber; i++){
						html = '<div class="padding-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
							    + '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['superior'][i]['data']['imagelink'] + '">'
								+ '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-6 col-xs-6">'
								+ '<li>' + data['superior'][i]['data']['name'] + '</li>'
								+ '<li>' + data['superior'][i]['data']['email'] + '</li>'
								+ '</ul></div>';
						
						supervisorTarget.append(html);
					}
				}	
				
				// for subordinates			
				var subordinateTarget = $('#subordinateList');	
				if(data['subordinateResponse'] == 'noResult'){
					html = '<p>No records found</p>';
					subordinateTarget.append(html);
				}
				else{
					var subordinateResultNumber = data['subordinate'].length;		
					for(var i=0; i<subordinateResultNumber; i++){
						html = '<div class="padding-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
							    + '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['subordinate'][i]['data']['imagelink'] + '">'
								+ '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-6 col-xs-6">'
								+ '<li>' + data['subordinate'][i]['data']['name'] + '</li>'
								+ '<li>' + data['subordinate'][i]['data']['email'] + '</li>'
								+ '</ul></div>';
						
						subordinateTarget.append(html);
					}
				}
				
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

	function nl2br (str, is_xhtml) {   
		var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
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

