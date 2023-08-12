<?php
    require_once (__DIR__ . '/controller/getItemCountController.php');
    $controller = new GetItemCountController();
    $response = $controller->getProductTypeCount();
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse["success"] == true && isset($jsonResponse["success"])) {
        echo $jsonResponse["itemCount"];
    } else {
        echo $jsonResponse["error"];
    }

?>