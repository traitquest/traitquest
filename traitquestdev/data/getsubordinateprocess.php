<?php
	include "../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$i = 0;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "employee" ){// if user is employee
			$companyID = $_SESSION['companyID'];
			$currentID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			if (isset($_POST['action']) && $_POST['action'] == 'getSuperior') {
				if ( $currentID > 0 ) {
					$data['response'] = 'success';
					$checkSQL = "SELECT * FROM supervisor 
								 WHERE companyid = :companyid
								 AND subordinateid = :subordinateid";
					$checkPDO = $conn->prepare($checkSQL);
					$checkPDO->execute(array(
											':companyid'=> $companyID,
											':subordinateid'=> $currentID
											));	
					
					if($checkPDO->rowCount() > 0){
						while($checkResult = $checkPDO->fetch(PDO::FETCH_ASSOC)){
							$data['result'][$i]['superior'] = $checkResult;
							
							$employeeID = $data['result'][$i]['superior']['superiorid'];
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
								$data['result'][$i]['superior']['data'] = $employeeResult;
								$i++;
							}
						}
					}
					else{
						$data['response'] = 'noResult';
					}
					
				} else {
					$data['response'] = 'error';
				}
			}
			else if (isset($_POST['action']) && $_POST['action'] == 'getSubordinate') {
				if ( $currentID > 0 ) {
					$data['response'] = 'success';
					$checkSQL = "SELECT * FROM supervisor 
								 WHERE companyid = :companyid
								 AND superiorid = :superiorid";
					$checkPDO = $conn->prepare($checkSQL);
					$checkPDO->execute(array(
											':companyid'=> $companyID,
											':superiorid'=> $currentID
											));	
					
					if($checkPDO->rowCount() > 0){
						while($checkResult = $checkPDO->fetch(PDO::FETCH_ASSOC)){
							$data['result'][$i]['subordinate'] = $checkResult;
							
							$employeeID = $data['result'][$i]['subordinate']['subordinateid'];
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
								$data['result'][$i]['subordinate']['data'] = $employeeResult;
								$i++;
							}
						}
					}
					else{
						$data['response'] = 'noResult';
					}
					
				} else {
					$data['response'] = 'error';
				}
			}
			
		}
		else{
			$data['response'] = 'isAdmin'; 
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;

?>