<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "admin" ){// if user is admin
			$data['isAdmin'] = true;
			$companyID = $_SESSION['companyID'];
			
			if(isset($_POST['action']))			{$action = trim($_POST['action']);}else{$validated=false;}
			if(isset($_POST['month']))			{$month = trim($_POST['month']);}else{$validated=false;}
			if(isset($_POST['year']))			{$year = trim($_POST['year']);}else{$validated=false;}
			if(isset($_POST['kraID']))			$kraID = isset($_POST['kraID']) ? intval($_POST['kraID']) : 0;
			if(isset($_POST['description']))	{$description = trim($_POST['description']);}else{$description = '';}
			
			if($validated){				
				if($month < 10){
					$month = '0'.$month;
				}
				
				$start = date($year.'-'.$month.'-01'); // hard-coded '01' for first day
				$end = date("Y-m-t", strtotime($start));
				
				if(checkKRAExists($conn, $companyID, $kraID, $start, $end) > 0){
					if($action == 'edit'){
						$updateSQL = "UPDATE kra
								  SET description = :description
								  WHERE id = :id";
						$updateKRAPDO = $conn->prepare($updateSQL);
						$updateKRAPDO->execute(array(
													':id'=> $kraID,
													':description'=> $description
													));	
						$data['editSuccess'] = true;
					}
					else if($action == 'delete'){
						$deleteSQL = "DELETE FROM kra WHERE id=".$kraID." LIMIT 1";
						$updateKRAPDO = $conn->prepare($deleteSQL);
						$updateKRAPDO->execute();
						$data['deleteSuccess'] = true;
					}
				}
				else{
					$data['error'] = true;
				}
			}
			else{
				$data['fatalError'] = true;
			}	
		}	
		else{
			$data['isAdmin'] = false;
		}		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
	function checkKRAExists( $conn, $companyID, $id, $start, $end ){
		$checkSQL = "SELECT * FROM kra 
					 WHERE companyid = :companyid
					 AND id = :id
					 AND startdate >= '".$start."'
					 AND enddate <= '".$end."'
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':companyid'=> $companyID,
								':id'=> $id
								));	
		return $checkPDO->rowCount(); 
	}
?>