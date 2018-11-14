<?php
    require './autoload.php';

    $address = \Models\Address::getDataByID(4);

    if($address) {
        http_response_code(200);
        echo json_encode($address);
    }else {
        http_response_code(400);
        echo json_encode('Error');
    }
    exit;