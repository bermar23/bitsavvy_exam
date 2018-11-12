<?php

    require './autoload.php';

    session_destroy();
    header('Location: login.php');
?>
