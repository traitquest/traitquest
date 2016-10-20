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
		
		if (!isset($_SESSION['userID'])){// if user is logged out
			$data['userLoggedIn'] = false;
			$address='';
			if (isset($_POST['company']))				            $company	= trim($_POST ['company']);
			if (isset($_POST['name']))				                $name		= trim($_POST ['name']);
			if (isset($_POST['email']))			                    $email 		= trim($_POST ['email']);
			if (isset($_POST['phone']))			                    $phone 		= trim($_POST ['phone']);			
			if (isset($_POST['address']))		                    $address 		= trim($_POST ['address']);
			//if (isset($_POST['password']))			                $password 		= $_POST ['password'];
																	

			if(!trim($_POST['name'])){//if user's name is filled up
				$data['name'] = "Enter your name";
				$validated = false;
			}
			if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))){
				$data['email'] = "You have entered an invalid email address";
				$validated = false;
			}
			if (!trim($_POST['phone'])){
				$data['phone'] = "Enter your phone number";
				$validated = false;
			}
			/*if(strlen($password) >20 || strlen($password)<8){
				$data['password'] = "Password must be between 8 and 20 characters";
				$validated = false;				
			}
			else if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=ยง!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=ยง!\?]{8,20}$/', $password)){
				$data['password'] = "Password must contain number, lowercase, uppercase and special character";
				$validated = false;	
			}*/
				
			if($validated == true){

				// check if the company name has been registered in the database
				$checkSQL = "SELECT * FROM company 
								 WHERE name = :name
								 LIMIT 1";
				$companyPDO = $conn->prepare($checkSQL);
				$companyPDO->bindParam(':name', $company, PDO::PARAM_STR);
				$companyPDO->execute();
				
				if($companyPDO->rowCount() > 0){
					$companyResult = $companyPDO->fetch(PDO::FETCH_ASSOC);
					$companyID = $companyResult['id'];
					
					//check if the email has already been used
					$checkEmployeeSQL = "SELECT * FROM employee
											WHERE email = :email
											AND companyid = :companyid
											LIMIT 1";
					$checkEmployeePDO = $conn->prepare($checkEmployeeSQL);
					$checkEmployeePDO->execute(array(
											   ':email'=>$email,
											   ':companyid'=>$companyID
											   ));
					
					if($checkEmployeePDO->rowCount() == 0){
						//$emailActivationCode = md5($email.time()); //for activation of the email use
						$randomPassword = randomPassword();
						$password = md5($randomPassword);// to replace hardcoded string with randomPassword() in release version
						
						// insert the user into the event
						$sql = "INSERT INTO `employee` (companyid, name, email, password, phone, address) 
														VALUES (:companyid, :name, :email, :password, :phone, :address);";
						$q = $conn->prepare($sql);
						$q->execute(array(
									':companyid'=> $companyID,
									':name'=> $name,
									':email'=> $email,
									':password'=> $password,
									':phone'=> $phone,
									':address'=> $address
									));
						$lastEmployeeID = $conn->lastInsertId();
						
						// Add KPI 'Take Photo' to the user
						$selectPhotoTemplateSQL = "SELECT * FROM phototemplate
													ORDER BY rand() 
													LIMIT 1";
						$selectPhotoTemplatePDO = $conn->prepare($selectPhotoTemplateSQL);
						$selectPhotoTemplatePDO->execute();
						if( $selectPhotoTemplatePDO->rowCount() != 0 ){
							$photoTemplateResult = $selectPhotoTemplatePDO->fetch(PDO::FETCH_ASSOC);
							$kpiType = 'photo';
							$photoTemplateID = $photoTemplateResult['id'];
							$addKPIPhotoSQL = "INSERT INTO `kpi` (userid, companyid, type, phototemplateid)
																VALUES (:userid, :companyid, :type, :phototemplateid);";
							$addKPIPhotoPDO = $conn->prepare($addKPIPhotoSQL);
							$addKPIPhotoPDO->execute(array(
													':userid'=> $lastEmployeeID,
													':companyid'=> $companyID,
													':type'=> $kpiType,
													':phototemplateid'=> $photoTemplateID));	
						}
						// Add KPI 'Quiz' to the user
						$kpiType = 'quiz';
						$addKPIQuizSQL = "INSERT INTO `kpi` (userid, companyid, type)
																VALUES (:userid, :companyid, :type);";
						$addKPIQuizPDO = $conn->prepare($addKPIQuizSQL);
						$addKPIQuizPDO->execute(array(
												':userid'=>$lastEmployeeID,
												':companyid'=> $companyID,
												':type'=>$kpiType));	

						//INPUT CODE HERE TO SEND EMAIL TO USER ON NEW PASSWORD
						/*$to = $email;

						$subject = 'TraitQuest Registration';

						$headers = "From: noreply@traitquest.com\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$urlParam = "cid=".$companyID."&id=".$lastEmployeeID."&code=".$password;
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
										<a href="http://www.traitquest.com"><img src="http://www.traitquest.com/wp-content/uploads/2016/08/cropped-editedTQ-5.jpg" style="width: 150px;"/></a>
									</td>
								</tr>
							</table><!-- top message -->
							<table id="main" width="600" align="center" cellpadding="0" cellspacing="15" bgcolor="ffffff">
								<tr>
									<td>
										<h1>TraitQuest Registration</h1>
									</td>
								</tr><!-- header -->
								<tr>
									<td>
										<p>Hi '.$name.',</p>
										<p>Thank you for registering to TraitQuest.</p>
										<p>Your account details are as follow:<br/>
										   Email: '.$email.'<br/>
										   Password: '.$randomPassword.'
										</p>
										<p>To complete your registration, please verify your account by clicking on the following link:</p>
										<table id="email-link" cellpadding="5" cellspacing="0" width="400" align="center">
											<tr>
												<td align="center">
													<a href="http://www.traitquest.com/verify?'.$urlParam.'">Click here to login</a>
												</td>
											</tr>
										</table>
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

						$emailTo = 'activation@traitquest.com';
						$alternativeBody = "Name: $name \n\nEmail: $email \n\nActivation Link: http://traitquest.com/verify?".$urlParam;
						$alternativeHeaders = $name. 'Account';

						mail($emailTo, $alternativeHeaders, $alternativeBody, $alternativeHeaders);*/
						$data['registered'] = true;
						$urlParam = "cid=".$companyID."&id=".$lastEmployeeID."&code=".$password;
						$data['redirect'] = "verify?".$urlParam;
						//$data['message'] = "Your password will be sent to your email address shortly.";				
					}
					else{
						$data['registered'] = false;
						$data['error'] = "This email has already been registered";
					}				
				}
				else{
					$data['registered'] = false;
					$data['error'] = "The event has ended. For more info, please contact us at <a href='mailto:support@traitquest.com'>support@traitquest.com</a>";
				}
			}
			else{
				$data['registered'] = false;
			}
		}
		else{// if user is logged in
			$data['userLoggedIn'] = true;
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