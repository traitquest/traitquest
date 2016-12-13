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
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "admin" ){// if user is admin
			if (isset($_POST['action']) && $_POST['action'] == 'deleteEntry') {
				$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
				if ($id > 0) {
					if($id != $_SESSION['userID']){
						$sql = "DELETE FROM employee WHERE id=".$id." LIMIT 1";
						$employeePDO = $conn->prepare($sql);
						$employeePDO->execute();
						echo 'employeeRemoved';
					}
					else{
						echo 'deletingYourself';
					}
					
				} else {
					echo 'err';
				}
				exit; // finish execution since we only need the "ok" or "err" answers from the server.
			}
		}
		else{
			echo 'err';
			exit;
		}
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>