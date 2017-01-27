<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$i = 0;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$kpiID = isset($_POST['kpiID']) ? intval($_POST['kpiID']) : 0;
		
		$checkKPISQL = "SELECT * FROM kpilog 
						 WHERE kpiid = :kpiid
						 ORDER BY date DESC";
		$kpiPDO = $conn->prepare($checkKPISQL);
		$kpiPDO->bindParam(':kpiid', $kpiID, PDO::PARAM_INT);
		$kpiPDO->execute();
							
		if($kpiPDO->rowCount() > 0){						
			while($kpiLogResult = $kpiPDO->fetch(PDO::FETCH_ASSOC)){
				$data['kpilog'][$i] = $kpiLogResult;							
				$i++;
			}
			$data['return'] = true;
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