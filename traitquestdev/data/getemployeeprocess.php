<?php
	include "../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) ){// if employee is not logged in as admin
			$data['userLoggedIn'] = true;
			$userid = $_SESSION['userID'];
				
			// check if there is match of company name and admin email
			$checkSQL = "SELECT * FROM employee 
							 WHERE id = :id
							 LIMIT 1";
			$userPDO = $conn->prepare($checkSQL);
			$userPDO->bindParam(':id', $userid, PDO::PARAM_INT);
			$userPDO->execute();
			
			if($userPDO->rowCount() != 0){
				$userResult = $userPDO->fetch(PDO::FETCH_ASSOC);
				$data['employee'] = $userResult;
				$data['return'] = true;
			}
			else{
				$data['error'] = "Some error has occured. Please try again later.";
				$data['return'] = false;
			}
			
		}
		else{// if user is logged in
			$data['userLoggedIn'] = false;
			$data['return'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>