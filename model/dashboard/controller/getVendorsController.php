<?php
    require_once realpath(__DIR__ . '/../../../vendor/autoload.php');
    require_once realpath(__DIR__ . '/../model/vendorsModel.php');
    use Monolog\Level;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    class GetVendorsController {
        private $logger;

        public function __construct() {
            $this->logger = new Logger(basename(__FILE__));
            $this->logger->pushHandler(new StreamHandler("php://stdout"));
        }

        public function getActiveVendorCount() {
            try {
                $model = new VendorModel();
                $activeVendorCount = $model->getActiveVendorCount();

                $response["success"] = true;
                $response["activeVendors"] = $activeVendorCount;
                $this->logger->info("Process successful.\n Response: " . json_encode($response));
            } catch (Exception $e) {
                $errorCode = $e->getCode();
                $errorMessage = $e->getMessage();
                $stackTrace = $e->getTraceAsString();
                $this->logger->error("ERROR (Code: $errorCode): $errorMessage\n$stackTrace");
                $response["success"] = false;
                $response["error"] = "An error occurred. Please check the logs for more information.";
            }
            return json_encode($response);
        }
    }
?>