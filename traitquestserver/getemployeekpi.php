<?php
	include "connection.php";

	session_start();
	$data = array();		// array to pass back data
	$i = 0;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID'])){// if user is logged in
			$data['userLoggedIn'] = true;
			$userID = $_SESSION['userID'];
			
			$checkKPISQL = "SELECT * FROM kpi 
								 WHERE userid = :userid";
			$kpiPDO = $conn->prepare($checkKPISQL);
			$kpiPDO->bindParam(':userid', $userID, PDO::PARAM_INT);
			$kpiPDO->execute();
			
			if($kpiPDO->rowCount() > 0){
				$data['return'] = true;
				
				while($kpiResult = $kpiPDO->fetch(PDO::FETCH_ASSOC)){
					$data['result'][$i]['kpi'] = $kpiResult;
					$i++;
				}
			}
			else{
				$data['return'] = false;
			}
		}
		else{
			$data['userLoggedIn'] = false;
		}
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
?>