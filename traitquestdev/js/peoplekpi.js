// JavaScript Document
$(document).ready(function(){
	var today = moment();;
	var firstDate = moment(today, "DD MMM YYYY").day( 1 ).format("DD MMM YYYY");
	var lastDate = moment(today, "DD MMM YYYY").day( 7 ).format("DD MMM YYYY");
	var employeeID = getUrlParameter('eid');
	if( employeeID === undefined || employeeID == '' ){
		//window.history.back();
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SELECT A DATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	moment.locale('en', {
      week: { dow: 1 } // Monday is the first day of the week
    });
	
	//Initialize the datePicker
	$("#weeklyDatePicker").datetimepicker({
		format: 'DD MMM YYYY'
	});

	 //Get the value of Start and End of Week
	$('#weeklyDatePicker').on('dp.change', function (e) {
	    var value = $("#weeklyDatePicker").val();
		var firstDateNr = 1;
		var lastDateNr = 7;		
	    firstDate = moment(value, "DD MMM YYYY").day( firstDateNr ).format("DD MMM YYYY");
	    lastDate =  moment(value, "DD MMM YYYY").day( lastDateNr ).format("DD MMM YYYY");
	    $("#weeklyDatePicker").val(firstDate + " - " + lastDate);
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO ADD NEW KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	this.getElementById('buttonAssignKPI').addEventListener('click',function(){
		start = moment(firstDate, "DD MMM YYYY").format("YYMMDD");
		end = moment(lastDate, "DD MMM YYYY").format("YYMMDD");
		url = "eid=" + employeeID
			  + "&start=" + start
			  + "&end=" + end;
		window.location.href= "assignkpi.php?" + url;
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

