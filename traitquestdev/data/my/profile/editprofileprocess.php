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
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "employee" ){// if employee is not logged in as admin
			$data['loggedIn'] = true;
			$userID = $_SESSION['userID'];
			
			if (isset($_POST['phone']))			                    $phone 		= trim($_POST ['phone']);
			if (isset($_POST['nationality']))			            $nationality 		= trim($_POST ['nationality']);
			if (isset($_POST['race']))			                    $race 		= trim($_POST ['race']);
			if (isset($_POST['religion']))			                $religion 		= trim($_POST ['religion']);
			if (isset($_POST['maritalStatus']))			            $maritalStatus 		= trim($_POST ['maritalStatus']);
			if (isset($_POST['bio']))			                    $bio 		= trim($_POST ['bio']);
			if (isset($_POST['address']))				            $address 	= trim($_POST ['address']);
			if (isset($_POST['address']))				            $address 	= trim($_POST ['address']);
			if (isset($_POST['emergencyContactName']))					$emergencyContactName 	= trim($_POST ['emergencyContactName']);
			if (isset($_POST['emergencyContactRelationship']))			$emergencyContactRelationship 	= trim($_POST ['emergencyContactRelationship']);
			if (isset($_POST['emergencyContactPhone']))					$emergencyContactPhone 	= trim($_POST ['emergencyContactPhone']);
			if (isset($_POST['emergencyContactAltPhone']))				$emergencyContactAltPhone 	= trim($_POST ['emergencyContactAltPhone']);
			
			if(isset($_POST['dobDay']))			{$day = trim($_POST['dobDay']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['dobMonth']))			{$month = trim($_POST['dobMonth']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['dobYear']))			{$year = trim($_POST['dobYear']);}else{$validated = false;$data['fatalError'] = true;}
			
			if($day < 10){
				$day = '0'.$day;
			}
			
			if($month < 10){
				$month = '0'.$month;
			}
			$dob = date($year.'-'.$month.'-'.$day);
			
			if($validated == true ){
				// check if there is match of company name and admin email
				$checkSQL = "SELECT * FROM employee 
								 WHERE id = :id
								 LIMIT 1";
				$employeePDO = $conn->prepare($checkSQL);
				$employeePDO->bindParam(':id', $userID, PDO::PARAM_INT);
				$employeePDO->execute();
				
				if($employeePDO->rowCount() != 0){
					$employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC);
					
					$updateSQL = "UPDATE employee
								  SET phone = :phone, dob = :dob, nationality = :nationality, race = :race, religion = :religion, maritalstatus = :maritalstatus, bio = :bio, address = :address, emergencycontactname = :emergencycontactname, emergencycontactrelationship = :emergencycontactrelationship, emergencycontactphone = :emergencycontactphone, emergencycontactaltphone = :emergencycontactaltphone
								  WHERE id = :id";
					$updateEmployeePDO = $conn->prepare($updateSQL);
					$updateEmployeePDO->execute(array(
												':id'=> $userID,
												':phone'=> $phone,
												':dob'=> $dob,
												':nationality'=> $nationality,
												':race'=> $race,
												':religion'=> $religion,
												':maritalstatus'=> $maritalStatus,
												':bio'=> $bio,
												':address'=> $address,
												':emergencycontactname'=> $emergencyContactName,
												':emergencycontactrelationship'=> $emergencyContactRelationship,
												':emergencycontactphone'=> $emergencyContactPhone,
												':emergencycontactaltphone'=> $emergencyContactAltPhone
												));		
					$data['editSuccess'] = true;
					
				}
				else{
					$data['error'] = "Some error has occured. Please try again later.";
					$data['editSuccess'] = false;
				}
			}
			else{
				$data['editSuccess'] = false;
			}
		}
		else{// if user is not logged in
			$data['loggedIn'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>