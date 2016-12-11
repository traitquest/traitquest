<?php
	// establish connection with datebase
	include "connection.php";
	try{
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// create Company table
		$sql = "CREATE TABLE IF NOT EXISTS `company` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`name` VARCHAR(128) NOT NULL,
				`email` VARCHAR(128) NOT NULL,
				`password` VARCHAR(128) NOT NULL,
				`phone` VARCHAR(32),
				`address` VARCHAR(128),
				`poscode` INT,
				`city` VARCHAR(128),
				`country` VARCHAR(128),
				`website` VARCHAR(128),
				`contactperson` VARCHAR(128),
				`description` LONGTEXT,
				`vision` LONGTEXT,
				`mission` LONGTEXT,
				`maxsize` INT,
				`activationcode` VARCHAR(128),
				`isactivated` BOOLEAN NOT NULL DEFAULT 0,
				`registerdate` TIMESTAMP,
				`expirydate` TIMESTAMP,
				UNIQUE (`name`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Company created successfully<br>";
		}	
		
		// create Employee table
		$sql = "CREATE TABLE IF NOT EXISTS `employee` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
				`companyid` INT UNSIGNED NOT NULL,
				`name` VARCHAR(128) NOT NULL,
				`email` VARCHAR(128) NOT NULL,
				`password` VARCHAR(128) NOT NULL,
				`code` VARCHAR(128) DEFAULT 0,
				`phone` VARCHAR(32),
				`address` VARCHAR(128),
				`poscode` INT,
				`city` VARCHAR(128),
				`country` VARCHAR(128),
				`imagelink` VARCHAR(128),
				`isadmin` BOOLEAN NOT NULL DEFAULT 0,
				`isresigned` BOOLEAN NOT NULL DEFAULT 0,	
				`hireddate` TIMESTAMP,
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				INDEX(`companyid`)
				)";

		// check if Employee table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Employee created successfully<br>";
		}
		
		// create Supervisor table
		$sql = "CREATE TABLE IF NOT EXISTS `supervisor` (
				`companyid` INT UNSIGNED NOT NULL,
				`superiorid` INT UNSIGNED NOT NULL PRIMARY KEY,
				`subordinateid` INT UNSIGNED NOT NULL,
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				FOREIGN KEY (`superiorid`) REFERENCES employee(`id`),
				FOREIGN KEY (`subordinateid`) REFERENCES employee(`id`),
				INDEX(`companyid`)
				)";
		
		// check if Employee table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Supervisor created successfully<br>";
		}
		
		// create KPI Category table
		$sql = "CREATE TABLE IF NOT EXISTS `kpicategory` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`title` LONGTEXT NOT NULL,
				)";
		
		// check if KPI Category table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI Category created successfully<br>";
		}
		
		// create KPI table
		$sql = "CREATE TABLE IF NOT EXISTS `kpi` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`employeeid` INT UNSIGNED NOT NULL,
				`companyid` INT UNSIGNED NOT NULL,
				`kpicategoryid` INT UNSIGNED NOT NULL,
				`description` LONGTEXT,
				`startdate` TIMESTAMP,
				`enddate` TIMESTAMP,
				`progress` INT NOT NULL DEFAULT 0,
				`issubmitted` BOOLEAN NOT NULL DEFAULT 0,
				`ischecked` BOOLEAN NOT NULL DEFAULT 0,				
				`isverified` BOOLEAN NOT NULL DEFAULT 0,
				`reviewdby` VARCHAR(128),
				FOREIGN KEY (`employeeid`) REFERENCES employee(`id`),
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				FOREIGN KEY (`kpicategoryid`) REFERENCES kpicategory(`id`),
				INDEX(`employeeid`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI created successfully<br>";
		}
		
		// create KPI Record table
		$sql = "CREATE TABLE IF NOT EXISTS `kpirecord` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`kpiid` INT UNSIGNED NOT NULL,
				`employeeid` INT UNSIGNED NOT NULL,
				`companyid` INT UNSIGNED NOT NULL,
				`date` TIMESTAMP,
				`progress` INT NOT NULL DEFAULT 0,
				FOREIGN KEY (`kpiid`) REFERENCES kpi(`id`),
				FOREIGN KEY (`employeeid`) REFERENCES employee(`id`),
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				INDEX(`employeeid`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI Record created successfully<br>";
		}
		
		// create KPI table
		/*$sql = "CREATE TABLE IF NOT EXISTS `kpi` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`userid` INT UNSIGNED NOT NULL,
				`companyid` INT UNSIGNED NOT NULL,
				`type` VARCHAR(128) NOT NULL,
				`phototemplateid` INT,
				`iscompleted` BOOLEAN NOT NULL DEFAULT 0,
				FOREIGN KEY (`userid`) REFERENCES employee(`id`),
				INDEX(`userid`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI created successfully<br>";
		}	
		
		// create photo template table
		$sql = "CREATE TABLE IF NOT EXISTS `phototemplate` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`link1` TEXT NOT NULL,
				`link2` TEXT NOT NULL,
				`link3` TEXT NOT NULL,
				`link4` TEXT NOT NULL,
				`link5` TEXT NOT NULL,
				`link6` TEXT NOT NULL
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Photo Template created successfully<br>";
		}*/
		
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
