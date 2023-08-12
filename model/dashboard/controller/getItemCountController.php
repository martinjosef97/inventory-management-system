<?php
    require_once realpath(__DIR__ . '/../../../vendor/autoload.php');
    require_once (__DIR__ . '../model/getItemTypeCount.php');
    use Monolog\Level;
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;

    class GetItemCountController {
        private $logger;

        public function __construct() {
            $this->logger = new Logger(basename(__FILE__));
            $this->logger->pushHandler(new StreamHandler("php://stdout"));
        }

        public function getProductTypeCount() {
            try {
                $itemTypeCountModel = new ItemTypeCountModel();
                $productTypeCount = $itemTypeCountModel->getProductTypeCount();

                $response["success"] = true;
                $response["itemCount"] = $productTypeCount;
                $this->logger->info("Process successful.\n Response: " . json_encode($response));
            } catch (Exception $e) {
                $errorCode = $e->getCode();
                $errorMessage = $e->getMessage();
                $stackTrace = $e->getTraceAsString();
                $this->logger->error("ERROR (Code: $errorCode): $errorMessage\n$stackTrace");
                $response["success"] = false;
                $response["error"] = "An error occurred. Please check the logs for more information.";
            }
            echo json_encode($response);
        }
    }
?>