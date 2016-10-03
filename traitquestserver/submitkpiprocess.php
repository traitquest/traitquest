<?php
	include "connection.php";

	session_start();
	$data = array();		// array to pass back data
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID'])){// if user is logged in
			$data['userLoggedIn'] = true;
			
			//$userID = $_SESSION['userID'];
			//$companyID = $_SESSION['companyID'];
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
			$iscompleted = TRUE;
			$updatekpiSQL = "UPDATE kpi
							SET iscompleted = :iscompleted
								 WHERE id = :id";
			$kpiPDO = $conn->prepare($updatekpiSQL);
			$kpiPDO->bindParam(':id', $id, PDO::PARAM_INT);
			$kpiPDO->bindParam(':iscompleted', $iscompleted, PDO::PARAM_BOOL);
			
			$kpiPDO->execute();
			
			$data['completed'] = true;
			
		}
		else{
			$data['userLoggedIn'] = false;
		}
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
?>