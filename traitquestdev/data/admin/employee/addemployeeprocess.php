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
			$data['isAdmin'] = true;
			$companyID = $_SESSION['companyID'];
			
			if (isset($_POST['departmentID']))				        $departmentID = isset($_POST['departmentID']) ? intval($_POST['departmentID']) : 0;
			if (isset($_POST['name']))				                $name		= trim($_POST ['name']);
			if (isset($_POST['email']))			                    $email 		= trim($_POST ['email']);

			if(!trim($_POST ['name'])){//if employee's name is filled up
				$data['error'] = "Employee name should not be left empty";
				$validated = false;
			}
			else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))){
				$data['error'] = "You have entered an invalid email address";
				$validated = false;
			}
			else if($departmentID == 0){
				$data['error'] = "You have not selected a department";
				$validated = false;
			}

			if($validated == true){
				// check if the max size of the company is exceeded
				$checkSizeSQL = "SELECT * FROM employee
									WHERE companyid = :companyid";
				$checkSizePDO = $conn->prepare($checkSizeSQL);
				$checkSizePDO->bindParam(':companyid', $companyID, PDO::PARAM_STR);
				$checkSizePDO->execute();
				
				// check if the max size of the company is exceeded
				$checkCompanySizeSQL = "SELECT * FROM company
											WHERE id = :companyid";
				$checkCompanySizePDO = $conn->prepare($checkCompanySizeSQL);
				$checkCompanySizePDO->bindParam(':companyid', $companyID, PDO::PARAM_STR);
				$checkCompanySizePDO->execute();
				$companyResult = $checkCompanySizePDO->fetch(PDO::FETCH_ASSOC);
				
				if( $checkCompanySizePDO->rowCount() > 0 and $checkSizePDO->rowCount() < $companyResult['maxsize']){
					// check if there is match of company name and admin email
					$checkSQL = "SELECT * FROM employee 
									 WHERE email = :email
									 AND companyid = :companyid";
					$employeePDO = $conn->prepare($checkSQL);
					$employeePDO->bindParam(':email', $email, PDO::PARAM_STR);
					$employeePDO->bindParam(':companyid', $companyID, PDO::PARAM_STR);
					$employeePDO->execute();
					
					// no redundant email
					if($employeePDO->rowCount() == 0){
						$password = md5('password');// to replace hardcoded string with randomPassword() in release version
						
						// insert a new company details and at the same time create an employee account
						$addEmployeeSQL = "INSERT INTO `employee` (companyid, departmentid, name, email, password) 
														VALUES (:companyid, :departmentid, :name, :email, :password)";
						$addEmployeePDO = $conn->prepare($addEmployeeSQL);
						$addEmployeePDO->execute(array(
									':companyid'=> $companyID,
									':departmentid'=> $departmentID,
									':name'=> $name,
									':email'=> $email,
									':password'=> $password
						));
						
						$lastEmployeeID = $conn->lastInsertId();
						$lastEmployeeSQL = "SELECT * FROM employee
												WHERE id = :id";
						$lastEmployeePDO = $conn->prepare($lastEmployeeSQL);
						$lastEmployeePDO->bindParam(':id', $lastEmployeeID, PDO::PARAM_STR);
						$lastEmployeePDO->execute();
						
						$employeeResult = $lastEmployeePDO->fetch(PDO::FETCH_ASSOC);
						$data['employee'] = $employeeResult;
						
						$data['employeeAdded'] = true;
					}
					else{
						$data['error'] = "Email: ".htmlspecialchars($email)." has already been added.";
						$data['employeeAdded'] = false;
					}
				}
				else{
					$data['error'] = "You have exceeded your package limit. Contact TraitQuest for upgrade.";
					$data['employeeAdded'] = false;
				}
			}
			else{
				$data['employeeAdded'] = false;
			}
		}
		else{// if user is logged in
			$data['isAdmin'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>