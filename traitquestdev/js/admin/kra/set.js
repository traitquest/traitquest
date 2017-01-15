// JavaScript Document
$(document).ready(function(){
	var working = false;
	var selectedDate;
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0); 	
	var monthFrom = now.getMonth() + 1; //months from 1-12;
	var yearFrom = now.getFullYear();
	var monthTo = now.getMonth() + 1; //months from 1-12;
	var yearTo = now.getFullYear();
	
	getKRA();
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SELECT A DATE
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#datepickerfrom').datepicker('setValue', now)
		.on('changeDate', function(ev) {
			selectedDate = new Date(ev.date);
			monthFrom = selectedDate.getMonth() + 1; //months from 1-12
			yearFrom = selectedDate.getFullYear();
	});
	
	$('#datepickerto').datepicker('setValue', now)
		.on('changeDate', function(ev) {
			selectedDate = new Date(ev.date);
			monthTo = selectedDate.getMonth() + 1; //months from 1-12
			yearTo = selectedDate.getFullYear();
	});
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			SET KRA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$('#formSetKRA').submit(function(event){
		event.preventDefault();
		
		//to prevent multiple submission when multiple click on submit button
		if (working) return false;
		working = true;
		
		$('#kraError').empty();
		
		var kra = new Array();		
        $("input[name='kra_list[]']:checked").each(function() {
		   kra.push($(this).val());
        });
				
		//get the form data
		var formData= {
			'startMonth'			    :monthFrom,
			'startYear'					:yearFrom,
			'endMonth'					:monthTo,
			'endYear'					:yearTo,
			'kra'						:kra
		};
		//console.log(formData);
		
		//process the form
		$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/kra/setkra.php',		//the url where we want to POST
			data		: formData,		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
		})
		
		//using the done promise callback
		.done(function(data){
			working = false;
			var target = $('#kraError');
			var html;
			//here we will handle errors and validation messages
			if(data['isAdmin']){				
				if(data['fatalError']){
					// redirect to error page
					window.location.href = "../../500.php";
				}
				else{
					if(data['error']){
						if(data['invalidStartEnd']){
							html = '<p class="red">End date must not be smaller than start date.</p>';
							target.append(html);
						}
						if(data['isPast']){
							html = '<p class="red">You are only allowed to add objective(s) into future months.</p>';
							target.append(html);
						}
						if(data['noKRASelected']){
							html = '<p class="red">Select at least one objective.</p>';
							target.append(html);
						}
					}
					else if(data['success']){
						window.history.back();
					}
				}
			}
			else{
				// redirect to home page when user is not logged in
                window.location.href = "../../index.php";
			}
		})
		//using the fail promise callback
		.fail(function(data){
            window.location.href = "../../500.php";
		});
		
	});
	
	this.getElementById('setKRACancel').addEventListener('click',function(){
		window.history.back();
	}, false);
})


function getKRA(){
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'../../data/admin/kra/getkratemplatelist.php',		//the url where we want to POST
			data		: {},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){ 
		var target = $('#kraList');
		var html;
		if(data['return']){
			for(var i = 0; i < data['kraCategory'].length; i++){
				html = '<p><b>' + data['kraCategory'][i]['category']['title'] + '</b></p>';
				target.append(html);
				for(var j = 0; j < data['kraCategory'][i]['kra'].length; j++){
					html = '<input type="checkbox" name="kra_list[]" value="'+ data['kraCategory'][i]['category']['id']
							+ ',' + data['kraCategory'][i]['kra'][j]['id'] 
							+ ',' + data['kraCategory'][i]['kra'][j]['description']
							+ '">'
						    + data['kraCategory'][i]['kra'][j]['title'] + '</br>';
					target.append(html);
				}
			}
		}
		else{
			window.history.back();
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "../../500.php";
	});
}