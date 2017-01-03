// JavaScript Document
$(document).ready(function(){
	var employeeID = getUrlParameter('eid');
	if( employeeID === undefined || employeeID == '' ){
		window.location.href = "people.php";
	}
	var selectedDate;
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0); 	
	var month = now.getMonth() + 1; //months from 1-12;
	var year = now.getFullYear();
	var searchKPIWorking = false;
			
	getKPIList(); // to retrieve KPI list on load
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
			url			:'data/getkpilist.php',		//the url where we want to POST
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
									+ data['result'][i]['kpiCategory']['title'] + ' '
									+ data['result'][i]['kpi']['description'] 
									+ '<button class="editKPI" data-id="' + data['result'][i]['kpi']['id'] + '">Edit</button>'
									+ '<button class="removeKPI" data-id="' + data['result'][i]['kpi']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
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
					window.history.back();
				}
			}
			else{
				window.location.href = 'index.php';
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "500.php";
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
				TO EDIT KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.editKPI',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		url = 'assignkpi.php?' 
				+ 'id=' + id
				+ '&eid=' + employeeID
				+ '&month=' + month
				+ '&year=' + year;
		window.location.href = url;
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				TO REMOVE KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.removeKPI',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.kpiRow'); // Get a reference to the row that has the button we clicked

		$.ajax({
			type:'post',
			url:'data/removekpiprocess.php',
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
					 window.location.href = "500.php";
				}
			}
		})
	})
	
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

