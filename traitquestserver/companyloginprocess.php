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
		
		if (!isset($_SESSION['companyID']) && !isset($_SESSION['userID'])){// if company admin is logged out
			$data['companyLoggedIn'] = false;
			if (isset($_POST['name']))				                $name		= trim($_POST ['name']);
			if (isset($_POST['email']))			                    $email 		= trim($_POST ['email']);
			if (isset($_POST['password']))			                $password 	= $_POST ['password'];

			if(!trim($_POST ['name'])){//if company's name is filled up
				$data['name'] = "Enter your company name";
				$validated = false;
			}
			if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))){
				$data['email'] = "You have entered an invalid email address";
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
						// INPUT CODE HERE TO STORE USER DATA IN SESSION
						$_SESSION['companyID'] = $companyResult['id'];
						$_SESSION['name'] = $companyResult['name'];
						
						$data['login'] = true;
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