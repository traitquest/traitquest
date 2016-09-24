<?php
	include "../traitquestserver/connection.php";

	session_start();
	
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (!isset($_SESSION['companyID']) || !isset($_SESSION['userID'])){
			$companyid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
			$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
			$code = isset($_GET['code']) ? strval($_GET['code']) : 0;
			if($companyid>0 && $id>0 && $code != ''){
				$checkuserSQL = "SELECT * FROM employee
										WHERE companyid = :companyid
											AND id = :id
											AND password = :password
											LIMIT 1";
				$userPDO = $conn->prepare($checkuserSQL);
				$userPDO->bindParam(':companyid', $companyid, PDO::PARAM_INT);
				$userPDO->bindParam(':id', $id, PDO::PARAM_INT);
				$userPDO->bindParam(':password', $code, PDO::PARAM_STR);
				$userPDO->execute();
					
				if($userPDO->rowCount() != 0){
					$userResult = $userPDO->fetch(PDO::FETCH_ASSOC);
					$_SESSION['companyID'] = $userResult['companyid'];
					$_SESSION['userID'] = $userResult['id'];
					$_SESSION['name'] = $userResult['name'];
					$_SESSION['logintype'] = "employee";
					
					// redirect user to home page after successful verification
					header('location: home');
				}
				else{ // if the user is not found
					header('location: login');
				}
			}
			else{ // if the link is not correct, redirect user to login page
				header('location: login');
			}	
		}
		else{ // if user has already signed in
			header('location: home');
		}
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>