<?php
	# Include the Composer autoloader
	# Using phpdotenv ensures that we can customize our application easily if deployed on any platform
	# like a server, container image or serverless platform.
	require_once realpath(__DIR__ . '/../../vendor/autoload.php');
	use Dotenv\Dotenv;

	try {
		$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
		$dotenv->load();
		echo "Environment variables loaded successfully.\n";
	} catch (Exception $e) {
		echo "Error loading environment variables: " . $e->getMessage() . "\n";
	}

	// Root url for the site
	define('ROOT_URL', $_ENV['ROOT_URL']);
	
	
	// Database parameters
	// Hostname
	define('DB_HOSTNAME', $_ENV['DB_HOSTNAME']);
	
	// DB user
	define('DB_USERNAME', $_ENV['DB_USERNAME']);
	
	// DB password
	define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
	
	// DB port
	define('DB_PORT', $_ENV['DB_PORT']);

	// DB name
	define('DB_SCHEMA', $_ENV['DB_SCHEMA']);

	// Max database re-connection tries before existing or timing out
	define('DB_MAX_CONN_ATTEMPTS', 10);
?>