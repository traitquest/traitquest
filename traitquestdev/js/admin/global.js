// JavaScript Document
$(document).ready(function(){
	var name, profilePic;
	getSessionData();
	
	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		TO RETRIEVE SESSION DATA
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	function getSessionData(){
		$.ajax({
			type:'post',
			url:'../../data/getsessiondata.php',
			data:{},
			success:function(result){
				var data = JSON.parse(result);
				if(data['active']){
					name = data['name'];	
					profilePic = data['companyPic'];
					
					$('.userPic').each(function(){
						$(this).attr('src', profilePic);
					});
					
					$('.userName').each(function(){
						$(this).text(name);
					});
				}
				else{
					window.location.href = "../../index.php";
				}
			}
		})
	}
})