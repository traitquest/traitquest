<?php
	session_start();
	$currentURL = 'index';
	if(isset($_SESSION['currentURL'])){
		$currentURL = $_SESSION['currentURL'];
	}
	session_destroy();

	echo "Logging out...";

	header('location:'.$currentURL);
?>