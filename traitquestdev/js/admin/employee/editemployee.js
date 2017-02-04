// JavaScript Document
$(document).ready(function(){
	var working = false;
	var day, month, year;
	var employeeID = getUrlParameter('id');
	if( employeeID === undefined || employeeID == '' ){
		window.location.href = "all.php";
	}
	getDepartment();
	populateForm();
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SELECT A DATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#datepicker').datepicker()
		.on('changeDate', function(ev) {
			selectedDate = new Date(ev.date);
			day = selectedDate.getDate();
			month = selectedDate.getMonth() + 1; //months from 1-12
			year = selectedDate.getFullYear();
	});
		
	/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		 EDIT EMPLOYEE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	$('#formEditEmployee').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		//clearing messages and errors
		$('.columnError').remove();
        $('.editSuccess').remove();
        $('.editError').remove();
		$('.inputForm').each(function(){
            $(this).removeClass('error');
        });
				
		//get the form data
		var formData= {
			'employeeID'						: employeeID,
			'employeeName'						:$('input[name=employeeName]').val(),
			'employeeCode'						:$('input[name=employeeCode]').val(),
			'employeeDepartment'				:$('#employeeDepartment').val(),
			'employeeExt'						:$('input[name=employeeExt]').val(),
			'employeeHiredDay'					:day,
			'employeeHiredMonth'				:month,
			'employeeHiredYear'					:year,
			'employeeAddress'					:$('#employeeAddress').val(),
			'employeeBank'						:$('input[name=employeeBank]').val(),
			'employeeEpf'						:$('input[name=employeeEpf]').val(),
			'employeeSocso'						:$('input[name=employeeSocso]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/employee/editemployeeprocess.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			//here we will handle errors and validation messages
			if(data['adminloggedIn']){				
				//check if it has errors
                if(!data['fatalError']){
					if(!data['editSuccess']){
						$('#editEmployeeResponse').append('<div class="editError text-center red">' + data['error'] + '</div>');
					}
					else{
						// redirect after editing
						window.history.back();
					}
				}
				else{
					window.location.href = "../../500.php";
				}				
			}
			else{
				// redirect to home page when user is not logged in as admin
                window.location.href = "../../index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "../../500.php";
		});
		
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO CANCEL EDIT
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	this.getElementById('editEmployeeCancel').addEventListener('click',function(){
		window.history.back();
	}, false);
	
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
		var departmentDropdown = document.getElementById('employeeDepartment');
		$('#employeeDepartment').empty();
		
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
			TO POPULATE THE FORM
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function populateForm(){
		$.ajax({
				type		:'POST', 	//define the type of HTTP verb we want to use
				url			:'../../data/admin/employee/getemployeedataprocess.php',		//the url where we want to POST
				data		: {'employeeID': employeeID},		//our data object
				dataType	:'json',		//what type of data do we expect back from the server
				encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			if(data['return']){
				var imageHTML = '<img class="imageSize100px center padding-xs" src="'+data['employee']['imagelink']+'">';
				$("#columnEmployeePic").append(imageHTML);
				$("#employeeName").val( data['employee']['name'] ); 
				$("#employeeCode").val( data['employee']['code'] );
				$("#employeeDepartment").val( data['employee']['departmentid'] );
				$("#employeeExt").val( data['employee']['ext'] );
				// Split timestamp into [ Y, M, D, h, m, s ]
				var t = data['employee']['hireddate'];
				var date = t.split(/[-]/);
				// Apply each element to the Date function
				var d = new Date(Date.UTC(date[0], date[1]-1, date[2]));
				year = date[0];
				month = date[1]-1;
				day = date[2];
				$('#datepicker').datepicker('setValue', d );
				$("#employeeAddress").val( data['employee']['address'] );
				$("#employeeBank").val( data['employee']['bank'] );
				$("#employeeEpf").val( data['employee']['epf'] );
				$("#employeeSocso").val( data['employee']['socso'] );
			}
			else{
				// go back to previous page
				window.history.back();
			}
		})
		//using the fail promise callback
		.fail(function(data){
			window.location.href = "../../500.php";
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

