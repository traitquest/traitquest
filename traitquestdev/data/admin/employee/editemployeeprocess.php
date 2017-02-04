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
		
		if (isset($_SESSION['companyID']) && isset($_SESSION['userID']) && $_SESSION['logintype'] == "admin" ){// if employee is logged in as admin
			$data['adminloggedIn'] = true;
			$companyID = $_SESSION['companyID'];
			$employeeID = isset($_POST['employeeID']) ? intval($_POST['employeeID']) : 0;
			if (isset($_POST['employeeName']))			    $name 		= trim($_POST ['employeeName']);
			if (isset($_POST['employeeCode']))			    $code 		= trim($_POST ['employeeCode']);
			if (isset($_POST['employeeDepartment']))		$departmentID = isset($_POST['employeeDepartment']) ? intval($_POST['employeeDepartment']) : 0;
			if (isset($_POST['employeeExt']))				$ext 		= trim($_POST ['employeeExt']);
			if (isset($_POST['employeeAddress']))			$address 		= trim($_POST ['employeeAddress']);
			if (isset($_POST['employeeBank']))			    $bank 		= trim($_POST ['employeeBank']);
			if (isset($_POST['employeeEpf']))			    $epf 		= trim($_POST ['employeeEpf']);
			if (isset($_POST['employeeSocso']))			    $socso 		= trim($_POST ['employeeSocso']);
			if(isset($_POST['employeeHiredDay']))			{$day = trim($_POST['employeeHiredDay']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['employeeHiredMonth']))			{$month = trim($_POST['employeeHiredMonth']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['employeeHiredYear']))			{$year = trim($_POST['employeeHiredYear']);}else{$validated = false;$data['fatalError'] = true;}
			
			if($day < 10){
				$day = '0'.$day;
			}
			
			if($month < 10){
				$month = '0'.$month;
			}
			$hireddate = date($year.'-'.$month.'-'.$day);
			
			if(!trim($_POST ['employeeName'])){//if employee's name is filled up
				$data['error'] = "Employee name should not be left empty";
				$validated = false;
			}
			else if($departmentID == 0){
				$data['error'] = "You have not selected a department";
				$validated = false;
			}
			
			if($validated == true && $employeeID != 0){
				// check if there is match of company name and admin email
				$checkSQL = "SELECT * FROM employee 
								 WHERE id = :id
									   AND companyid = :companyid
								 LIMIT 1";
				$employeePDO = $conn->prepare($checkSQL);
				$employeePDO->bindParam(':id', $employeeID, PDO::PARAM_INT);
				$employeePDO->bindParam(':companyid', $companyID, PDO::PARAM_INT);
				$employeePDO->execute();
				
				if($employeePDO->rowCount() != 0){
					$employeeResult = $employeePDO->fetch(PDO::FETCH_ASSOC);
					
					$updateSQL = "UPDATE employee
								  SET name = :name, code = :code, ext = :ext, departmentid = :departmentid, address = :address, bank = :bank, epf = :epf, socso = :socso, hireddate = :hireddate
								  WHERE id = :id";
					$updateEmployeePDO = $conn->prepare($updateSQL);
					$updateEmployeePDO->execute(array(
												':id'=> $employeeID,
												':name'=> $name,
												':code'=> $code,
												':departmentid'=> $departmentID,
												':ext'=> $ext,
												':address'=> $address,
												':bank'=> $bank,
												':epf'=> $epf,
												':socso'=> $socso,
												':hireddate'=> $hireddate
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
			$data['adminloggedIn'] = false;
		}
		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
?>