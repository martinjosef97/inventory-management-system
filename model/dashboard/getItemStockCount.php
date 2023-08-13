<?php
    require_once (__DIR__ . '/controller/getItemCountController.php');
    $controller = new GetItemCountController();
    $response = $controller->getProductStockCount();
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse["success"] == true && isset($jsonResponse["success"])) {
        echo $jsonResponse["itemStockCount"];
    } else {
        echo $jsonResponse["error"];
    }
?>