// JavaScript Document
$(document).ready(function(){
	searchWorking = false;
	getDepartment();
	searchEmployee();
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO ADD EMPLOYEE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	var working = false;
	
	$('#formAddEmployee').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors	
		$('.error').remove();
		
		//get the form data
		var formData= {
			'departmentID'			:$('#department').val(),
			'name'					:$('input[name=name]').val(),
			'email'					:$('input[name=email]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/employee/addemployeeprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['isAdmin'])
			{	
				//check if it has errors
                if(data['employeeAdded']){
					$('#formAddEmployee')[0].reset();
					var codeHTML = '';
					if(data['employee']['code'] != '' && !$.isEmptyObject(data['employee']['code'])){
						codeHTML = ' - <i class="fontsize-xs">' + data['employee']['code'] + '</i>'
					}
						
					var source = $('<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								+ '<div class="img-wrap">'
								+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['employee']['imagelink'] + '">'
								+ '</div>'
								+ '<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								+ '<li>' + data['employee']['name'] + codeHTML + '</li>'
								+ '<li><a class="black" href="mailto:' + data['employee']['email'] + '">' + data['employee']['email'] + '</a></li>'
								+ '<button class="viewEmployee" data-id="' + data['employee']['id'] + '"><i class="view green glyphicon glyphicon-user"></i></button>'
								+ '<button class="manageEmployee" data-id="' + data['employee']['id'] + '"><i class="manage blue glyphicon glyphicon-equalizer"></i></button>'
								+ '<button class="deleteEmployee" data-id="' + data['employee']['id'] + '"><i class="del red glyphicon glyphicon-trash"></i></button>'
								+ '</ul>'
								+ '</div>');
					/*var source = $('<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								+ '<div class="img-wrap">'
								+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['employee']['imagelink'] + '">'
								+ '</div>'
								+ '<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								+ '<li><a href="manage.php?id=' + data['employee']['id'] + '">' + data['employee']['name'] + '</a></li>'
								+ codeHTML
								+ '<li><a href="mailto:' + data['employee']['email'] + '">' + data['employee']['email'] + '</a></li>'
								
								+ '<button class="deleteEmployee" data-id="' + data['employee']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
								+ '<button class="editEmployee" data-id="' + data['employee']['id'] + '"><i class="edit green glyphicon glyphicon-edit"></i></button>'
								+ '</ul>'
								+ '</div>');*/
					var target = '#employeeList';
					source.prependTo(target).hide().slideDown();
                }
                else{
                    if(data['error']){ 
                        $('#response').append('<div class="error">' + data['error'] + '</div>');
                    }
                }
			}
			else{
				// redirect to login page if user is not logged in
                window.location.href = "../../login.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "../../500.php";
		});	
	});
	
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
			GET DEPARTMENT
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getDepartment(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'../../data/admin/department/getdepartmentlist.php',		//the url where we want to POST
				data		: {},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			department = data['department'];
			
			// add the department to the dropdown
			addDepartmentOption(department);
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
		});
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		ADD OPTION OF DEPARTMENT DROPDOWN
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function addDepartmentOption(department){
		var departmentDropdown = document.getElementById('department');
		$('#department').empty();
		
		var opt = document.createElement('option');
		opt.value = 0;
		opt.innerHTML = 'Select a department';
		departmentDropdown.appendChild(opt);
		opt.disabled = true;
		
		for(var i = 0; i < department.length; i++){
			var opt = document.createElement('option');
			opt.value = department[i]['id'];
			opt.innerHTML = department[i]['name'];
			departmentDropdown.appendChild(opt);
		}
	}
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO VIEW EMPLOYEE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.viewEmployee',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		url = 'view.php?id=' + id;
		window.location.href = url;
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO MANAGE EMPLOYEE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.manageEmployee',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		url = 'manage.php?id=' + id;
		window.location.href = url;
	})
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO REMOVE EMPLOYEE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.deleteEmployee',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.employeeRow'); // Get a reference to the row that has the button we clicked
		
		$.ajax({
			type:'post',
			url:'../../data/admin/employee/removeemployeeprocess.php',
			data:{'action':'deleteEntry','id':id},
			success:function(response){
				if (response == 'employeeRemoved') {
					// Hide the row nicely and remove it from the DOM once the animation is finished.
					currentRow.slideUp(500,function(){
						currentRow.remove();
					})
				} else if(response == 'deletingYourself'){
					alert("You're not allowed to remove yourself");
				}
				else{
					// throw catch error here
					 window.location.href = "../../500.php";
				}
			}
		})
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
			url			:'../../data/admin/employee/getemployeelist.php',		//the url where we want to POST
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
						var codeHTML = '';
						if(data['result'][i]['employee']['code'] != '' && !$.isEmptyObject(data['result'][i]['employee']['code'])){
							codeHTML = ' - <i class="fontsize-xs">' + data['result'][i]['employee']['code'] + '</i>'
						}
						
						html = '<div class="employeeRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
								+ '<div class="img-wrap">'
								+ '<img class="imageSize100px col-lg-6 col-md-6 col-sm-6 col-xs-6" src="' + data['result'][i]['employee']['imagelink'] + '">'
								+ '</div>'
								+ '<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
								+ '<li>' + data['result'][i]['employee']['name'] + codeHTML + '</li>'
								+ '<li><a class="black" href="mailto:' + data['result'][i]['employee']['email'] + '">' + data['result'][i]['employee']['email'] + '</a></li>'
								+ '<button class="viewEmployee" data-id="' + data['result'][i]['employee']['id'] + '"><i class="view green glyphicon glyphicon-user"></i></button>'
								+ '<button class="manageEmployee" data-id="' + data['result'][i]['employee']['id'] + '"><i class="manage blue glyphicon glyphicon-equalizer"></i></button>'
								+ '<button class="deleteEmployee" data-id="' + data['result'][i]['employee']['id'] + '"><i class="del red glyphicon glyphicon-trash"></i></button>'
								+ '</ul>'
								+ '</div>';
						
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

