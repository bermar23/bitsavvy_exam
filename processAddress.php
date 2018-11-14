<?php
    require './autoload.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_address = \Models\Address::createUpdate($_POST);
    
        if($_address) {
            http_response_code(200);
            echo json_encode($_address);
        }else {
            http_response_code(400);
            echo json_encode('Error');
        }
    }
    exit;