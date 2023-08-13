<?php
    require_once (__DIR__ . '/controller/getItemCountController.php');
    $controller = new GetItemCountController();
    $response = $controller->getOverallProductSoldCount();
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse["success"] == true && isset($jsonResponse["success"])) {
        echo $jsonResponse["itemOverallSoldCount"];
    } else {
        echo $jsonResponse["error"];
    }
?>