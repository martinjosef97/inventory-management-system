<?php
	# Import Monolog module
	require_once realpath(__DIR__ . '/../../../vendor/autoload.php');
    require_once realpath(__DIR__ . '/../../../inc/config/db.php');
	use Monolog\Level;
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;

    # Create a log channel
    $logger = new Logger("test");
    $logger->pushHandler(new StreamHandler("php://stdout"));

    $logger->info("Start the running of script " . __FILE__);
    try {
        
        $itemListQuery = 'SELECT COUNT(*) as itemCount FROM item';

        $itemListStatement = $conn->prepare($itemListQuery);
        $itemListStatement->execute();

        $result = $itemListStatement->fetch(PDO::FETCH_ASSOC);

        if ($result !== false && isset($result['item_count'])) {
            $itemCount = $result['item_count'];
            $response["success"] = true;
            $response["itemCount"] = $itemCount;
        } else {
            # If result is null or 0, return 0
            $response["success"] = true;
            $response["itemCount"] = 0;
        }
    } catch (Exception $e) {
        $errorCode = $e->getCode();
        $errorMessage = $e->getMessage();
        $stackTrace = $e->getTraceAsString();
        $logger->error("ERROR (Code: $errorCode): $errorMessage\n$stackTrace");
        echo "An error occurred. Please check the logs for more information.";
    }

    header("Content-Type: application/json");
    echo json_encode($response);
?>