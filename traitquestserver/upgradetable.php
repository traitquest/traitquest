<?php
	// establish connection with datebase
	include "connection.php";
	try{
		//database connection
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// add phone column into Company table
		$sql = "ALTER TABLE `company`
						ADD `phone` VARCHAR(28),
						ADD `address` VARCHAR(128),
						ADD `poscode` INT,
						ADD `city` VARCHAR(128),
						ADD `country` VARCHAR(128)";
						
		// check if Company table has been updated
		if( $conn->exec($sql) !== false ){
			echo "Company table has been updated successfully";
		}
			
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>
