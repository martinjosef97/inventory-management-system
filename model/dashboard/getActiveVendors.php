<?php
    require_once (__DIR__ . '/controller/getVendorsController.php');
    $controller = new GetVendorsController();
    $response = $controller->getActiveVendorCount();
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse["success"] == true && isset($jsonResponse["success"])) {
        echo $jsonResponse["activeVendors"];
    } else {
        echo $jsonResponse["error"];
    }
?>