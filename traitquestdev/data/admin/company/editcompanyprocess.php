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
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "admin" ){// if employee is not logged in as admin
			$data['adminLoggedIn'] = true;
			$companyid = $_SESSION['companyID'];
			
			if (isset($_POST['address']))				            {$address 	= trim($_POST ['address']);} else { $address='';}
			if (isset($_POST['phone']))			                    $phone 		= trim($_POST ['phone']);
			if (isset($_POST['fax']))			                    $fax 		= trim($_POST ['fax']);
			if (isset($_POST['website']))			                $website 	= trim($_POST ['website']);
			if (isset($_POST['description']))				        {$description 	= trim($_POST ['description']);} else { $description='';}
			if (isset($_POST['vision']))				            {$vision 	= trim($_POST ['vision']);} else { $vision='';}
			if (isset($_POST['mission']))				            {$mission 	= trim($_POST ['mission']);} else { $mission='';}
			
			// check if there is match of company name and admin email
			$checkSQL = "SELECT * FROM company 
							 WHERE id = :id
							 LIMIT 1";
			$companyPDO = $conn->prepare($checkSQL);
			$companyPDO->bindParam(':id', $companyid, PDO::PARAM_INT);
			$companyPDO->execute();
			
			if($companyPDO->rowCount() != 0){
				$companyResult = $companyPDO->fetch(PDO::FETCH_ASSOC);
				
				$updateSQL = "UPDATE company
                              SET address= :address, phone= :phone, fax= :fax, website= :website, description= :description, vision= :vision, mission= :mission
                              WHERE id = :id";
				$updateCompanyPDO = $conn->prepare($updateSQL);
				$updateCompanyPDO->execute(array(
											':id'=> $companyid,
											':address'=> $address,
											':phone'=> $phone,
											':fax'=> $fax,
											':website'=> $website,
											':description'=> $description,
											':vision'=> $vision,
											':mission'=> $mission
											));		
				$data['editSuccess'] = true;
				
			}
			else{
				$data['error'] = "Some error has occured. Please try again later.";
				$data['editSuccess'] = false;
			}
			
		}
		else{// if user is logged in
			$data['adminLoggedIn'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>