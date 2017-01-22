// JavaScript Document
$(document).ready(function(){
	var employeeID = getUrlParameter('eid');
	var selectedDate;
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0); 	
	var month = now.getMonth() + 1; //months from 1-12;
	var year = now.getFullYear();
	var searchKPIWorking = false;
	var id;
	var currentRow;
	if( employeeID === undefined || employeeID == '' ){
		getSessionData();
	}
	else{
		getKPIList(); // to retrieve KPI list on load
	}

			
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SELECT A DATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#datepicker').datepicker('setValue', now)
		.on('changeDate', function(ev) {
			selectedDate = new Date(ev.date);
			month = selectedDate.getMonth() + 1; //months from 1-12
			year = selectedDate.getFullYear();
			getKPIList();
		});
		
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE KPI LIST DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function getKPIList(){
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/my/kpi/getkpilist.php',		//the url where we want to POST
			data		: {'employeeID':employeeID, 'month':month, 'year':year},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})		
		//using the done promise callback
		.done(function(data){
			searchKPIWorking = false;
			var html;
			var target = $('#kpiList');
			target.empty();
			if(data['isEmployee']){
				if(data['return']){
					if(data['isPast']){
						$('#buttonAssignKPI').hide();
					}
					else{
						$('#buttonAssignKPI').show();
					}
					
					if (data['hasresult']) {
						var resultNumber = data['result'].length;
						var codeHTML;
						for(var i=0; i < resultNumber; i++){
							html = '<div class="kpiRow">'
									+ '<div class="kpiTitle">' + data['result'][i]['kpiCategory']['title'] + '</div>'
									+ '<div class="kpiDescription">' + data['result'][i]['kpi']['description'] + '</div>'
									+ '<button class="viewKPI" data-id="' + data['result'][i]['kpi']['id'] + '"><i class="edit blue glyphicon glyphicon-search"></i></button>'
									+ '<button class="editKPI" data-id="' + data['result'][i]['kpi']['id'] + '"><i class="edit green glyphicon glyphicon-edit"></i></button>'
									+ '<button class="removeKPI" data-id="' + data['result'][i]['kpi']['id'] + '"><i class="del red glyphicon glyphicon-trash"></i></button>'
									+ '</div>';														
							target.append(html);
						}
					} 
					else{
						html = '<p class="noRecord">No record found</p>';
						target.append(html);
					}
				}
				else{
					//window.history.back();
				}
			}
			else{
				window.location.href = '../../index.php';
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
		});	
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO ADD NEW KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	this.getElementById('buttonAssignKPI').addEventListener('click',function(){
		url = 'assignkpi.php?' 
			  + 'eid=' + employeeID
			  + '&month=' + month
			  + '&year=' + year;
		window.location.href = url;
	}, false);
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				TO VIEW KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.viewKPI',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		url = 'view.php?' 
				+ 'id=' + id;
		window.location.href = url;
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				TO EDIT KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.editKPI',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.kpiRow'); // Get a reference to the row that has the button we clicked						
		checkKPIEditable(id, employeeID, currentRow, 'edit');
		/*url = 'assignkpi.php?' 
				+ 'id=' + id
				+ '&eid=' + employeeID
				+ '&month=' + month
				+ '&year=' + year;
		window.location.href = url;*/
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				TO REMOVE KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.removeKPI',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.kpiRow'); // Get a reference to the row that has the button we clicked						
		checkKPIEditable(id, employeeID, currentRow, 'delete');
	})
	
	$(this).on('click','#confirmationYes',function(){
		$('#confirmationModal').modal('hide');
		$.ajax({
			type:'post',
			url:'../../data/my/kpi/removekpiprocess.php',
			data:{'kpiID':id,'employeeID':employeeID},
			success:function(result){
				var data = JSON.parse(result);
				if (data['response'] == 'kpiRemoved') {
					currentRow.slideUp(500,function(){
						currentRow.remove();
					})
				} 
				else if(data['response'] == 'kpiAlreadyRemoved'){
					// refresh page to get updated
					window.location.reload();
				}
				else if(data['response'] == 'return'){
					window.history.back();
				}
				else{
					// throw catch error here
					 window.location.href = "../../500.php";
				}
			}
		})
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	TO CHECK IF THE KPI IS EDITABLE OR REMOVABLE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	function checkKPIEditable(kpiID, employeeID, currentRow, action){
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/my/kpi/getkpiprocess.php',		//the url where we want to POST
			data		: {'kpiID':id,'employeeID':employeeID},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})		
		//using the done promise callback
		.done(function(data){console.log(data);
			var titleHTML;
			if(data['return']){
				if(data['kpi']['issubmitted'] == 1 && data['kpi']['ischecked'] == 0){
					// submitted but not checked
					titleHTML = "KPI has been submitted. You're not allowed to make any changes.";
					$('#errorMessage').empty();
					$('#errorMessage').append(titleHTML);
					$('#errorModal').modal('show');
				}
				else if(data['kpi']['isverified'] == 1){
					// verified
					titleHTML = "KPI has been verified. You're not allowed to make any changes.";
					$('#errorMessage').empty();
					$('#errorMessage').append(titleHTML);
					$('#errorModal').modal('show');
				}
				else{
					if(action == 'delete'){
						var title = currentRow.find('.kpiTitle').text();
						titleHTML = "Are you sure you want to delete <b>" + title + "</b>?";
						$('#confirmationMessage').empty();
						$('#confirmationMessage').append(titleHTML);
						$('#confirmationModal').modal('show');
					}
					else if(action == 'edit'){
						//DO SOMETHING ON THE EDIT ie. POP UP A FORM
					}
				}
			}
			else{
				titleHTML = "Some error has occured. Please try again later.";
				$('#errorMessage').empty();
				$('#errorMessage').append(titleHTML);
				$('#errorModal').modal('show');
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
		});		
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SESSION DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSessionData(){
		$.ajax({
			type:'post',
			url:'../../data/getsessiondata.php',
			data:{},
			success:function(result){
				var data = JSON.parse(result);
				if(data['active']){
					employeeID = data['userID'];
					getKPIList(); // to retrieve KPI list on load
				}
				else{
					window.location.href = "../../index.php";
				}
			}
		})
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

