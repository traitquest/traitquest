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
			$userid = $_SESSION['userID'];
			$kpiID = isset($_POST['kpiID']) ? intval($_POST['kpiID']) : 0;
			$kpiLogID = isset($_POST['kpiLogID']) ? intval($_POST['kpiLogID']) : 0;
			if (isset($_POST['remarks']))				            {$remarks 	= trim($_POST ['remarks']);} else {$remarks='';}
			$progress = isset($_POST['progress']) ? intval($_POST['progress']) : 0;
			$day = isset($_POST['day']) ? intval($_POST['day']) : 0;
			$month = isset($_POST['month']) ? intval($_POST['month']) : 0;
			$year = isset($_POST['year']) ? intval($_POST['year']) : 0;
			if (isset($_POST['action']))			                 {$action = trim($_POST['action']);}else{$action='';}
			
			if($action == '' || $kpiID == 0){
				$validated = false;
			}
			else if($action == 'new' && ($day == 0 || $month == 0 || $year == 0)){
				$validated = false;
			}
			else if(($action == 'edit' || $action == 'delete') && $kpiLogID == 0){
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
					
					if($pending || $denied){
						
						if($action == 'new'){
							// NEW KPI LOG
							$date = date($day.'-'.$month.'-'.$year);
											
							if($date < $kpiResult['startdate'] || $date > $kpiResult['enddate']){
								$data['dateOutOfScope'] = "Date should be between ".$kpiResult['startdate']." and ".$kpiResult['enddate'].".";
							}
							else{
								if(checkKPILogSameDateExists($conn, $kpiID, $date)){
									$data['sameDate'] = "A KPI log has been added on the same day.";
								}
								else{
									$addKPILogSQL = "INSERT INTO `kpilog` (kpiid, remarks, date, progress) 
														VALUES (:kpiid, :remarks, :date, :progress)";
									$addKPILogPDO = $conn->prepare($addKPILogSQL);
									$addKPILogPDO->execute(array(
												':kpiid'=> $kpiID,
												':remarks'=> $remarks,
												':date'=> $date,
												':progress'=> $progress
												));
									
									// CALCULATE NEW PROGRESS FOR THE KPI
									$newProgress = $kpiResult['progress'] + $progress;
										
									$data['newSuccess'] = true;
								}
							}						
						}
						else{
							$checkKPILogSQL = "SELECT * FROM kpilog 
											 WHERE id = :id
											 LIMIT 1";
							$kpiLogPDO = $conn->prepare($checkKPILogSQL);
							$kpiLogPDO->bindParam(':id', $kpiLogID, PDO::PARAM_INT);
							$kpiLogPDO->execute();
							if($kpiLogPDO->rowCount() != 0){
								$kpiLogResult = $kpiLogPDO->fetch(PDO::FETCH_ASSOC);
							
								if($action == 'edit'){
									// EDIT KPI LOG
									$updateSQL = "UPDATE kpilog
												  SET remarks = :remarks,
													  progress = :progress
												  WHERE id = :id";
									$updateKPILogPDO = $conn->prepare($updateSQL);
									$updateKPILogPDO->execute(array(
																':id'=> $kpiLogID,
																':remarks'=> $remarks,
																':progress'=> $progress
																));	
									// CALCULATE NEW PROGRESS FOR THE KPI
									$newProgress = $kpiResult['progress'] - $kpiLogResult['progress'] + $progress;
									$data['editSuccess'] = true;
								}
								else if($action == 'delete'){
									// DELETE KPI LOG
									$deleteSQL = "DELETE FROM kpilog WHERE id=".$kpiLogID." LIMIT 1";
									$updateKPILogPDO = $conn->prepare($deleteSQL);
									$updateKPILogPDO->execute();
									// CALCULATE NEW PROGRESS FOR THE KPI
									$newProgress = $kpiResult['progress'] - $kpiLogResult['progress'];
									$data['deleteSuccess'] = true;
								}
							}
						}
						
						// SET THE NEW PROGRESS TO THE KPI
						$updateKPISQL = "UPDATE kpi
										  SET progress = :progress
										  WHERE id = :id";
						$updateKPIPDO = $conn->prepare($updateKPISQL);
						$updateKPIPDO->execute(array(
												':id'=> $kpiID,
												':progress'=> $newProgress
												));
					}
					else{
						$data['canProcess'] = false;
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
	
	function checkKPILogSameDateExists( $conn, $kpiid, $date ){
		$checkSQL = "SELECT * FROM kpilog 
					 WHERE kpiid = :kpiid
					 AND date =".$date."
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':kpiid'=> $kpiid
								));	
		return $checkPDO->rowCount(); 
	}
?>