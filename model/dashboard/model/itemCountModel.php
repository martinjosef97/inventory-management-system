<?php
    require_once (__DIR__ . '/../../../inc/config/db.php');
    class ItemCountModel {
        private $conn;

        public function __construct() {
            global $conn;
            $this->conn = $conn;
        }

        public function getProductTypeCount() {
            $itemListQuery = 'SELECT COUNT(*) as item_count FROM item';

            $itemListStatement = $this->conn->prepare($itemListQuery);
            $itemListStatement->execute();

            $result = $itemListStatement->fetch(PDO::FETCH_ASSOC);
            if ($result !== false && isset($result['item_count'])) {
                return $result['item_count'];
            } else {
                return 0;
            }
        }

        public function getProductStockCount() {
            $query = "SELECT SUM(stock) as item_stock_count FROM item where status = 'Active'";
            $sqlItemStockCountStatement = $this->conn->prepare($query);
            $sqlItemStockCountStatement->execute();

            $result = $sqlItemStockCountStatement->fetch(PDO::FETCH_ASSOC);
            if ($result !== false && isset($result['item_stock_count'])) {
                return $result['item_stock_count'];
            } else {
                return 0;
            }
        }
    }
?>