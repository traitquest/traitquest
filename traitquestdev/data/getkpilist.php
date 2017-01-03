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
	
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "employee" ){// if user is admin
			$validated = true;
			$data['isEmployee'] = true;
			$data['isPast'] = false;
			$companyID = $_SESSION['companyID'];
			$employeeID = $_SESSION['userID'];
			$selectedEmployeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			if(isset($_POST['month']))			{$month = trim($_POST['month']);}else{$validated = false;}
			if(isset($_POST['year']))			{$year = trim($_POST['year']);}else{$validated = false;}
			
			if($month < 10){
				$month = '0'.$month;
			}
			$start = date($year.'-'.$month.'-01'); // hard-coded '01' for first day
			$end  = date($year.'-'.$month.'-t');
			
			$currentYear = date('Y');
			$currentMonth = date('m');
			$startOfCurrentMonth = date($currentYear.'-'.$currentMonth.'-01');
			if($startOfCurrentMonth > $start ){
				$data['isPast'] = true;
			}
			
			if($validated == true){
				$data['response'] = 'validated';
				// Check if logged in employee has the right to view the employee's KPI:
				// 1. has supervisor role
				// 2. viewing his/her own KPI
				if($employeeID == $selectedEmployeeID){
					$hasAuthorization = true;
				}
				else{
					$checkSQL = "SELECT * FROM supervisor 
								 WHERE companyid = :companyid
										AND superiorid = :superiorid
										AND subordinateid = :subordinateid
								 LIMIT 1";
					$supervisorPDO = $conn->prepare($checkSQL);
					$supervisorPDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
					$supervisorPDO->bindParam(':superiorid', $employeeID, PDO::PARAM_INT);
					$supervisorPDO->bindParam(':subordinateid', $selectedEmployeeID, PDO::PARAM_INT);
					$supervisorPDO->execute();
					
					if($supervisorPDO->rowCount() > 0){
						$hasAuthorization = true;
					}
					else{
						$hasAuthorization = false;
					}
				}
				
				if($hasAuthorization){
					if($month < 10){
						$month = '0'.$month;
					}
					$start = date($year.'-'.$month.'-01'); // hard-coded '01' for first day
					$end  = date($year.'-'.$month.'-t');
					$checkKPISQL = "SELECT * FROM kpi 
									 WHERE employeeid = :employeeid
										AND startdate >= '".$start."'
										AND	enddate <= '".$end."'";
					$kpiPDO = $conn->prepare($checkKPISQL);
					$kpiPDO->bindParam(':employeeid', $selectedEmployeeID, PDO::PARAM_INT);
					$kpiPDO->execute();
										
					if($kpiPDO->rowCount() > 0){
						$data['return'] = true;
						$data['hasresult'] = true;
						
						while($kpiResult = $kpiPDO->fetch(PDO::FETCH_ASSOC)){
							$data['result'][$i]['kpi'] = $kpiResult;
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
								$data['result'][$i]['kraCategory'] = $kraTemplateResult;
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
								$data['result'][$i]['kpiCategory'] = $kpiTemplateResult;
							}
							
							$i++;
						}
					}
					else{
						$data['return'] = true;
						$data['hasresult'] = false;
					}
				}
				else{
					$data['return'] = false;
				}			
			}
			else{
				$data['return'] = false;
			}
			
		}
		else{
			$data['isEmployee'] = false;
		}
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
?>