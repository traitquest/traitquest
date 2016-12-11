// JavaScript Document
$(document).ready(function(){
	var currentEmployeeID;
	getSessionData();

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SESSION DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSessionData(){
		$.ajax({
			type:'post',
			url:'data/getsessiondata.php',
			data:{},
			success:function(result){
				var data = JSON.parse(result);
				currentEmployeeID = data['userID'];	
				getSubordinateList();
			}
		})
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SUBORDINATE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSubordinateList(){
		$.ajax({
			type:'post',
			url:'data/getsubordinateprocess.php',
			data:{'action':'getSubordinate','employeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				var html;
				var target = $('#peopleList');
				
				if (data['response'] == 'success') {
					var resultNumber = data['result'].length;
					
					for(var i=0; i < resultNumber; i++){
						html = '<div class="employeeRow"><div class="employeeData">'
							    + data['result'][i]['subordinate']['data']['code'] + ' '
							    + '<a href="peoplekpi.php?id=' + data['result'][i]['subordinate']['data']['id'] + '">'
							    + data['result'][i]['subordinate']['data']['name'] + '</a>' + ' '
							    + data['result'][i]['subordinate']['data']['email'] 
								+ '</div></div>';
							
						target.append(html);
					}
				} 
				else if( data['response'] == 'noResult' ){
					html = '<p class="noRecord">No record found</p>';
					target.append(html);
				}
				else if(data['response'] == 'isAdmin'){
					window.location.href = "login.php";
				}
				else{
					// throw catch error here
					window.location.href = "500.php";
				}
			}
		})
		
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SESSION DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSessionData(){
		$.ajax({
			type:'post',
			url:'data/getsessiondata.php',
			data:{},
			success:function(result){
				var data = JSON.parse(result);
				currentEmployeeID = data['userID'];	
				getSubordinateList();
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

