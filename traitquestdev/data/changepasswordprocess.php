<?php
	include "../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['userID'])){// if employee is logged in				
			$data['loggedIn'] = true;
			if (isset($_POST['oldPassword']))				                $oldPassword		= $_POST ['oldPassword'];
			if (isset($_POST['newPassword']))			                    $newPassword 		= $_POST ['newPassword'];
			if (isset($_POST['retypePassword']))			                $retypePassword 	= $_POST ['retypePassword'];

			if(strlen($newPassword) >20 || strlen($newPassword)<8){
				$data['error'] = "Password must be between 8 and 20 characters";
				$validated = false;				
			}
			else if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/', $newPassword)){
				$data['error'] = "Password must contain number, lowercase, uppercase and special character";
				$validated = false;	
			}
			else{
				if($newPassword != $retypePassword){
					$data['error'] = "Password do not match";
					$validated = false;
				}
			}

			if($validated == true){
				$userID = $_SESSION['userID'];
				$changePassword = md5($newPassword);
				
				// check if there is match of company name and admin email
				$checkSQL = "SELECT * FROM employee 
								 WHERE id = :id";
				$userPDO = $conn->prepare($checkSQL);
				$userPDO->bindParam(':id', $userID, PDO::PARAM_STR);
				$userPDO->execute();
				
				if($userPDO->rowCount() != 0){
					$userResult = $userPDO->fetch(PDO::FETCH_ASSOC);
					$companyID = $userResult['companyid'];
					
					if(md5($oldPassword) == $userResult['password']){
						// check if the user is admin
						if($userResult['isadmin']){
							$updateAdminSQL = "UPDATE company	
												SET password = :password
												WHERE id = :id";
							$updateAdminPDO = $conn->prepare($updateAdminSQL);
							$updateAdminPDO->bindParam(':password', $changePassword, PDO::PARAM_STR); 
							$updateAdminPDO->bindParam(':id', $companyID, PDO::PARAM_STR);
							$updateAdminPDO->execute();
						}
						
						$updateUserSQL = "UPDATE employee	
												SET password = :password
												WHERE id = :id";
						$updateUserPDO = $conn->prepare($updateUserSQL);
						$updateUserPDO->bindParam(':password', $changePassword, PDO::PARAM_STR); 
						$updateUserPDO->bindParam(':id', $userID, PDO::PARAM_STR);
						$updateUserPDO->execute();
						
						$data['success'] = "Password changed";
						$data['passwordChanged'] = true;
					}
					else{
						$data['error'] = "Wrong old password";
						$data['passwordChanged'] = false;
					}
				}
				else{
					$data['error'] = "Some error has occured. Please try again later.";
					$data['passwordChanged'] = false;
				}
			}
			else{
				$data['passwordChanged'] = false;
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