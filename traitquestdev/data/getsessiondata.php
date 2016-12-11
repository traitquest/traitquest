<?php
	session_start();
	$data = array();		// array to pass back data

	$data['companyID'] = $_SESSION['companyID'];	
	$data['userID'] = $_SESSION['userID'];	
	$data['name'] = $_SESSION['name'];	
	$data['logintype'] = $_SESSION['logintype'];	
	
	echo json_encode($data);

?>