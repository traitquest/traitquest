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
				`fax` VARCHAR(32),
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
				`imagelink` VARCHAR(128) DEFAULT 'http://localhost/traitquest/traitquestdev/images/avatar.png',
				`registerdate` TIMESTAMP,
				`expirydate` TIMESTAMP,
				UNIQUE (`name`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Company created successfully<br>";
		}	
		
		// create Department table
		$sql = "CREATE TABLE IF NOT EXISTS `department` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
				`companyid` INT UNSIGNED NOT NULL,
				`name` VARCHAR(128) NOT NULL,
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				INDEX(`companyid`)
				)";

		// check if Department table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Department created successfully<br>";
		}
		
		// create Employee table
		$sql = "CREATE TABLE IF NOT EXISTS `employee` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
				`companyid` INT UNSIGNED NOT NULL,
				`departmentid` INT UNSIGNED NOT NULL,
				`name` VARCHAR(128) NOT NULL,
				`email` VARCHAR(128) NOT NULL,
				`password` VARCHAR(128) NOT NULL,
				`ext` VARCHAR(128),
				`code` VARCHAR(128),
				`phone` VARCHAR(32),
				`address` LONGTEXT,
				`dob` DATE,
				`nationality` VARCHAR(128),
				`race` VARCHAR(128),
				`religion` VARCHAR(128),
				`maritalstatus` VARCHAR(128),
				`bio` LONGTEXT,
				`emergencycontactname` VARCHAR(128),
				`emergencycontactrelationship` VARCHAR(128),
				`emergencycontactphone` VARCHAR(128),
				`emergencycontactaltphone` VARCHAR(128),
				`bank` VARCHAR(128),
				`epf` VARCHAR(128),	
				`socso` VARCHAR(128),				
				`hireddate` DATE,
				`imagelink` VARCHAR(128) DEFAULT 'http://localhost/traitquest/traitquestdev/images/avatar.png',
				`isadmin` BOOLEAN NOT NULL DEFAULT 0,
				`isresigned` BOOLEAN NOT NULL DEFAULT 0,
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				INDEX(`companyid`)
				)";

		// check if Employee table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Employee created successfully<br>";
		}
		
		// create Supervisor table
		$sql = "CREATE TABLE IF NOT EXISTS `supervisor` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
				`companyid` INT UNSIGNED NOT NULL,
				`superiorid` INT UNSIGNED NOT NULL,
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
		
		// create KRA Category Template table
		$sql = "CREATE TABLE IF NOT EXISTS `kracategorytemplate` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`title` LONGTEXT NOT NULL
				)";
		
		// check if KRA Category Template table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KRA Category Template created successfully<br>";
		}
		
		// create KRA Template table
		$sql = "CREATE TABLE IF NOT EXISTS `kratemplate` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`categoryid` INT NOT NULL,
				`title` LONGTEXT NOT NULL,
				`description` LONGTEXT,
				FOREIGN KEY (`categoryid`) REFERENCES kracategorytemplate(`id`)
				)";
		
		// check if KRA Template table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KRA Template created successfully<br>";
		}
		
		// create KPI Template table
		$sql = "CREATE TABLE IF NOT EXISTS `kpitemplate` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`kraid` INT UNSIGNED NOT NULL,
				`title` LONGTEXT NOT NULL,
				`description` LONGTEXT,
				FOREIGN KEY (`kraid`) REFERENCES kpitemplate(`id`)
				)";
		
		// check if KPI Template table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI Template created successfully<br>";
		}
		
		// create KRA table
		$sql = "CREATE TABLE IF NOT EXISTS `kra` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`companyid` INT UNSIGNED NOT NULL,
				`kracategorytemplateid` INT UNSIGNED NOT NULL,
				`kratemplateid` INT UNSIGNED NOT NULL,
				`description` LONGTEXT,
				`startdate` DATE,
				`enddate` DATE,
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				FOREIGN KEY (`kracategorytemplateid`) REFERENCES kracategorytemplate(`id`),
				FOREIGN KEY (`kratemplateid`) REFERENCES kratemplate(`id`),
				INDEX(`companyid`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KRA created successfully<br>";
		}
		
		// create KPI table
		$sql = "CREATE TABLE IF NOT EXISTS `kpi` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`employeeid` INT UNSIGNED NOT NULL,
				`companyid` INT UNSIGNED NOT NULL,
				`kratemplateid` INT UNSIGNED NOT NULL,
				`kpitemplateid` INT UNSIGNED NOT NULL,
				`description` LONGTEXT,
				`startdate` DATE,
				`enddate` DATE,
				`progress` INT NOT NULL DEFAULT 0,
				`issubmitted` BOOLEAN NOT NULL DEFAULT 0,
				`ischecked` BOOLEAN NOT NULL DEFAULT 0,				
				`isverified` BOOLEAN NOT NULL DEFAULT 0,
				`reviewdby` VARCHAR(128),
				`commentemployee` LONGTEXT,
				`commentsupervisor` LONGTEXT,
				FOREIGN KEY (`employeeid`) REFERENCES employee(`id`),
				FOREIGN KEY (`companyid`) REFERENCES company(`id`),
				FOREIGN KEY (`kratemplateid`) REFERENCES kratemplate(`id`),
				FOREIGN KEY (`kpitemplateid`) REFERENCES kpitemplate(`id`),
				INDEX(`employeeid`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI created successfully<br>";
		}
		
		// create KPI Log table
		$sql = "CREATE TABLE IF NOT EXISTS `kpilog` (
				`id` INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
				`kpiid` INT UNSIGNED NOT NULL,
				`remarks` LONGTEXT,
				`date` DATE,
				`progress` INT NOT NULL DEFAULT 0,
				FOREIGN KEY (`kpiid`) REFERENCES kpi(`id`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table KPI Log created successfully<br>";
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
