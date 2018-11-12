<?php
    require './autoload.php';

    $isAllowed = \Models\User::authenticate($_POST['username'], $_POST['password']);
   
    if($isAllowed) {            
        header('Location: index.php');
    }else {
        header('Location: login.php?error=Invalid Credentials!');
    }
    exit;