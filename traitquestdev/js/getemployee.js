// JavaScript Document
$(document).ready(function(){
	populateData();
})

function populateData(){
	$.ajax({
			type		:'POST', 	//define the type of HTTP verb we want to use
			url			:'data/getemployeeprocess.php',		//the url where we want to POST
			data		: {},		//our data object
			dataType	:'json',		//what type of data do we expect back from the server
			encode		:true
	})
	
	//using the done promise callback
	.done(function(data){
		if(data['return']){
			$('#mainContainer').append('<div class="fontsize-s">' + nl2br(data['employee']['name']) + '</div>');
			/*$("#address").value = data['company']['address'];
			$("#phone").value = data['company']['phone'];
			$("#website").value = data['company']['website'];
			$("#description").value = data['company']['description'];
			$("#vision").value = data['company']['vision'];
			$("#mission").value = data['company']['mission'];*/
		}
		else{
			window.location.href = "index.php";
		}
	})
	//using the fail promise callback
	.fail(function(data){
		window.location.href = "500.php";
	});
}

function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}