<?php
	session_start();
	$data = array();		// array to pass back data
	$data['active'] = false;
	
	if(isset($_SESSION['companyID']) 
		&& isset($_SESSION['userID']) 
		&& isset($_SESSION['name']) 
		&& isset($_SESSION['profilePic']) 
		&& isset($_SESSION['logintype']) ){
		
		$data['companyID'] = $_SESSION['companyID'];	
		$data['userID'] = $_SESSION['userID'];	
		$data['name'] = $_SESSION['name'];
		$data['profilePic'] = $_SESSION['profilePic']; 
		$data['logintype'] = $_SESSION['logintype'];	
		$data['active'] = true;		
	}
		
	
	echo json_encode($data);

?>