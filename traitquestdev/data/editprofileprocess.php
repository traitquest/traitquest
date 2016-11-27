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
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "employee" ){// if employee is not logged in as admin
			$data['loggedIn'] = true;
			$userid = $_SESSION['userID'];
			
			if (isset($_POST['address']))				            {$address 	= trim($_POST ['address']);} else { $address='';}
			if (isset($_POST['phone']))			                    $phone 		= trim($_POST ['phone']);
			
			// check if there is match of company name and admin email
			$checkSQL = "SELECT * FROM employee 
							 WHERE id = :id
							 LIMIT 1";
			$employeePDO = $conn->prepare($checkSQL);
			$employeePDO->bindParam(':id', $userid, PDO::PARAM_INT);
			$employeePDO->execute();
			
			if($employeePDO->rowCount() != 0){
				$employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC);
				
				$updateSQL = "UPDATE employee
                              SET address= :address, phone= :phone
                              WHERE id = :id";
				$updateEmployeePDO = $conn->prepare($updateSQL);
				$updateEmployeePDO->execute(array(
											':id'=> $userid,
											':address'=> $address,
											':phone'=> $phone
											));		
				$data['editSuccess'] = true;
				
			}
			else{
				$data['error'] = "Some error has occured. Please try again later.";
				$data['editSuccess'] = false;
			}
			
		}
		else{// if user is not logged in
			$data['loggedIn'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>