<?php
	include "connection.php";

	session_start();
	$data = array();		// array to pass back data
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		
		$checkSQL = "SELECT * FROM phototemplate 
							 WHERE id = :id
							 LIMIT 1";
		$kpiPhotoPDO = $conn->prepare($checkSQL);
		$kpiPhotoPDO->bindParam(':id', $id, PDO::PARAM_INT);
		$kpiPhotoPDO->execute();
		
		if($kpiPhotoPDO->rowCount() > 0){
			$kpiPhotoResult = $kpiPhotoPDO->fetch(PDO::FETCH_ASSOC);
			$data['return'] = true;
			$data['result'] = $kpiPhotoResult;
		}
		else{
			$data['return'] = false;
		}

		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
?>