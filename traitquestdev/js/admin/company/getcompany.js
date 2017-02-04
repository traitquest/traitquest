// JavaScript Document
$(document).ready(function(){
	populateData();
})

function populateData(){
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/company/getcompanyprocess.php',		//the url where we want to POST
			data		: {},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){console.log(data);
		if(data['return']){
			// Company Name
			$('#companyName').append(data['company']['name']);
			
			// Company Address
			if(data['company']['address'] != '' && !$.isEmptyObject(data['company']['address'])){
				$('#companyAddress').append(data['company']['address']);
			}
			else{
				$('#companyAddress').append('<i>No information<i>');
			}
			
			// Company Email
			if(data['company']['email'] != '' && !$.isEmptyObject(data['company']['email'])){
				$('#companyEmail').append(data['company']['email']);
			}
			else{
				$('#companyEmail').append('<i>No information<i>');
			}
			
			// Company Phone
			if(data['company']['phone'] != '' && !$.isEmptyObject(data['company']['phone'])){
				$('#companyPhone').append(data['company']['phone']);
			}
			else{
				$('#companyPhone').append('<i>No information<i>');
			}
			
			// Company Fax
			if(data['company']['fax'] != '' && !$.isEmptyObject(data['company']['fax'])){
				$('#companyFax').append(data['company']['fax']);
			}
			else{
				$('#companyFax').append('<i>No information<i>');
			}
			
			// Company Website
			if(data['company']['website'] != '' && !$.isEmptyObject(data['company']['website'])){
				$('#companyWebsite').append(data['company']['website']);
			}
			else{
				$('#companyWebsite').append('<i>No information<i>');
			}
			
			// Company Description
			if(data['company']['description'] != '' && !$.isEmptyObject(data['company']['description'])){
				var descriptionHTML = '<div id="companyDescription" class="col-lg-12 col-md-12 padding-top-l"><!2ndwindow>' 
									   + '<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg">'
									   + '<h3 class="grey30">Description</h3>'
									   + '<p>' + nl2br(data['company']['description']) + '</p>'
									   + '</div></div>';
				$('#companyData').append(descriptionHTML);
			}
			
			// Company Vision
			if(data['company']['vision'] != '' && !$.isEmptyObject(data['company']['vision'])){
				var visionHTML = '<div id="companyVision" class="col-lg-12 col-md-12 padding-top-l"><!3rdwindow>'
							      + '<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg">'
								  + '<h3 class="grey30">Vision</h3>'
								  + '<p>' + nl2br(data['company']['vision']) + '</p>'
								  + '</div></div>';
				$('#companyData').append(visionHTML);
			}
			
			// Company Mission
			if(data['company']['mission'] != '' && !$.isEmptyObject(data['company']['mission'])){
				var missionHTML = '<div id="companyMission" class="col-lg-12 col-md-12 padding-top-l"><!4thwindow>'
							      + '<div class="padding-bottom-s padding-leftright-s border-top-grey white-bg">'
								  + '<h3 class="grey30">Mission</h3>'
								  + '<p>' + nl2br(data['company']['mission']) + '</p>'
								  + '</div></div>';
				$('#companyData').append(missionHTML);
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