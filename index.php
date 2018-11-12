<?php

require './autoload.php';

if(!$_SESSION['login_user']){
    header('Location: login.php');
}
?>
