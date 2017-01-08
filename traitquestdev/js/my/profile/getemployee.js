// JavaScript Document
$(document).ready(function(){
	populateData();
})

function populateData(){
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
		GET EMPLOYEE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/my/profile/getemployeeprocess.php',		//the url where we want to POST
			data		: {},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){
		if(data['return']){
			// Name
			if(data['employee']['name'] != '' && !$.isEmptyObject(data['employee']['name'])){
				$('#name').append(data['employee']['name']);
			}
			else{
				$('#name').append('<i>No information<i>');
			}
			
			// Address
			if(data['employee']['address'] != '' && !$.isEmptyObject(data['employee']['address'])){
				$('#address').append(data['employee']['address']);
			}
			else{
				$('#address').append('<i>No information<i>');
			}
			
			// Email
			if(data['employee']['email'] != '' && !$.isEmptyObject(data['employee']['email'])){
				$('#email').append(data['employee']['email']);
			}
			else{
				$('#email').append('<i>No information<i>');
			}
			
			// Phone
			if(data['employee']['phone'] != '' && !$.isEmptyObject(data['employee']['phone'])){
				$('#phone').append(data['employee']['phone']);
			}
			else{
				$('#phone').append('<i>No information<i>');
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
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~
	GET SUPERVISOR/SUBORDINATE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/my/profile/getsupervisorsubordinate.php',		//the url where we want to POST
			data		: {},		//our data object
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
					html = '<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
							+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['superior'][i]['data']['imagelink'] + '">'
							+ '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
							+ '<li><a href="#">' + data['superior'][i]['data']['name'] + '</a></li>'
							+ '<li><a href="mailto:' + data['superior'][i]['data']['email'] + '">' + data['superior'][i]['data']['email'] + '</a></li>'
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
					html = '<div class="margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
							+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['subordinate'][i]['data']['imagelink'] + '">'
							+ '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
							+ '<li><a href="#">' + data['subordinate'][i]['data']['name'] + '</a></li>'
							+ '<li><a href="mailto:' + data['subordinate'][i]['data']['email'] + '">' + data['subordinate'][i]['data']['email'] + '</a></li>'
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