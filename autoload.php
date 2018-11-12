<?php

include './config.php';
session_start();

$_myDb = mysqli_connect(CONFIG_DB_SERVER, CONFIG_DB_USERNAME, CONFIG_DB_PASSWORD, CONFIG_DB_DATABASE);

//include classes
include 'models/Contact.php';