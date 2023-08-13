<?php
    require_once (__DIR__ . '/../../../inc/config/db.php');
    class ItemCountModel {
        private $conn;

        public function __construct() {
            global $conn;
            $this->conn = $conn;
        }

        public function getProductTypeCount() {
            $itemListQuery = "SELECT COUNT(*) as item_count FROM item where status = 'Active'";

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

        /**
         * Get the overall count of products sold.
         * @return int Number of items sold from start of purchase until latest.
         */
        public function getOverallProductSoldCount() {
            $query = "SELECT SUM(quantity) as item_sold_count FROM purchase";
            $sqlStatement = $this->conn->prepare($query);
            $sqlStatement->execute();

            $result = $sqlStatement->fetch(PDO::FETCH_ASSOC);
            if ($result !== false && isset($result['item_sold_count'])) {
                return $result['item_sold_count'];
            } else {
                return 0;
            }
        }

        /**
         * Get the current week's count of products sold.
         * @return int Number of items sold within this week.
         */
        public function getCurrentWeekProductSoldCount() {
            $query = "SELECT SUM(quantity) as weekly_sold_count FROM purchase WHERE YEARWEEK(purchaseDate) = YEARWEEK(NOW())";
            $sqlStatement = $this->conn->prepare($query);
            $sqlStatement->execute();

            $result = $sqlStatement->fetch(PDO::FETCH_ASSOC);
            if ($result !== false && isset($result['weekly_sold_count'])) {
                return $result['weekly_sold_count'];
            } else {
                return 0;
            }
        }
    }
?>