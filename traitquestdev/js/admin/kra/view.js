// JavaScript Document
$(document).ready(function(){
	var working = false;
	var searchWorking = false;
	var kraID;
	var currentRow;
	var selectedDate;
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0); 	
	var month = now.getMonth() + 1; //months from 1-12;
	var year = now.getFullYear();
	
	getKRAList(searchWorking, month, year);
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SELECT A DATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#datepicker').datepicker('setValue', now)
		.on('changeDate', function(ev) {
			selectedDate = new Date(ev.date);
			month = selectedDate.getMonth() + 1; //months from 1-12
			year = selectedDate.getFullYear();
			getKRAList(searchWorking, month, year);	
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO PROMPT THE EDIT FORM
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.editKRA',function(){
		kraID = $(this).attr('data-id'); // Get the clicked id for edit 
		currentRow = $(this).closest('.kraRow'); // Get a reference to the row that has the button we clicked
	
		// Clear existing data in the form if exists
		$('#kraTitle').empty();
		$('#description').val('');
		
		var title = currentRow.find('.title').text();
		$('#kraTitle').text(title);

		var description = currentRow.find('.description').text();
		$('#description').val(description);
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			TO PROMPT THE DELETE FORM
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$(this).on('click','.deleteKRA',function(){
		kraID = $(this).attr('data-id'); // Get the clicked id for deletion 
		currentRow = $(this).closest('.kraRow'); // Get a reference to the row that has the button we clicked
		
		//get the form data
		var formData= {
			'action'		    :'delete',
			'kraID'			    :kraID,
			'month'				:month,
			'year'				:year
		};
		
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/kra/updatekra.php',		//the url where we want to POST
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
			EDIT KRA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#formEditKRA').submit(function(event){
		event.preventDefault();
		var desc = $("#description").val();
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
								
		//get the form data
		var formData= {
			'action'		    :'edit',
			'kraID'			    :kraID,
			'description'		:desc,
			'month'				:month,
			'year'				:year
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/kra/updatekra.php',		//the url where we want to POST
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
				else if(data['editSuccess']){
					currentRow.find('.description').text(desc);
					$('#formEditKRA')[0].reset();
					$('#editKRAModal').modal('hide');
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

function getKRAList(searchWorking, month, year){
	//to prevent multiple submission when multiple click on submit button
	if (searchWorking) return false;
	searchWorking = true;
	
	$('#kraList').empty();
	
	//get the form data
	var formData= {
		'month'			    :month,
		'year'				:year
	};
	
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/kra/getkralist.php',		//the url where we want to POST
			data		:formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){ 
		searchWorking = false;
		var target = $('#kraList');
		var html;
		if(data['return']){
			for(var i = 0; i < data['kra'].length; i++){
				html = '<div class="kraRow margin-top-s col-lg-4 col-md-4 col-sm-6 col-xs-12">'
						+ '<button class="deleteKRA" data-id="' + data['kra'][i]['data']['id'] + '"><i class="del red glyphicon glyphicon-remove-sign"></i></button>'
						+ '<button class="editKRA" data-id="' + data['kra'][i]['data']['id'] + '" data-toggle="modal" data-target="#editKRAModal"><i class="edit green glyphicon glyphicon-edit"></i></button>'
						+ '<ul class="padding-leftright-xs col-lg-6 col-md-6 col-sm-12 col-xs-12">'
						+ '<li class="title">' + data['kra'][i]['template']['title'] + '</li>'
						+ '<li class="description">' + data['kra'][i]['data']['description'] + '</li>'
						+ '</ul>'
						+ '</div>';
				
				target.append(html);
				
			}
		}
		else{
			html = '<div>There is no objectives set for the month. <a href="set.php">Click here</a> to set now.</div>';
			target.append(html);
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "../../500.php";
	});
}