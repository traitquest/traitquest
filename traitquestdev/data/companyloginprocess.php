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
			$data['companyLoggedIn'] = false;
			if (isset($_POST['name']))				                $name		= trim($_POST ['name']);
			if (isset($_POST['email']))			                    $email 		= trim($_POST ['email']);
			if (isset($_POST['password']))			                $password 	= $_POST ['password'];

			if(!trim($_POST ['name'])){//if company's name is filled up
				$data['name'] = "Enter your company name";
				$validated = false;
			}
			if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))){
				$data['email'] = "Enter a valid email address";
				$validated = false;
			}

			if($validated == true){

				// check if there is match of company name and admin email
				$checkSQL = "SELECT * FROM company 
								 WHERE name = :name
									   AND email = :email";
				$companyPDO = $conn->prepare($checkSQL);
				$companyPDO->bindParam(':name', $name, PDO::PARAM_STR);
				$companyPDO->bindParam(':email', $email, PDO::PARAM_STR);
				$companyPDO->execute();
				
				if($companyPDO->rowCount() != 0){
					$companyResult = $companyPDO->fetch(PDO::FETCH_ASSOC);
					
					// check if the password is correct
					if(md5($password) == $companyResult['password']){
						// check if the company license still valid
						$today = date ('Y-m-d');
						if( strtotime($today) <= strtotime($companyResult['expirydate']) ){
							// retrieve the user id from employee table
							$checkuserSQL = "SELECT * FROM employee
												WHERE email = :email
													AND companyid = :companyid";
							$userPDO = $conn->prepare($checkuserSQL);
							$userPDO->bindParam(':email', $email, PDO::PARAM_STR);
							$userPDO->bindParam(':companyid', $companyResult['id'], PDO::PARAM_INT);
							$userPDO->execute();
							
							if($userPDO->rowCount() != 0){
								$userResult = $userPDO->fetch(PDO::FETCH_ASSOC);
								
								// INPUT CODE HERE TO STORE USER DATA IN SESSION
								$_SESSION['companyID'] = $companyResult['id'];
								$_SESSION['userID'] = $userResult['id'];
								$_SESSION['profilePic'] = $userResult['imagelink'];
								$_SESSION['name'] = $companyResult['name'];
								$_SESSION['logintype'] = "admin";
								
								$data['login'] = true;							
							}
							else{
								$data['error'] = "Some error has occured. Please try again.";
								$data['login'] = false;	
							}
						}
						else{
							$data['error'] = "Your license has expired. Contact <a href='mailto:hello@traitquest.com'>TraitQuest</a> to extend your license.";
							$data['login'] = false;
						}						
					}
					else{
						$data['error'] = "Wrong password";
						$data['login'] = false;
					}
				}
				else{
					$data['error'] = "Invalid company name and email";
					$data['login'] = false;
				}
			}
			else{
				$data['login'] = false;
			}
		}
		else{// if user is logged in
			$data['companyLoggedIn'] = true;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>