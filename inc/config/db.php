<?php
	# NOTE: We want to make sure that each class loads the required modules like constants.php instead of main.
	# This makes sure that code is modular.
	require_once(__DIR__ . '/constants.php');
	// Connect to database
	echo "Connecting to database host: " . DB_HOSTNAME . "\n";
	try{
		$dsn = "mysql:host=" . DB_HOSTNAME . ";port=" . DB_PORT . ";dbname=" . DB_SCHEMA;
		$conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo "$e";
		exit();
	}
?>