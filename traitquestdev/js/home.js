// JavaScript Document
$(document).ready(function(){
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE EMPLOYEE KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$.ajax({
		type		:'POST', 	//define the type of HTTP verb we want to use
		url			:'../traitquestserver/getemployeekpi.php',		//the url where we want to POST
		data		: '',		//our data object
		dataType	:'json',		//what type of data do we expect back from the server
		encode		:true
	})
	
	//using the done promise callback
	.done(function(data){	
		if(data['userLoggedIn']){
			if(data['return']){
				var resultNumber = data['result'].length;
				
				for(var i=0; i<resultNumber; i++){
					var html;
					if(data['result'][i]['kpi']['type'] == 'photo'){
						if(data['result'][i]['kpi']['iscompleted']==1){
							html = '<div class="kpiRow margin-topbottom-xs col-sm-6 col-xs-12"><div class="kpiData col-xs-10 text-center"><a class="col-xs-12 button" href="kpi?id='+data['result'][i]['kpi']['id']+'">Take Photos</a></div>'
									+ '<div class="completeContainer col-xs-2">' 
									+ '<img class="completedIcon" src="images/checked.png" />'
									+ '</div></div>';
						}
						else{
							html = '<div class="kpiRow margin-topbottom-xs col-sm-6 col-xs-12"><div class="kpiData col-xs-10 text-center"><a class="col-xs-12 button" href="kpi?id='+data['result'][i]['kpi']['id']+'">Take Photos</a></div>'
									+ '<div class="completeContainer col-xs-2">' 
									+ '<img class="completedIcon" src="images/unchecked.png" />'
									+ '</div></div>';
						}
					}
					else if(data['result'][i]['kpi']['type'] == 'quiz'){
						if(data['result'][i]['kpi']['iscompleted']==1){
							html = '<div class="kpiRow margin-topbottom-xs col-sm-6 col-xs-12"><div class="kpiData col-xs-10 text-center"><a class="col-xs-12 button" href="kpi?id='+data['result'][i]['kpi']['id']+'">Quiz</a></div>'
									+ '<div class="completeContainer col-xs-2">' 
									+ '<img class="completedIcon" src="images/checked.png" />'
									+ '</div></div>';
						}
						else{
							html = '<div class="kpiRow margin-topbottom-xs col-sm-6 col-xs-12"><div class="kpiData col-xs-10 text-center"><a class="col-xs-12 button" href="kpi?id='+data['result'][i]['kpi']['id']+'">Quiz</a></div>'
									+ '<div class="completeContainer col-xs-2">' 
									+ '<img class="completedIcon" src="images/unchecked.png" />'
									+ '</div></div>';
						}
					}
					
					var target = $('#kpiList');
					target.append(html);
				}
			}
			else{
				var html = "<div>You don't have any KPI.</div>";
				var target = $('#kpiList');
				target.append(html)
			}
		}
		else{
			window.location.href = "login";
		}
		
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "500";
	});
	
})