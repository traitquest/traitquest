// JavaScript Document
var submitted = false;
$(document).ready(function(){
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE EMPLOYEE KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	//get the form data
	var parts = window.location.search.substr(1).split("&");
	var $_GET = {};
	for (var i = 0; i < parts.length; i++) {
		var temp = parts[i].split("=");
		$_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	}
	
	var formData= {
		'id'	:$_GET['id']
	};
		
	$.ajax({
		type		:'POST', 	//define the type of HTTP verb we want to use
		url			:'../traitquestserver/getkpidata.php',		//the url where we want to POST
		data		: formData,		//our data object
		dataType	:'json',		//what type of data do we expect back from the server
		encode		:true
	})
	
	//using the done promise callback
	.done(function(data){
		//working = false;
		//here we will handle errors and validation messages
		if(data['userLoggedIn'])
		{	
			if(data['return']){
				var html;
                if(data['kpi']['type'] == 'photo'){
					getKPIPhoto( data['kpi']['phototemplateid'] );
				}
				else if(data['kpi']['type'] == 'quiz'){
					$("#kpiQuizContainer").show();
					//html = '<iframe id="kpiQuiz" src="https://docs.google.com/forms/d/e/1FAIpQLSfufMiybUS3ho6Uv8rqujN4qnvd1c2Wxp6wRshuIKBaTeut_w/viewform?embedded=true"  onload="submitQuiz()" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>';			
				}
				
				var target = $('#kpiContainer');
				target.append(html);
				
				if(data['kpi']['iscompleted'] == 1){
					$('#completedPopUp').modal('show');
				}
			}
			else{
				// redirect to home page when the kpi data is wrong
				window.location.href = "home";
			}
		}
		else{
			// redirect to login page when user is not logged in
			window.location.href = "login";
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "500";
	});

	// return the html to build up the KPI Taking Photo
	function getKPIPhoto(id) {
		var formData= {
			'id'	:id
		};
			
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/getkpiphoto.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			//working = false;
			//here we will handle errors and validation messages
			if(data['return'])
			{	
				var html = '<div class="photoContainer" id="photoKPI1"><img class="image" src="' + data['result']['link1'] + '" /><img class="checked" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/2000px-Checkmark_green.svg.png" /></div>'
							+ '<div class="photoContainer" id="photoKPI2"><img class="image" src="' + data['result']['link2'] + '" /><img class="checked" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/2000px-Checkmark_green.svg.png" /></div>'
							+ '<div class="photoContainer" id="photoKPI3"><img class="image" src="' + data['result']['link3'] + '" /><img class="checked" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/2000px-Checkmark_green.svg.png" /></div>'
							+ '<div class="photoContainer" id="photoKPI4"><img class="image" src="' + data['result']['link4'] + '" /><img class="checked" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/2000px-Checkmark_green.svg.png" /></div>'
							+ '<div class="photoContainer" id="photoKPI5"><img class="image" src="' + data['result']['link5'] + '" /><img class="checked" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/2000px-Checkmark_green.svg.png" /></div>'
							+ '<div class="photoContainer" id="photoKPI6"><img class="image" src="' + data['result']['link6'] + '" /><img class="checked" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/2000px-Checkmark_green.svg.png" /></div>';
				
				var target = $('#kpiContainer');
				target.append(html);
			}
			else{
				// redirect to home page when the kpi data is wrong
				window.location.href = "home";
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "500";
		});
	}
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		RESPONSE ON CLICKING IMAGE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.photoContainer',function(){
		$(this).toggleClass('completed');
		checkCompleteness();
	});
	
	function checkCompleteness(){
		var total = 6; // hardcoded to receive only 6
		var score = 0;
		$('.photoContainer').each(function(i, obj) {
			if($(this).hasClass('completed')){
				score++;
			}
		});
		
		if( score == total ){
			var html = '<button id="submitKPIPhoto">Submit</button>';
			var target = $('#kpiSubmission');
			target.append(html);
		}
		else{
			$('#submitKPIPhoto').remove();
		}
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		RESPONSE ON SUBMITTING KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	var submissionWorking = false;
	// for Photo KPI
	$(this).on('click','#submitKPIPhoto',function(){
		if (submissionWorking) return false;
		submissionWorking = true;
		$id = $_GET['id'];
		submitKPI($id);
	});
	
	// for Quiz KPI
	$('#kpiQuiz').load(function(){
		if(!submitted){
			submitted = true;
		}
		else{
			submitted = false;
			$id = $_GET['id'];
			submitKPI($id);
		}
	});
	
	function submitKPI(id){
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/submitkpiprocess.php',		//the url where we want to POST
			data		: {'id'	:id},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			submissionWorking = false;
			//here we will handle errors and validation messages
			if(data['completed'])
			{	
				$('#completedPopUp').modal('show');
			}
			else if(!data['userLoggedIn']){
				// redirect to login page if user is logged out
				window.location.href = "login";
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "500";
		});
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		RESPONSE ON AFTER SUBMITTING KPI
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','#completedButton',function(){
		window.location.href = "home";
	});

})

