// JavaScript Document
$(document).ready(function(){
	var currentEmployeeID = getUrlParameter('id');
	if( currentEmployeeID === undefined || currentEmployeeID == '' ){
		window.location.href = "employee.php";
	}
	getSuperiorList();
	getSubordinateList();
	
	searchWorking = false;
	searchEmployee();

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO SEARCH EMPLOYEE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#formSearchEmployee').submit(function(event){
		event.preventDefault();
		//to prevent multiple submission when multiple click on submit button
		if (searchWorking) return false;
		searchWorking = true;
		searchEmployee();
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO ASSIGN EMPLOYEE AS SUPERIOR
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.assignSuperior',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.employeeRow'); // Get a reference to the row that has the button we clicked

		$.ajax({
			type:'post',
			url:'../data/admin/employee/assignemployeeprocess.php',
			data:{'action':'assignSuperior','selectedEmployeeID':id, 'currentEmployeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				var codeHTML;
				if (data['response'] == 'superiorAssigned') {
					codeHTML = '';
					if(data['employee']['code'] != '' && !$.isEmptyObject(data['employee']['code'] )){
						codeHTML = '<li><i>( ' + data['employee']['code']  + ' )</i></li>'
					}
					
					var source = $('<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								   + '<div class="img-wrap">'
								   + '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['employee']['imagelink'] + '">'
								   + '<button class="removeSuperior" data-id="' + data['employee']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
								   + '</div>'
								   + '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								   + '<li>' + data['employee']['name'] + '</li>'
								   + codeHTML
								   + '</ul>'
								   + '</div>');
					/*var source = $('<div class="employeeRow"><div class="employeeData">'
									  + data['employee']['code'] + ' '
									  + '<a href="employeeassignment.php?id=' + data['employee']['id'] + '">'
									  + data['employee']['name'] + '</a>' + ' '
									  + data['employee']['email'] + '</div>'
									  + '<div class="remove">' 
									  + '<button class="removeSuperior" data-id="' + data['employee']['id'] + '">Remove</button>'
									  + '</div></div>');*/
					var target = '#superiorList';
					$(target).find('.noRecord').remove();
					source.appendTo(target).hide().slideDown();
				} 
				else if(data['response'] == 'superiorAlreadyAssigned'){
					alert("You have already assigned this employee as superior");
				}
				else{
					// throw catch error here
					 window.location.href = "../500.php";
				}
			}
		})
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO ASSIGN EMPLOYEE AS SUBORDINATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.assignSubordinate',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.employeeRow'); // Get a reference to the row that has the button we clicked

		$.ajax({
			type:'post',
			url:'../data/admin/employee/assignemployeeprocess.php',
			data:{'action':'assignSubordinate','selectedEmployeeID':id, 'currentEmployeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				var codeHTML;
				if (data['response'] == 'subordinateAssigned') {
					codeHTML = '';
					if(data['employee']['code'] != '' && !$.isEmptyObject(data['employee']['code'] )){
						codeHTML = '<li><i>( ' + data['employee']['code']  + ' )</i></li>'
					}
					
					var source = $('<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								   + '<div class="img-wrap">'
								   + '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['employee']['imagelink'] + '">'
								   + '<button class="removeSubordinate" data-id="' + data['employee']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
								   + '</div>'
								   + '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								   + '<li>' + data['employee']['name'] + '</li>'
								   + codeHTML
								   + '</ul>'
								   + '</div>');
					/*var source = $('<div class="employeeRow"><div class="employeeData">'
									  + data['employee']['code'] + ' '
									  + '<a href="employeeassignment.php?id=' + data['employee']['id'] + '">'
									  + data['employee']['name'] + '</a>' + ' '
									  + data['employee']['email'] + '</div>'
									  + '<div class="remove">' 
									  + '<button class="removeSubordinate" data-id="' + data['employee']['id'] + '">Remove</button>'
									  + '</div></div>');*/
					var target = '#subordinateList';
					$(target).find('.noRecord').remove();
					source.appendTo(target).hide().slideDown();
				} 
				else if(data['response'] == 'subordinateAlreadyAssigned'){
					alert("You have already assigned this employee as subordinate");
				}
				else{
					// throw catch error here
					 window.location.href = "../500.php";
				}
			}
		})
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO REMOVE EMPLOYEE AS SUPERIOR
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.removeSuperior',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.employeeRow'); // Get a reference to the row that has the button we clicked

		$.ajax({
			type:'post',
			url:'../data/admin/employee/assignemployeeprocess.php',
			data:{'action':'removeSuperior','selectedEmployeeID':id, 'currentEmployeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				if (data['response'] == 'superiorRemoved') {
					currentRow.slideUp(500,function(){
						currentRow.remove();
					})
				} 
				else if(data['response'] == 'superiorAlreadyRemoved'){
					alert("You have already removed this employee. Please refresh browser.");
				}
				else{
					// throw catch error here
					 window.location.href = "../500.php";
				}
			}
		})
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO REMOVE EMPLOYEE AS SUPERIOR
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.removeSubordinate',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.employeeRow'); // Get a reference to the row that has the button we clicked

		$.ajax({
			type:'post',
			url:'../data/admin/employee/assignemployeeprocess.php',
			data:{'action':'removeSubordinate','selectedEmployeeID':id, 'currentEmployeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				if (data['response'] == 'subordinateRemoved') {
					currentRow.slideUp(500,function(){
						currentRow.remove();
					})
				} 
				else if(data['response'] == 'subordinateAlreadyRemoved'){
					alert("You have already removed this employee. Please refresh browser.");
				}
				else{
					// throw catch error here
					 window.location.href = "../500.php";
				}
			}
		})
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SUPERIOR DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSuperiorList(){
		$.ajax({
			type:'post',
			url:'../data/admin/employee/getemployeehierarchyprocess.php',
			data:{'action':'getSuperior','employeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				var html;
				var target = $('#superiorList');
				
				if (data['response'] == 'success') {
					var resultNumber = data['result'].length;
					var codeHTML;
					for(var i=0; i < resultNumber; i++){
						codeHTML = '';
						if(data['result'][i]['superior']['data']['code'] != '' && !$.isEmptyObject(data['result'][i]['superior']['data']['code'] )){
							codeHTML = '<li><i>( ' + data['result'][i]['superior']['data']['code']  + ' )</i></li>'
						}
						
						html = '<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
							   + '<div class="img-wrap">'
							   + '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['result'][i]['superior']['data']['imagelink'] + '">'
							   + '<button class="removeSuperior" data-id="' + data['result'][i]['superior']['data']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
							   + '</div>'
							   + '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
							   + '<li>' + data['result'][i]['superior']['data']['name'] + '</li>'
							   + codeHTML
							   + '</ul>'
							   + '</div>';
						/*html = '<div class="employeeRow"><div class="employeeData">'
							    + data['result'][i]['superior']['data']['code'] + ' '
							    + '<a href="employeeassignment.php?id=' + data['result'][i]['superior']['data']['id'] + '">'
							    + data['result'][i]['superior']['data']['name'] + '</a>' + ' '
							    + data['result'][i]['superior']['data']['email'] + '</div>'
								+ '<div class="remove">' 
								+ '<button class="removeSuperior" data-id="' + data['result'][i]['superior']['data']['id'] + '">Remove</button>'
								+ '</div></div>';*/
							
						target.append(html);
					}
				} 
				else if( data['response'] == 'noResult' ){
					html = '<p class="noRecord">No record found</p>';
					target.append(html);
				}
				else if(data['response'] == 'notAdmin'){
					window.location.href = "../index.php";
				}
				else{
					// throw catch error here
					window.location.href = "../500.php";
				}
			}
		})
		
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SUBORDINATE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSubordinateList(){
		$.ajax({
			type:'post',
			url:'../data/admin/employee/getemployeehierarchyprocess.php',
			data:{'action':'getSubordinate','employeeID':currentEmployeeID},
			success:function(result){
				var data = JSON.parse(result);
				var html;
				var target = $('#subordinateList');
				
				if (data['response'] == 'success') {
					var resultNumber = data['result'].length;
					var codeHTML;
					for(var i=0; i < resultNumber; i++){
						codeHTML = '';
						if(data['result'][i]['subordinate']['data']['code'] != '' && !$.isEmptyObject(data['result'][i]['subordinate']['data']['code'] )){
							codeHTML = '<li><i>( ' + data['result'][i]['subordinate']['data']['code']  + ' )</i></li>'
						}
						
						html = '<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
							   + '<div class="img-wrap">'
							   + '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['result'][i]['subordinate']['data']['imagelink'] + '">'
							   + '<button class="removeSubordinate" data-id="' + data['result'][i]['subordinate']['data']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
							   + '</div>'
							   + '<ul class="margin-top-m padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
							   + '<li>' + data['result'][i]['subordinate']['data']['name'] + '</li>'
							   + codeHTML
							   + '</ul>'
							   + '</div>';
						/*html = '<div class="employeeRow"><div class="employeeData">'
							    + data['result'][i]['subordinate']['data']['code'] + ' '
							    + '<a href="employeeassignment.php?id=' + data['result'][i]['subordinate']['data']['id'] + '">'
							    + data['result'][i]['subordinate']['data']['name'] + '</a>' + ' '
							    + data['result'][i]['subordinate']['data']['email'] + '</div>'
								+ '<button class="removeSubordinate" data-id="' + data['result'][i]['subordinate']['data']['id'] + '">Remove</button>'
								+ '</div></div>';*/
							
						target.append(html);
					}
				} 
				else if( data['response'] == 'noResult' ){
					html = '<p class="noRecord">No record found</p>';
					target.append(html);
				}
				else if(data['response'] == 'notAdmin'){
					window.location.href = "../index.php";
				}
				else{
					// throw catch error here
					window.location.href = "../500.php";
				}
			}
		})
		
	}
	
	function searchEmployee(){
		/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO RETRIEVE EMPLOYEE DATA
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
		//get the form data
		var formData= {
			'search'			  :$('input[name=search]').val()
		};
		
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../data/admin/employee/getemployeelist.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			searchWorking = false;
			//here we will handle errors and validation messages
			if(data['isAdmin'])
			{	
				var html;
				var target = $('#employeeList');
				// empty the container before searching
				target.empty();
				if(data['return']){
					var resultNumber = data['result'].length;
					
					for(var i=0; i<resultNumber; i++){
						// prevent display own name
						if( currentEmployeeID != data['result'][i]['employee']['id'] ){
							var codeHTML = '';
							if(data['result'][i]['employee']['code'] != '' && !$.isEmptyObject(data['result'][i]['employee']['code'])){
								codeHTML = '<li><i>( ' + data['result'][i]['employee']['code'] + ' )</i></li>'
							}
							
							html = '<div class="employeeRow margin-top-s col-lg-12 col-md-12 col-sm-12 col-xs-12">'
									+ '<img class="imageSize100px col-lg-1 col-md-1" src="' + data['result'][i]['employee']['imagelink'] + '">'
									+ '<ul class="margin-top-m padding-leftright-xs col-lg-5 col-md-5">'
									+ '<li>' + data['result'][i]['employee']['name'] + '</li>'
									+ codeHTML
									+ '</ul>'
									+ '<button class="assignSuperior white assignButton assignButtonBlue margin-xs col-lg-3 col-md-3 margin-top-m" data-id="' + data['result'][i]['employee']['id'] + '">Superior</button>'
									+ '<button class="assignSubordinate white assignButton assignButtonGreen margin-xs col-lg-3 col-md-3 margin-top-m" data-id="' + data['result'][i]['employee']['id'] + '">Subordinate</button>'
									+ '</div>';
									
							/*html = '<div class="employeeRow"><div class="employeeData">'
									+ data['result'][i]['employee']['code'] + ' '
									+ data['result'][i]['employee']['name'] + ' '
									+ data['result'][i]['employee']['email'] + '</div>'
									+ '<div class="assignSuperiorContainer">' 
									+ '<button class="assignSuperior" data-id="' + data['result'][i]['employee']['id'] + '">Superior</button>'
									+ '</div>'
									+ '<div class="assignSubordinateContainer">' 
									+ '<button class="assignSubordinate" data-id="' + data['result'][i]['employee']['id'] + '">Subordinate</button>'
									+ '</div></div>';*/
						
							target.append(html);
						}
					}
				}
				else{
					html = "<div>No employees record</div>";
					target.append(html);
				}
			}
			else{
				// redirect to home page when user is logged in
				window.location.href = "../index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../500.php";
		});
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
