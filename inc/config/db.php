<?php
	# NOTE: We want to make sure that each class loads the required modules like constants.php instead of main.
	# This makes sure that code is modular.
	require_once(__DIR__ . '/constants.php');

	# Wait for the database to become available
	$maxAttempts = DB_MAX_CONN_ATTEMPTS;
	$connAttempts = 0;

	// Connect to database
	echo "Connecting to database host: " . DB_HOSTNAME . "\n";

	while ($connAttempts < $maxAttempts) {
		try{
			$dsn = "mysql:host=" . DB_HOSTNAME . ";port=" . DB_PORT . ";dbname=" . DB_SCHEMA;
			$conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connected to database successfully\n";
			break;
		} catch(PDOException $e){
			echo "Database connection failed. Retrying in 5 seconds...\n";
			echo "ERROR: $e";
			sleep(5);
			$connAttempts++;
		}
	}

	if ($connAttempts >= $maxAttempts) {
		echo "Failed to connect to the database after multiple attempts. Exiting...\n";
		exit(1);
	}
?>