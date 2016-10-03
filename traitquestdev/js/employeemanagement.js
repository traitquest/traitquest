// JavaScript Document
$(document).ready(function(){
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE EMPLOYEE DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$.ajax({
		type		:'POST', 	//define the type of HTTP verb we want to use
		url			:'../traitquestserver/getemployeelist.php',		//the url where we want to POST
		data		: '',		//our data object
		dataType	:'json',		//what type of data do we expect back from the server
		encode		:true
	})
	
	//using the done promise callback
	.done(function(data){
		//working = false;
		//here we will handle errors and validation messages
		if(data['isAdmin'])
		{	
			if(data['return']){
                var resultNumber = data['result'].length;
				
                for(var i=0; i<resultNumber; i++){
					var html = '<div class="employeeRow"><div class="employeeData">'
								+ data['result'][i]['employee']['code'] + ' '
								+ data['result'][i]['employee']['name'] + ' '
								+ data['result'][i]['employee']['email'] + '</div>'
								+ '<div class="deleteContainer">' 
								+ '<button class="deleteEmployee" data-id="' + data['result'][i]['employee']['id'] + '">Del</button>'
								+ '</div></div>';
					var target = $('#employeeList');
                    target.append(html);
				}
			}
			else{
				var html = "<div>No employees record</div>";
				var target = $('#employeeList');
				target.append(html);
			}
		}
		else{
			// redirect to home page when user is logged in
			window.location.href = "login";
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "500";
	});
	
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
			'code'				    :$('input[name=code]').val(),
			'name'					:$('input[name=name]').val(),
			'email'					:$('input[name=email]').val()
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../traitquestserver/addemployeeprocess.php',		//the url where we want to POST
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
					var source = $('<div class="employeeRow"><div class="employeeData">'
									  + data['employee']['code'] + ''
									  + data['employee']['name'] + ' '
									  + data['employee']['email'] + '</div>'
									  + '<div class="deleteContainer">' 
									  + '<button class="deleteEmployee" data-id="' + data['employee']['id'] + '">Del</button>'
									  + '</div></div>');
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
                window.location.href = "login";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "500";
		});	
	});
	
	$(this).on('click','.deleteEmployee',function(){
		id = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.employeeRow'); // Get a reference to the row that has the button we clicked

		$.ajax({
			type:'post',
			url:'../traitquestserver/removeemployeeprocess.php',
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
					 window.location.href = "500";
				}
			}
		})
	})
})

