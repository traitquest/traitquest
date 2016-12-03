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
					$newPassword = randomPassword();// to replace hardcoded string with randomPassword() in release version
					
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
					
					//INPUT CODE HERE TO SEND EMAIL TO USER ON NEW PASSWORD
					$to = $email;

					$subject = 'TraitQuest Reset Password';

					$headers = "From: noreply@traitquest.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$message = '<html>
					<head>
					   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					   <title></title>
					   <style type="text/css">
						body, #main h1, #main h2, p {margin: 0; padding: 0;}
						a{cursor: pointer; color: #EB9532; font-size: 18px;}
							#main {border: 1px solid #cfcece;}
							img {display: block;}
							#top-message p, #bottom-message p {color: #3f4042; font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
							#main h1 {color: #555 !important; font-family: "Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", sans-serif; font-size: 24px; margin-bottom: 0!important; padding-bottom: 0; }
							#main h2 {color: #555 !important; font-family: Arial, Helvetica, sans-serif; font-size: 24px; margin-bottom: 0 !important; padding-bottom: 0; }
							#main p {color: #555 !important; font-family: "Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", sans-serif; font-size: 16px;  }
							h1, h2, h3, h4, h5, h6 {margin: 0 0 0.8em 0;}
							h3 {font-size: 28px; color: #444444 !important; font-family: Arial, Helvetica, sans-serif; }
							h4 {font-size: 22px; color: #4A72AF !important; font-family: Arial, Helvetica, sans-serif; }
							h5 {font-size: 18px; color: #444444 !important; font-family: Arial, Helvetica, sans-serif; }
							p {font-size: 12px; color: #444444 !important; font-family: "Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", sans-serif; line-height: 1.5;}
						</style>
					</head>
					<body>
					<table width="100%" cellpadding="0" cellspacing="0" bgcolor="F9F9F9"><tr><td>

						<table id="top-message" cellpadding="20" cellspacing="0" width="600" align="center">
							<tr>
								<td align="center">
									<a href="http://www.traitquest.com"><img src="http://www.traitquest.com/images/logo.png" style="width: 150px;"/></a>
								</td>
							</tr>
						</table><!-- top message -->
						<table id="main" width="600" align="center" cellpadding="0" cellspacing="15" bgcolor="ffffff">
							<tr>
								<td>
									<h1>TraitQuest Reset Password</h1>
								</td>
							</tr><!-- header -->
							<tr>
								<td>
									<p>Hi there,</p>
									<p>You have recently requested to reset your password.
									<p>Please use your new password to login to TraitQuest:<br/>
									   New password: '.$newPassword.'
									</p>
									<p>You are recommended to change this password once you are login.</p>
									<br/>
									<p>Best wishes, <br/>The TraitQuest Team</p>
								</td>
							</tr>

						</table>
						<table id="footer-message" cellpadding="5" cellspacing="0" width="600" align="center">
							<tr>
								<td align="center">
									<span>&copy; 2016 TraitQuest. All rights reserved.</span>
								</td>
							</tr>
						</table>
					</td></tr></table>
					</body>
					</html>';
					mail($to, $subject, $message, $headers);
					
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