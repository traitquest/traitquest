<?php
	include "../../../../traitquestserver/connection.php";

	session_start();
	$data = array();		// array to pass back data
	$kraCount = 0;
	$validated = true;
	$complete = true;
	try{	
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_SESSION['userID']) && isset($_SESSION['companyID']) && $_SESSION['logintype'] == "admin" ){// if user is admin
			$data['isAdmin'] = true;
			$companyID = $_SESSION['companyID'];
			
			if(isset($_POST['startMonth']))			{$startMonth = trim($_POST['startMonth']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['startYear']))			{$startYear = trim($_POST['startYear']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['endMonth']))			{$endMonth = trim($_POST['endMonth']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['endYear']))			{$endYear = trim($_POST['endYear']);}else{$validated = false;$data['fatalError'] = true;}
			if(isset($_POST['kra']))				{$kra = $_POST['kra'];$kraCount = count($_POST['kra']);}
			
			if($startMonth < 10){
				$startMonth = '0'.$startMonth;
			}
			if($endMonth < 10){
				$endMonth = '0'.$endMonth;
			}
			$start = date($startYear.'-'.$startMonth.'-01'); // hard-coded '01' for first day
			$end = date("Y-m-t", strtotime($start));
			//$end  = date($endYear.'-'.$endMonth.'-t');
			
			$currentYear = date('Y');
			$currentMonth = date('m');
			$startOfCurrentMonth = date($currentYear.'-'.$currentMonth.'-01');
			if($start > $end){
				$data['invalidStartEnd'] = true;
				$data['error'] = true;
				$complete = false;
			}
			if($startOfCurrentMonth >= $start ){
				$data['isPast'] = true;
				$data['error'] = true;
				$complete = false;
			}
			if($kraCount <= 0){
				$data['noKRASelected'] = true;
				$data['error'] = true;
				$complete = false;				
			}
			
			if($validated && $complete){
				$month = $startMonth;
				$year = $startYear;
				
				$ended = false;
				
				while($ended == false){
					$selectedStartDate = date($year.'-'.$month.'-01');
					$selectedEndDate = date("Y-m-t", strtotime($selectedStartDate));
					//$selectedEndDate = date($year.'-'.$month.'-t');
					if($selectedStartDate > $end){
						$ended = true;
					}
					else{
						foreach($_POST['kra'] as $selected) {
							$myArray = explode(',', $selected);
							$kraCategoryID = $myArray[0];
							$kraID = $myArray[1];
							$kraDescription = $myArray[2];
							if( checkKRAExists($conn, $companyID, $kraID, $selectedStartDate, $selectedEndDate) == 0 ){
								// only add the KRA into database when there is no existing data found in database
								// insert a new kra details
								$addKRASQL = "INSERT INTO `kra` (companyid, kracategorytemplateid, kratemplateid, description, startdate, enddate) 
																VALUES (:companyid, :kracategorytemplateid, :kratemplateid, :description, :startdate, :enddate)";
								$addKRAPDO = $conn->prepare($addKRASQL);
								$addKRAPDO->execute(array(
											':companyid'=> $companyID,
											':kracategorytemplateid'=> $kraCategoryID,
											':kratemplateid'=> $kraID,
											':description'=> $kraDescription,
											':startdate'=> $selectedStartDate,
											':enddate'=> $selectedEndDate
								));
							}
							
							$month++;
							if($month > 12){
								$month = 1;
								$year++;
							}
							
							if($month < 10){
								$month = '0'.$month;
							}
							
						}
					}
				}
				$data['success'] = true;
			}			
		}	
		else{
			$data['isAdmin'] = false;
		}		
		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	$conn = null;
	
	function checkKRAExists( $conn, $companyID, $kraTemplateID, $start, $end ){
		$checkSQL = "SELECT * FROM kra 
					 WHERE companyid = :companyid
					 AND kratemplateid = :kratemplateid
					 AND startdate >= '".$start."'
					 AND enddate <= '".$end."'
					 LIMIT 1";
		$checkPDO = $conn->prepare($checkSQL);
		$checkPDO->execute(array(
								':companyid'=> $companyID,
								':kratemplateid'=> $kraTemplateID
								));	
		return $checkPDO->rowCount(); 
	}
?>