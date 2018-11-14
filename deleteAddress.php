<?php
    require './autoload.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(!isset($_POST['address_id'])||!$_POST['address_id']){
            http_response_code(400);
            echo json_encode('Error');
        }

        $address_id = $_POST['address_id'];
        $_address = \Models\Address::deleteAddress($_POST['address_id']);
    
        if($_address) {
            http_response_code(200);
            echo json_encode(array('id'=>$address_id));
        }else {
            http_response_code(400);
            echo json_encode('Error');
        }
        
    }
    exit;