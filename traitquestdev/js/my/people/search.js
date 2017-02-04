// JavaScript Document
$(document).ready(function(){
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
		TO VIEW EMPLOYEE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.viewEmployee',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		url = '../profile/view.php?id=' + id;
		window.location.href = url;
	})
	
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
			url			:'../../data/my/people/getemployeelist.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			searchWorking = false;
			//here we will handle errors and validation messages
			if(data['isEmployee'])
			{	
				var html;
				var target = $('#employeeList');
				// empty the container before searching
				target.empty();
				if(data['return']){
					var resultNumber = data['result'].length;
					
					for(var i=0; i<resultNumber; i++){
						html = '<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								+ '<div class="img-wrap">'
								+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['result'][i]['employee']['imagelink'] + '">'
								+ '</div>'
								+ '<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								+ '<li>' + data['result'][i]['employee']['name'] + '</li>'
								+ '<li><a class="black" href="mailto:' + data['result'][i]['employee']['email'] + '">' + data['result'][i]['employee']['email'] + '</a></li>'
								+ '<button class="viewEmployee" data-id="' + data['result'][i]['employee']['id'] + '"><i class="view green glyphicon glyphicon-user"></i></button>'
								+ '</ul>'
								+ '</div>';
						/*html = '<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								+ '<div class="img-wrap">'
								+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['result'][i]['employee']['imagelink'] + '">'
								+ '</div>'
								+ '<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								+ '<li><a href="view.php?id=' + data['result'][i]['employee']['id'] + '">' + data['result'][i]['employee']['name'] + '</a></li>'
								+ '<li><a href="mailto:' + data['result'][i]['employee']['email'] + '">' + data['result'][i]['employee']['email'] + '</a></li></ul>'
								+ '</div>';*/
						
						target.append(html);
					}
				}
				else{
					html = "<div>No employees record</div>";
					target.append(html);
				}
			}
			else{
				// redirect to home page when user is logged in
				window.location.href = "../../login.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
		});
	}
	
})

