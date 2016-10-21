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
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "admin" ){// if user is admin
			$data['isAdmin'] = true;
			$companyID = $_SESSION['companyID'];
			
			$checkSQL = "SELECT * FROM employee 
								 WHERE companyid = :companyid
								 ORDER BY name ASC";
			$employeePDO = $conn->prepare($checkSQL);
			$employeePDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
			$employeePDO->execute();
			
			if($employeePDO->rowCount() > 0){
				$data['return'] = true;
				
				while($employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC)){
					$data['result'][$i]['employee'] = $employeeResult;
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