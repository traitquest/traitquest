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
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
