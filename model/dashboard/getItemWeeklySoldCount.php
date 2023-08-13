<?php
    require_once (__DIR__ . '/controller/getItemCountController.php');
    $controller = new GetItemCountController();
    $response = $controller->getCurrentWeekProductSoldCount();
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse["success"] == true && isset($jsonResponse["success"])) {
        echo $jsonResponse["itemWeeklySoldCount"];
    } else {
        echo $jsonResponse["error"];
    }
?>