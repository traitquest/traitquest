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
			$companyID = $_SESSION['companyID'];
			$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
			
			$checkSQL = "SELECT * FROM kpi 
								 WHERE id = :id
								 LIMIT 1";
			$kpiPDO = $conn->prepare($checkSQL);
			$kpiPDO->bindParam(':id', $id, PDO::PARAM_INT);
			$kpiPDO->execute();
			
			if($kpiPDO->rowCount() > 0){
				$kpiResult = $kpiPDO->fetch(PDO::FETCH_ASSOC);
				
				//check if the KPI belongs to current user
				if( $userID == $kpiResult['userid'] && $companyID == $kpiResult['companyid'] ){
					$data['return'] = true;
					$data['kpi'] = $kpiResult;
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
			$data['userLoggedIn'] = false;
		}
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
?>