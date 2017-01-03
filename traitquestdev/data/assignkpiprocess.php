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
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID'])){// if employee is logged in
			$data['loggedIn'] = true;
			$data['completeInformation'] = true;
			$data['returnToPreviousPage'] = false;
			$kpiID = isset($_POST['kpiID']) ? intval($_POST['kpiID']) : 0;
			$companyID = $_SESSION['companyID'];
			$currentEmployeeID = $_SESSION['userID'];
			$selectedEmployeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			if (isset($_POST['action']))				            $action		= trim($_POST ['action']);
			if (isset($_POST['month']))			                    $month 		= trim($_POST ['month']);
			if (isset($_POST['year']))			                    $year 		= trim($_POST ['year']);
			if (isset($_POST['kra']))				            	$kra		= trim($_POST ['kra']);
			if (isset($_POST['kpi']))			                    $kpi 		= trim($_POST ['kpi']);
			if (isset($_POST['description']))			            $description= trim($_POST ['description']);
			
			//set return to previous page as true once month and year is not validated
			if($validated == false){
				$data['returnToPreviousPage'] = true;
			}
								
			// check if data is correct
			if( $selectedEmployeeID == 0 || !trim($_POST ['action'])){
				$data['returnToPreviousPage'] = true;
				$validated = false;
			}
			else if( trim($_POST ['action']) == 'edit' && $kpiID == 0 ){
				$data['returnToPreviousPage'] = true;
				$validated = false;
			}
			
			if(trim($_POST ['kra']) == 0){//if kra is filled up
				$data['kra'] = "Please select a KRA";
				$validated = false;
			}
			
			if(trim($_POST ['kpi']) == 0){//if kpi is filled up
				$data['kpi'] = "Please select a KPI";
				$validated = false;
			}
			
			if($month < 10){
				$month = '0'.$month;
			}
			$start = date($year.'-'.$month.'-01'); // hard-coded '01' for first day
			$end  = date($year.'-'.$month.'-t');
			
			$currentYear = date('Y');
			$currentMonth = date('m');
			$startOfCurrentMonth = date($currentYear.'-'.$currentMonth.'-01');
			if($startOfCurrentMonth > $start ){
				$data['date'] = "You are not allowed to make changes on KPI the past";
				$validated = false;
			}			
			
			if($validated == true){
				
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
					if($action == "edit"){
						$updateSQL = "UPDATE kpi
									  SET kratemplateid = :kratemplateid, kpitemplateid = :kpitemplateid, description = :description
									  WHERE id = :id";
						$updateKPIPDO = $conn->prepare($updateSQL);
						$updateKPIPDO->execute(array(
												':id'=> $kpiID,
												':kratemplateid'=> $kra,
												':kpitemplateid'=> $kpi,
												':description'=> $description
												));	
						$data['success'] = true;
					}
					else{
						$addKPISQL = "INSERT INTO `kpi` (employeeid, companyid, kratemplateid, kpitemplateid, description, startdate, enddate) 
														VALUES (:employeeid, :companyid, :kratemplateid, :kpitemplateid, :description, :startdate, :enddate)";
						$addKPIPDO = $conn->prepare($addKPISQL);
						$addKPIPDO->execute(array(
									':employeeid'=> $selectedEmployeeID,
									':companyid'=> $companyID,
									':kratemplateid'=> $kra,
									':kpitemplateid'=> $kpi,
									':description'=> $description,
									':startdate'=> $start,
									':enddate'=> $end
						));
						$data['success'] = true;
					}

				}
				else{
					$data['returnToPreviousPage'] = true;
				}
			}
			else{
				$data['completeInformation'] = false;
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