<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$i = 0;
	$j = 0;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// get kra category
		$checkKRASQL = "SELECT * FROM kratemplate";
		$checkKRAPDO = $conn->prepare($checkKRASQL);
		$checkKRAPDO->execute();
		
		while($kraTemplateResult = $checkKRAPDO->fetch(PDO::FETCH_ASSOC)){
			$data['kraTemplate'][$i] = $kraTemplateResult;
			$i++;
		}
		
		// get kpi category
		$checkKPISQL = "SELECT * FROM kpitemplate";
		$checkKPIPDO = $conn->prepare($checkKPISQL);
		$checkKPIPDO->execute();
		
		while($kpiTemplateResult = $checkKPIPDO->fetch(PDO::FETCH_ASSOC)){
			$data['kpiTemplate'][$j] = $kpiTemplateResult;
			$j++;
		}

		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>