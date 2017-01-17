// JavaScript Document
$(document).ready(function(){
	var working = false;
	var searchWorking = false;
	var departmentID;
	var currentRow;
	var action = 'new';
	
	getDepartmentList(searchWorking);
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO PROMPT THE NEW FORM
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','#addDepartmentButton',function(){
		$('#formDepartment')[0].reset();
		$('#addDepartmentModal').modal('show');
		action = 'new';
		//departmentID = '0';
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO PROMPT THE EDIT FORM
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.editDepartment',function(){
		departmentID = $(this).attr('data-id'); // Get the clicked id for edit 
		currentRow = $(this).closest('.departmentRow'); // Get a reference to the row that has the button we clicked
	
		// Clear existing data in the form if exists
		$('#department').val('');
		
		var name = currentRow.find('.departmentName').text();
		$('#department').val(name);
		
		$('#addDepartmentModal').modal('show');
		action = 'edit';
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO CLOSE DEPARTMENT MODAL
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','#cancelDepartment',function(){	
		$('#addDepartmentModal').modal('hide');
		$('#formDepartment')[0].reset();
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO PROMPT THE DELETE FORM
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.deleteDepartment',function(){
		departmentID = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.departmentRow'); // Get a reference to the row that has the button we clicked
		
		//get the form data
		var formData= {
			'action'		    :'delete',
			'departmentID'	    :departmentID
		};
		
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/department/updatedepartment.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			if(data['isAdmin']){
				if(data['fatalError']){
					window.location.href = "../../500.php";
				}
				else if(data['error']){
					window.location.reload();
				}
				else if(data['deleteSuccess']){
					// Hide the row nicely and remove it from the DOM once the animation is finished.
					currentRow.slideUp(500,function(){
						currentRow.remove();
					})
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
	});
		
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			CREATE/EDIT DEPARTMENT
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#formDepartment').submit(function(event){
		event.preventDefault();
		var dept = $("#department").val();
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
								
		//get the form data
		var formData= {
			'action'		    :action,
			'departmentID'	    :departmentID,
			'departmentName'	:dept
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/department/updatedepartment.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			var target = $('#departmentList');
			var html;
			if(data['isAdmin']){
				if(data['fatalError']){
					window.location.href = "../../500.php";
				}
				else if(data['error']){
					window.location.reload();
				}
				else if(data['editSuccess']){
					currentRow.find('.departmentName').text(dept);
					$('#formDepartment')[0].reset();
					$('#addDepartmentModal').modal('hide');
				}
				else if(data['newSuccess']){
					$('#addDepartmentModal').modal('hide');
					$('#formDepartment')[0].reset();
					
					html = '<div class="departmentRow margin-top-s col-lg-12 col-md-12 col-sm-12 col-xs-12">'
							+ '<button class="deleteDepartment" data-id="' + data['newdepartment']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
							+ '<button class="editDepartment" data-id="' + data['newdepartment']['id'] + '" ><i class="edit green glyphicon glyphicon-edit"></i></button>'
							+ '<ul class="padding-leftright-xs col-lg-12 col-md-12 col-sm-12 col-xs-12">'
							+ '<li class="departmentName">' + data['newdepartment']['name'] + '</li>'
							+ '</ul>'
							+ '</div>';
				
					target.append(html);

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
		
	});
	
})

function getDepartmentList(searchWorking){
	//to prevent multiple submission when multiple click on submit button
	if (searchWorking) return false;
	searchWorking = true;
	
	$('#departmentList').empty();
		
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/department/getdepartmentlist.php',		//the url where we want to POST
			data		:{},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){ 
		searchWorking = false;
		var target = $('#departmentList');
		var html;
		if(data['return']){
			for(var i = 0; i < data['department'].length; i++){
				html = '<div class="departmentRow margin-top-s col-lg-12 col-md-12 col-sm-12 col-xs-12">'
						+ '<button class="deleteDepartment" data-id="' + data['department'][i]['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
						+ '<button class="editDepartment" data-id="' + data['department'][i]['id'] + '" ><i class="edit green glyphicon glyphicon-edit"></i></button>'
						+ '<ul class="padding-leftright-xs col-lg-12 col-md-12 col-sm-12 col-xs-12">'
						+ '<li class="departmentName">' + data['department'][i]['name'] + '</li>'
						+ '</ul>'
						+ '</div>';
				
				target.append(html);
				
			}
		}
		else{
			alert('There is no department. Please add at least one(1) department.');
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "../../500.php";
	});
}