<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	
	// STATUS OF THE KPI
	$pending = false;
	$submitted = false;
	$verified = false;
	$denied = false;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "employee" ){// if employee is not logged in as admin
			$data['loggedIn'] = true;
			$userID = $_SESSION['userID'];
			$companyID = $_SESSION['companyID'];
			$kpiID = isset($_POST['kpiID']) ? intval($_POST['kpiID']) : 0;
			if (isset($_POST['action']))			                 {$action = trim($_POST['action']);}else{$action='';}
			
			if($action == '' || $kpiID == 0){
				$validated = false;
			}
			
			if($validated){
				$checkKPISQL = "SELECT * FROM kpi 
								 WHERE id = :id
								 LIMIT 1";
				$kpiPDO = $conn->prepare($checkKPISQL);
				$kpiPDO->bindParam(':id', $kpiID, PDO::PARAM_INT);
				$kpiPDO->execute();
				if($kpiPDO->rowCount() != 0){
					$kpiResult = $kpiPDO->fetch(PDO::FETCH_ASSOC);
					$subordinateID = $kpiResult['employeeid'];
					
					if( checkSupervisor( $conn, $companyID, $userID, $subordinateID ) > 0 ){
						// GET STATUS OF THE KPI
						if($kpiResult['issubmitted'] == 0 && $kpiResult['ischecked'] == 0 && $kpiResult['isverified'] == 0){
							$pending = true;
							$data['pending'] = true;
						}
						else if($kpiResult['issubmitted'] == 1 && $kpiResult['ischecked'] == 0 && $kpiResult['isverified'] == 0){
							$submitted = true;
							$data['submitted'] = true;
						}
						else if($kpiResult['issubmitted'] == 1 && $kpiResult['ischecked'] == 1 && $kpiResult['isverified'] == 1){
							$verified = true;
							$data['verified'] = true;
						}
						else if($kpiResult['issubmitted'] == 1 && $kpiResult['ischecked'] == 1 && $kpiResult['isverified'] == 0){
							$denied = true;
							$data['denied'] = true;
						}
						
						if( $action == 'verify' && ( $submitted || $denied ) ){
							// VERIFY KPI
							$updateSQL = "UPDATE kpi
										  SET ischecked = TRUE,
											  isverified = TRUE
										  WHERE id = :id";
							$updateKPIPDO = $conn->prepare($updateSQL);
							$updateKPIPDO->execute(array(
														':id'=> $kpiID
													));	
													
							// TODO: SEND EMAIL TO EMPLOYEE
							$data['verifySuccess'] = true;
						}
						else{
							$data['verifyFailure'] = true;
						}
						
						if( $action == 'deny' && ( $submitted || $verified  ) ){
							// DENY KPI
							$updateSQL = "UPDATE kpi
										  SET ischecked = TRUE,
											  isverified = FALSE
										  WHERE id = :id";
							$updateKPIPDO = $conn->prepare($updateSQL);
							$updateKPIPDO->execute(array(
														':id'=> $kpiID
													));	
													
							// TODO: SEND EMAIL TO EMPLOYEE
							$data['denySuccess'] = true;
						}	
						else{
							$data['denyFailure'] = true;
						}						
					}
					else{
						$data['error'] = true;
					}
				}
				else{
					$data['error'] = true;
				}
			} 
			else{
				$data['error'] = true;
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
	
	function checkSupervisor( $conn, $company, $superior, $subordinate ){
		$checkSQL = "SELECT * FROM supervisor 
					 WHERE companyid = :companyid
					       AND superiorid = :superiorid
					       AND subordinateid = :subordinateid
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':companyid'=> $company,
								':superiorid'=> $superior,
								':subordinateid'=> $subordinate
								));	
		return $checkPDO->rowCount(); 
	}
?>