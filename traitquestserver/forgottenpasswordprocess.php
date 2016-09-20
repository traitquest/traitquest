<?php
	include "connection.php";

	session_start();
	$data = array();		// array to pass back data
	$validated = true;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (!isset($_SESSION['companyID']) && !isset($_SESSION['userID'])){// if employee is not logged in
			$data['loggedIn'] = false;
			if (isset($_POST['email']))			                    $email 		= trim($_POST ['email']);

			if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))){
				$data['error'] = "You have entered an invalid email address";
				$validated = false;
			}

			if($validated == true){

				// check if there is match of company name and admin email
				$checkSQL = "SELECT * FROM employee 
								 WHERE email = :email";
				$userPDO = $conn->prepare($checkSQL);
				$userPDO->bindParam(':email', $email, PDO::PARAM_STR);
				$userPDO->execute();
				
				if($userPDO->rowCount() != 0){
					$userResult = $userPDO->fetch(PDO::FETCH_ASSOC);
					$newPassword = md5('password');// to replace hardcoded string with randomPassword() in release version
					
					// check if the user is admin
					if($userResult['isadmin']){
						$updateAdminSQL = "UPDATE company	
											SET password = :password
											WHERE email = :email";
						$updateAdminPDO = $conn->prepare($updateAdminSQL);
						$updateAdminPDO->bindParam(':password', $newPassword, PDO::PARAM_STR); 
						$updateAdminPDO->bindParam(':email', $email, PDO::PARAM_STR);
						$updateAdminPDO->execute();
					}
					$updateUserSQL = "UPDATE employee	
											SET password = :password
											WHERE email = :email";
					$updateUserPDO = $conn->prepare($updateUserSQL);
					$updateUserPDO->bindParam(':password', $newPassword, PDO::PARAM_STR); 
					$updateUserPDO->bindParam(':email', $email, PDO::PARAM_STR);
					$updateUserPDO->execute();
					
					$data['success'] = "Your password has been reset. Please check your email.";
					$data['passwordReset'] = true;					
				}
				else{
					$data['error'] = "Your email is not registered with us";
					$data['passwordReset'] = false;
				}
			}
			else{
				$data['passwordReset'] = false;
			}
		}
		else{// if user is logged in
			$data['loggedIn'] = true;
		}
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
	// randomly generated password
	function randomPassword() {
		$lowercase = "abcdefghijklmnopqrstuwxyz";
		$uppercase = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
		$number = "0123456789";
		$specialcharacter = "!@#$%^&_-+=";
		$pass = array(); //remember to declare $pass as an array
		$lowercaseLength = strlen($lowercase) - 1; //put the length -1 in cache
		$uppercaseLength = strlen($uppercase) - 1; //put the length -1 in cache
		$numberLength = strlen($number) - 1; //put the length -1 in cache
		$specialcharacterLength = strlen($specialcharacter) - 1; //put the length -1 in cache
		// lowercase for first two characters
		for ($i = 0; $i < 2; $i++) {
			$n = rand(0, $lowercaseLength);
			$pass[] = $lowercase[$n];
		}
		// uppercase for third character
		for ($i = 0; $i < 1; $i++) {
			$n = rand(0, $uppercaseLength);
			$pass[] = $uppercase[$n];
		}
		// number for forth and fifth character
		for ($i = 0; $i < 2; $i++) {
			$n = rand(0, $numberLength);
			$pass[] = $number[$n];
		}
		// special character for sixth character
		for ($i = 0; $i < 1; $i++) {
			$n = rand(0, $specialcharacterLength);
			$pass[] = $specialcharacter[$n];
		}
		// uppercase for seventh and eighth character
		for ($i = 0; $i < 2; $i++) {
			$n = rand(0, $uppercaseLength);
			$pass[] = $uppercase[$n];
		}
		return implode($pass); //turn the array into a string
	}

?>