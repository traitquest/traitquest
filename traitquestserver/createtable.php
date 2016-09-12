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
				`email` VARCHAR(127) NOT NULL,
				`password` VARCHAR(128) NOT NULL,
				`registerdate` TIMESTAMP,
				`expirydate` TIMESTAMP,
				`maxsize` INT,
				UNIQUE (`name`, `email`)
				)";

		// check if Company table has been created
		if( $conn->exec($sql) !== false ){
			echo "Table Company created successfully";
		}	
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
