<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$i = 0;
	$j = 0;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) ){// if employee is not logged in as admin
			$data['userLoggedIn'] = true;
			$companyID = $_SESSION['companyID'];
			$selectedEmployee = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			
			if($selectedEmployee == 0){
				$selectedEmployee = $_SESSION['userID'];
				$data['ownProfile'] = true;
			}
				
			// Get superiors of the current employee
			$supervisorSQL = "SELECT * FROM supervisor 
							 WHERE companyid = :companyid
							 AND subordinateid = :subordinateid";
			$supervisorPDO = $conn->prepare($supervisorSQL);
			$supervisorPDO->execute(array(
									':companyid'=> $companyID,
									':subordinateid'=> $selectedEmployee
									));	
			
			if($supervisorPDO->rowCount() > 0){
				while($supervisorResult = $supervisorPDO->fetch(PDO::FETCH_ASSOC)){
					$data['superior'][$i] = $supervisorResult;
					
					$employeeID = $data['superior'][$i]['superiorid'];
					$employeeSQL = "SELECT * FROM employee 
									 WHERE companyid = :companyid
									 AND id = :id";
					$employeePDO = $conn->prepare($employeeSQL);
					$employeePDO->execute(array(
											':companyid'=> $companyID,
											':id'=> $employeeID
											));
					if($employeePDO->rowCount() > 0){
						$employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC);
						$data['superior'][$i]['data'] = $employeeResult;
						$i++;
					}
				}
			}
			else{
				$data['superiorResponse'] = 'noResult';
			}
			
			// Get subordinates of the current employee			
			$subordinateSQL = "SELECT * FROM supervisor 
						 WHERE companyid = :companyid
						 AND superiorid = :superiorid";
			$subordinatePDO = $conn->prepare($subordinateSQL);
			$subordinatePDO->execute(array(
									':companyid'=> $companyID,
									':superiorid'=> $selectedEmployee
									));	

			if($subordinatePDO->rowCount() > 0){
				while($subordinateResult = $subordinatePDO->fetch(PDO::FETCH_ASSOC)){
					$data['subordinate'][$j] = $subordinateResult;
					
					$employeeID = $data['subordinate'][$j]['subordinateid'];
					$employeeSQL = "SELECT * FROM employee 
								 WHERE companyid = :companyid
								 AND id = :id";
					$employeePDO = $conn->prepare($employeeSQL);
					$employeePDO->execute(array(
											':companyid'=> $companyID,
											':id'=> $employeeID
											));
					if($employeePDO->rowCount() > 0){
						$employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC);
						$data['subordinate'][$j]['data'] = $employeeResult;
						$j++;
					}
				}
			}
			else{
				$data['subordinateResponse'] = 'noResult';
			}
			$data['return'] = true;
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