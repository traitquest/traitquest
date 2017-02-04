<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	$i = 0;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "admin" ){// if user is admin
			$data['isAdmin'] = true;
			$companyID = $_SESSION['companyID'];
	
			$checkSQL = "SELECT * FROM department 
								 WHERE companyid = :companyid
								 ORDER BY name";
			$departmentPDO = $conn->prepare($checkSQL);
			$departmentPDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
			$departmentPDO->execute();
			
			if($departmentPDO->rowCount() > 0){
				$data['return'] = true;
				
				while($departmentResult = $departmentPDO->fetch(PDO::FETCH_ASSOC)){
					$data['department'][$i] = $departmentResult;					
					$i++;
				}
			}
			else{
				$data['return'] = false;
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
	
?>