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
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "admin" ){// if employee is logged in as admin
			$data['adminloggedIn'] = true;
			$companyID = $_SESSION['companyID'];
			$employeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			if (isset($_POST['employeeName']))			    $name 		= trim($_POST ['employeeName']);
			if (isset($_POST['employeeCode']))			    $code 		= trim($_POST ['employeeCode']);
			
			if(!trim($_POST ['employeeName'])){//if employee's name is filled up
				$data['error'] = "Employee name should not be left empty";
				$validated = false;
			}
			
			if($validated == true){
				// check if there is match of company name and admin email
				$checkSQL = "SELECT * FROM employee 
								 WHERE id = :id
									   AND companyid = :companyid
								 LIMIT 1";
				$employeePDO = $conn->prepare($checkSQL);
				$employeePDO->bindParam(':id', $employeeID, PDO::PARAM_INT);
				$employeePDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
				$employeePDO->execute();
				
				if($employeePDO->rowCount() != 0){
					$employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC);
					
					$updateSQL = "UPDATE employee
								  SET name = :name, code = :code
								  WHERE id = :id";
					$updateEmployeePDO = $conn->prepare($updateSQL);
					$updateEmployeePDO->execute(array(
												':id'=> $employeeID,
												':name'=> $name,
												':code'=> $code
												));		
					$data['editSuccess'] = true;
					
				}
				else{
					$data['error'] = "Some error has occured. Please try again later.";
					$data['editSuccess'] = false;
				}
			}
			else{
				$data['editSuccess'] = false;
			}
		}
		else{// if user is not logged in
			$data['adminloggedIn'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>