<?php
    require_once (__DIR__ . '/../../../inc/config/db.php');
    class VendorModel {
        private $conn;

        public function __construct() {
            global $conn;
            $this->conn = $conn;
        }

        public function getActiveVendorCount() {
            $query = "SELECT COUNT(*) as vendor_count FROM vendor where status = 'Active';";
            $sqlActiveVendorCountStatement = $this->conn->prepare($query);
            $sqlActiveVendorCountStatement->execute();

            $result = $sqlItemStockCountStatement->fetch(PDO::FETCH_ASSOC);
            if ($result !== false && isset($result['vendor_count'])) {
                return $result['vendor_count'];
            } else {
                return 0;
            }
        }
    }
?>