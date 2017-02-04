<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "admin" ){// if employee is logged in as admin
			$data['adminLoggedIn'] = true;
			$employeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			$companyID = $_SESSION['companyID'];
			
			// check if there is match of company name and employee id
			$checkSQL = "SELECT * FROM employee 
							 WHERE id = :id
								   AND companyid = :companyid
							 LIMIT 1";
			$userPDO = $conn->prepare($checkSQL);
			$userPDO->bindParam(':id', $employeeID, PDO::PARAM_INT);
			$userPDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
			$userPDO->execute();
			
			if($userPDO->rowCount() != 0){
				$userResult = $userPDO->fetch(PDO::FETCH_ASSOC);
				$data['employee'] = $userResult;
				
				$data['department'] = null;
				$departmentID = $userResult['departmentid'];
				$deptSQL = "SELECT * FROM department 							 
							 WHERE id = :id
							 LIMIT 1";
				$deptPDO = $conn->prepare($deptSQL);
				$deptPDO->bindParam(':id', $departmentID, PDO::PARAM_INT);
				$deptPDO->execute();
				
				if($deptPDO->rowCount() != 0){
					$deptResult = $deptPDO->fetch(PDO::FETCH_ASSOC);
					$data['department'] = $deptResult;
				}
				$data['return'] = true;
			}
			else{
				$data['error'] = "Some error has occured. Please try again later.";
				$data['return'] = false;
			}
		}
		else{// if user is logged in
			$data['adminLoggedIn'] = false;
			$data['return'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>