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
		
		if ( isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "employee" ){// if employee is logged in as employee
			$data['loggedIn'] = true;			
			$kpiID = isset($_POST['kpiID']) ? intval($_POST['kpiID']) : 0;
			$companyID = $_SESSION['companyID'];
			$currentEmployeeID = $_SESSION['userID'];
			$selectedEmployeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			
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
				// check if there is match of kpi id
				$checkSQL = "SELECT * FROM kpi 
								 WHERE id = :id
								 LIMIT 1";
				$kpiPDO = $conn->prepare($checkSQL);
				$kpiPDO->bindParam(':id', $kpiID, PDO::PARAM_INT);
				$kpiPDO->execute();
				
				if($kpiPDO->rowCount() != 0){
					$kpiResult = $kpiPDO->fetch(PDO::FETCH_ASSOC);
					$data['kpi'] = $kpiResult;
					
					$kraTemplateID = $kpiResult['kratemplateid'];
					$kpiTemplateID = $kpiResult['kpitemplateid'];
					
					// get kra category
					$checkKRASQL = "SELECT * FROM kratemplate 
									 WHERE id = :id
									 LIMIT 1";
					$checkKRAPDO = $conn->prepare($checkKRASQL);
					$checkKRAPDO->bindParam(':id', $kraTemplateID, PDO::PARAM_INT);
					$checkKRAPDO->execute();
					
					if($checkKRAPDO->rowCount() != 0){
						$kraTemplateResult = $checkKRAPDO->fetch(PDO::FETCH_ASSOC);
						$data['kraTemplate'] = $kraTemplateResult;
					}
					
					// get kpi category
					$checkKPISQL = "SELECT * FROM kpitemplate 
									 WHERE id = :id
									 LIMIT 1";
					$checkKPIPDO = $conn->prepare($checkKPISQL);
					$checkKPIPDO->bindParam(':id', $kpiTemplateID, PDO::PARAM_INT);
					$checkKPIPDO->execute();
					
					if($checkKPIPDO->rowCount() != 0){
						$kpiTemplateResult = $checkKPIPDO->fetch(PDO::FETCH_ASSOC);
						$data['kpiTemplate'] = $kpiTemplateResult;
					}
					
					$data['return'] = true;
				}
				else{
					$data['error'] = "Some error has occured. Please try again later.";
					$data['return'] = false;
				}
			}
		}
		else{// if user is logged in
			$data['loggedIn'] = false;
			$data['return'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>