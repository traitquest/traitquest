// JavaScript Document
$(document).ready(function(){
	var working = false;
	var month = getUrlParameter('month');
	var year = getUrlParameter('year');	
	var employeeID = getUrlParameter('eid');
	if( employeeID === undefined || employeeID == '' || month === undefined || month == '' || year === undefined || year == '' ){
		window.history.back();
	}
	
	// To get the KRA & KPI template from database
	var kraTemplate = new Array();
	var kpiTemplate = new Array();
	getKRAKPI();
	
	var kpiID = getUrlParameter('id');
	var kpiAction = 'edit';
	if( kpiID === undefined || kpiID == '' ){
		kpiAction = 'new';
	}
	
	if( kpiAction == 'edit' ){		
		// for edit, get info from database and populate the form
		populateForm();
	}
	else{		
		
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	UPDATE KPI TEMPLATE BASED ON SELECTED KRA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	 $("#kra").change(function () {
		var kpiDropdown = document.getElementById('kpi');
		$('#kpi').empty();
		
		var opt = document.createElement('option');
		opt.value = 0;
		opt.innerHTML = 'Select a KPI';
		kpiDropdown.appendChild(opt);
		opt.disabled = true;
		
		for(var i = 0; i < kpiTemplate.length; i++){
			if( $(this).val() == kpiTemplate[i]['kraid'] ){
				var opt = document.createElement('option');
				opt.value = kpiTemplate[i]['id'];
				opt.innerHTML = kpiTemplate[i]['title'];
				kpiDropdown.appendChild(opt);
			}
		}
	});
			
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			GET KRA & KPI TEMPLATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getKRAKPI(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'data/getkrakpi.php',		//the url where we want to POST
				data		: {},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			kraTemplate = data['kraTemplate'];
			kpiTemplate = data['kpiTemplate'];
			
			// add the kra to the dropdown
			addKRAOption(kraTemplate);
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "500.php";
		});
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			ADD OPTION OF KRA DROPDOWN
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function addKRAOption(kraTemplate){
		var kraDropdown = document.getElementById('kra');
		$('#kra').empty();
		
		var opt = document.createElement('option');
		opt.value = 0;
		opt.innerHTML = 'Select a KRA';
		kraDropdown.appendChild(opt);
		opt.disabled = true;
		
		for(var i = 0; i < kraTemplate.length; i++){
			var opt = document.createElement('option');
			opt.value = kraTemplate[i]['id'];
			opt.innerHTML = kraTemplate[i]['title'];
			kraDropdown.appendChild(opt);
		}
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				DISPLAY KPI DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function populateForm(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'data/getkpiprocess.php',		//the url where we want to POST
				data		: {'kpiID':kpiID,'employeeID':employeeID},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				$('#kra').val( data['kpi']['kratemplateid'] );
				$("#kra").change(); // to trigger the onchange method of the KRA dropdown
				$('#kpi').val( data['kpi']['kpitemplateid'] );
				$("#description").val( data['kpi']['description'] );
				
				if(data['kpi']['issubmitted'] == 1 || data['kpi']['ischecked'] == 1){
					// TODO: to disable field and remove save button
					$('#kra').prop('disabled', true);
					$('#kpi').prop('disabled', true);
					$('#description').prop('disabled', true);
					$('#editKPISubmit').hide();
				}
			}
			else{
				window.history.back();
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "500.php";
		});
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				SUBMIT KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#formAssignKPI').submit(function(event){
		event.preventDefault();
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		//clearing messages and errors	
		$('#editResponse').empty();
		
		var formData= {
			'kpiID'						:kpiID,
			'employeeID'				:employeeID,
			'action'				    :kpiAction,
			'month'						:month,
			'year'						:year,
			'kra'						:$('#kra').val(),
			'kpi'						:$('#kpi').val(),
			'description'				:$("#description").val()
		};
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/assignkpiprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['loggedIn']){console.log(data);			
				//check if it has errors
				if(!data['completeInformation']){
					if(data['date']){
						$('#editResponse').append('<div class="editError text-center red fontsize-s">' + data['date'] + '</div>');
					}
					if(data['kra']){
						$('#editResponse').append('<div class="editError text-center red fontsize-s">' + data['kra'] + '</div>');
					}
					if(data['kpi']){
						$('#editResponse').append('<div class="editError text-center red fontsize-s">' + data['kpi'] + '</div>');
					}
				}
				else if(data['returnToPreviousPage']){
					// Error occured: 
					// 1. not supervisor OR
					// 2. editing kpi but no id found
					window.history.back();
				}
				else if(data['success']){
					// once done updating or adding new kpi,go back to previous page
					window.history.back();
				}
				else{
					window.history.back();
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
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO CANCEL EDIT
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	this.getElementById('editKPICancel').addEventListener('click',function(){
		window.history.back();
	}, false);
	
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

