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

		$checkSQL = "SELECT * FROM kracategorytemplate ORDER BY id ASC";
		$kraCategoryPDO = $conn->prepare($checkSQL);
		$kraCategoryPDO->execute();
		
		if($kraCategoryPDO->rowCount() > 0){			
			while($kraCategoryResult = $kraCategoryPDO->fetch(PDO::FETCH_ASSOC)){
				$j = 0;
				$kraCategoryID = $kraCategoryResult['id'];
				$checkKRASQL = "SELECT * FROM kratemplate 
									WHERE categoryid = :id";
				$kraPDO = $conn->prepare($checkKRASQL);
				$kraPDO->bindParam(':id', $kraCategoryID, PDO::PARAM_INT);
				$kraPDO->execute();
		
				if($kraPDO->rowCount() > 0){
					while($kraResult = $kraPDO->fetch(PDO::FETCH_ASSOC)){
						$data['kraCategory'][$i]['kra'][$j] = $kraResult;
						$j++;
					}
					$data['return'] = true;
					$data['kraCategory'][$i]['category'] = $kraCategoryResult;
					$i++;
				}
			}
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