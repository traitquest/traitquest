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
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "admin" ){// if user is admin
			$companyID = $_SESSION['companyID'];
			$selectedID = isset($_POST['selectedEmployeeID']) ? intval($_POST['selectedEmployeeID']) : 0;
			$currentID = isset($_POST['currentEmployeeID']) ? intval($_POST['currentEmployeeID']) : 0;
			if (isset($_POST['action']) && $_POST['action'] == 'assignSuperior') {
				if ($selectedID > 0 and $currentID > 0 ) {
					if( checkSuperiorExists($conn, $companyID, $selectedID, $currentID) == 0 ){
						$addSuperiorSQL = "INSERT INTO `supervisor` (companyid, superiorid, subordinateid) 
											VALUES (:companyid, :superiorid, :subordinateid)";;
						$employeePDO = $conn->prepare($addSuperiorSQL);
						$employeePDO->execute(array(
												':companyid'=> $companyID,
												':superiorid'=> $selectedID,
												':subordinateid'=> $currentID
												));
						
						$checkSQL = "SELECT * FROM employee 
									 WHERE companyid = :companyid
									 AND id = :employeeid
									 LIMIT 1";
						$checkPDO = $conn->prepare($checkSQL);
						$checkPDO->execute(array(
												':companyid'=> $companyID,
												':employeeid'=> $selectedID
												));
						$data['employee'] = $checkPDO->fetch(PDO::FETCH_ASSOC);
						
						$data['response'] = 'superiorAssigned';
					}
					else{
						$data['response'] = 'superiorAlreadyAssigned';
					}
				} else {
					$data['response'] = 'err';
				}
			}
			else if (isset($_POST['action']) && $_POST['action'] == 'assignSubordinate') {
				if ($selectedID > 0 and $currentID > 0 ) {
					if( checkSuperiorExists($conn, $companyID, $currentID, $selectedID) == 0 ){
						$addSubordinateSQL = "INSERT INTO `supervisor` (companyid, superiorid, subordinateid) 
												VALUES (:companyid, :superiorid, :subordinateid)";;
						$employeePDO = $conn->prepare($addSubordinateSQL);
						$employeePDO->execute(array(
												':companyid'=> $companyID,
												':superiorid'=> $currentID,
												':subordinateid'=> $selectedID
												));
																		
						$checkSQL = "SELECT * FROM employee 
									 WHERE companyid = :companyid
									 AND id = :employeeid
									 LIMIT 1";
						$checkPDO = $conn->prepare($checkSQL);
						$checkPDO->execute(array(
												':companyid'=> $companyID,
												':employeeid'=> $selectedID
												));
						$data['employee'] = $checkPDO->fetch(PDO::FETCH_ASSOC);
						
						$data['response'] = 'subordinateAssigned';
					}
					else{
						$data['response'] = 'subordinateAlreadyAssigned';
					}
				} else {
					$data['response'] = 'err';
				}
			}
			else if (isset($_POST['action']) && $_POST['action'] == 'removeSuperior') {
				if ($selectedID > 0 and $currentID > 0 ) {
					if( checkSuperiorExists($conn, $companyID, $selectedID, $currentID) > 0 ){
						$removeSuperiorSQL = "DELETE FROM supervisor 
												WHERE companyid = :companyid
													  AND superiorid = :superiorid
													  AND subordinateid = :subordinateid 
													  LIMIT 1";;
						$employeePDO = $conn->prepare($removeSuperiorSQL);
						$employeePDO->execute(array(
												':companyid'=> $companyID,
												':superiorid'=> $selectedID,
												':subordinateid'=> $currentID
												));
						$data['response'] = 'superiorRemoved';
					}
					else{
						$data['response'] = 'superiorAlreadyRemoved';
					}
				} else {
					$data['response'] = 'err';
				}
			}
			else if (isset($_POST['action']) && $_POST['action'] == 'removeSubordinate') {
				if ($selectedID > 0 and $currentID > 0 ) {
					if( checkSuperiorExists($conn, $companyID, $currentID, $selectedID) > 0 ){
						$removeSuperiorSQL = "DELETE FROM supervisor 
												WHERE companyid = :companyid
													  AND superiorid = :superiorid
													  AND subordinateid = :subordinateid 
													  LIMIT 1";;
						$employeePDO = $conn->prepare($removeSuperiorSQL);
						$employeePDO->execute(array(
												':companyid'=> $companyID,
												':superiorid'=> $currentID,
												':subordinateid'=> $selectedID
												));
						$data['response'] = 'subordinateRemoved';
					}
					else{
						$data['response'] = 'subordinateAlreadyRemoved';
					}
				} else {
					$data['response'] = 'err';
				}
			}
		}
		else{
			$data['response'] = 'err';
		}
		echo json_encode( $data );
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
	function checkSuperiorExists( $conn, $companyID, $superiorID, $subordinateID ){
		$checkSQL = "SELECT * FROM supervisor 
					 WHERE companyid = :companyid
					 AND superiorid = :superiorid
					 AND subordinateid = :subordinateid
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':companyid'=> $companyID,
								':superiorid'=> $superiorID,
								':subordinateid'=> $subordinateID
								));	
		return $checkPDO->rowCount(); 
	}
?>