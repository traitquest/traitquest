<?php
	include "../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	$hasAuthorization = false;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID'])){// if employee is logged in
			$kpiID = isset($_POST['kpiID']) ? intval($_POST['kpiID']) : 0;
			$companyID = $_SESSION['companyID'];
			$currentEmployeeID = $_SESSION['userID'];
			$selectedEmployeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			
			// check if data is correct
			if( $selectedEmployeeID == 0 || $kpiID == 0 ){
				$data['response'] = 'return';
				$validated = false;
			}
						
			if($validated == true){
				if($currentEmployeeID == $selectedEmployeeID){
					$hasAuthorization = true;
				}
				else{
					// check if there is logged in employee is the supervisor
					$checkSQL = "SELECT * FROM supervisor 
									 WHERE companyid = :companyid
										AND superiorid = :superiorid
										AND subordinateid = :subordinateid
									 LIMIT 1";
					$supervisorPDO = $conn->prepare($checkSQL);
					$supervisorPDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
					$supervisorPDO->bindParam(':superiorid', $currentEmployeeID, PDO::PARAM_INT);
					$supervisorPDO->bindParam(':subordinateid', $selectedEmployeeID, PDO::PARAM_INT);
					$supervisorPDO->execute();
					
					if($supervisorPDO->rowCount() > 0){
						$hasAuthorization = true;
					}
				}				
				
				if($hasAuthorization){
					if( checkKPIExists($conn, $companyID, $selectedEmployeeID, $kpiID) > 0 ){
						$removeKPISQL = "DELETE FROM kpi 
												WHERE companyid = :companyid
														 AND employeeid = :employeeid
														 AND id = :id
													  LIMIT 1";;
						$kpiPDO = $conn->prepare($removeKPISQL);
						$kpiPDO->execute(array(
												':companyid'=> $companyID,
												':employeeid'=> $selectedEmployeeID,
												':id'=> $kpiID
												));
						$data['response'] = 'kpiRemoved';
					}
					else{
						$data['response'] = 'kpiAlreadyRemoved';
					}
				}
				else{
					$data['response'] = 'return';
				}
			}
		}
		else{// if user is not logged in
			$data['response'] = 'error';
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
	function checkKPIExists( $conn, $companyID, $selectedEmployeeID, $kpiID ){
		$checkSQL = "SELECT * FROM kpi 
					 WHERE companyid = :companyid
						 AND employeeid = :employeeid
						 AND id = :id
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':companyid'=> $companyID,
								':employeeid'=> $selectedEmployeeID,
								':id'=> $kpiID
								));	
		return $checkPDO->rowCount(); 
	}
?>