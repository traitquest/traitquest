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
			if(isset($_POST['month']))			{$month = trim($_POST['month']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['year']))			{$year = trim($_POST['year']);}else{$validated = false;$data['fatalError'] = true;}
			
			if($validated){
				
				if($month < 10){
					$month = '0'.$month;
				}
				$start = date($year.'-'.$month.'-01'); // hard-coded '01' for first day
				$end = date("Y-m-t", strtotime($start));
				
				$checkSQL = "SELECT * FROM kra 
									 WHERE companyid = :companyid
										   AND startdate >= '".$start."'
										   AND enddate <= '".$end."'";
				$kraPDO = $conn->prepare($checkSQL);
				$kraPDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
				$kraPDO->execute();
				
				if($kraPDO->rowCount() > 0){
					$data['return'] = true;
					
					while($kraResult = $kraPDO->fetch(PDO::FETCH_ASSOC)){
						$data['kra'][$i]['data'] = $kraResult;
						
						$kraID = $data['kra'][$i]['data']['kratemplateid'];
						$kraTemplateSQL = "SELECT * FROM kratemplate 
									 WHERE id = :kraid";
						$kraTemplatePDO = $conn->prepare($kraTemplateSQL);
						$kraTemplatePDO->execute(array(
												':kraid'=> $kraID
												));
						if($kraTemplatePDO->rowCount() > 0){
							$kraTemplateResult = $kraTemplatePDO->fetch(PDO::FETCH_ASSOC);
							$data['kra'][$i]['template'] = $kraTemplateResult;
						}
						
						$i++;
					}
				}
				else{
					$data['return'] = false;
				}
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