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
			if(isset($_POST['departmentID']))	$departmentID = isset($_POST['departmentID']) ? intval($_POST['departmentID']) : 0;
			if(isset($_POST['departmentName']))	{$departmentName = trim($_POST['departmentName']);}else{$departmentName = '';}
			
			if($validated && ($action == 'new' || $departmentID != 0) ){				
				
				if($action != 'new'){
					// for edit and delete department
					if(checkDepartmentExists($conn, $companyID, $departmentID) > 0){
						if($action == 'edit'){
							$updateSQL = "UPDATE department
									  SET name = :name
									  WHERE id = :id";
							$updateDepartmentPDO = $conn->prepare($updateSQL);
							$updateDepartmentPDO->execute(array(
														':id'=> $departmentID,
														':name'=> $departmentName
														));	
							$data['editSuccess'] = true;
						}
						else if($action == 'delete'){
							$deleteSQL = "DELETE FROM department WHERE id=".$departmentID." LIMIT 1";
							$updateDepartmentPDO = $conn->prepare($deleteSQL);
							$updateDepartmentPDO->execute();
							$data['deleteSuccess'] = true;
						}
					}
					else{
						$data['error'] = true;
					}
				}
				else{
					// for create new department
					$addDepartmentSQL = "INSERT INTO `department` (companyid, name) 
													VALUES (:companyid, :name)";
					$addDepartmentPDO = $conn->prepare($addDepartmentSQL);
					$addDepartmentPDO->execute(array(
								':companyid'=> $companyID,
								':name'=> $departmentName,
								));
					$data['newSuccess'] = true;
					
					$lastDepartmentID = $conn->lastInsertId();
					$lastDepartmentSQL = "SELECT * FROM department
											WHERE id = :id";
					$lastDepartmentPDO = $conn->prepare($lastDepartmentSQL);
					$lastDepartmentPDO->bindParam(':id', $lastDepartmentID, PDO::PARAM_STR);
					$lastDepartmentPDO->execute();
					
					$departmentResult = $lastDepartmentPDO->fetch(PDO::FETCH_ASSOC);
					$data['newdepartment'] = $departmentResult;
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
	
	function checkDepartmentExists( $conn, $companyID, $id ){
		$checkSQL = "SELECT * FROM department 
					 WHERE companyid = :companyid
					 AND id = :id
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':companyid'=> $companyID,
								':id'=> $id
								));	
		return $checkPDO->rowCount(); 
	}
?>