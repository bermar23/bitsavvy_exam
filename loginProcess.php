<?php
    require './autoload.php';
   
    $username = mysqli_real_escape_string($_myDb, $_POST['username']);
    $password = mysqli_real_escape_string($_myDb, $_POST['password']); 
    
    $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

    $result = mysqli_query($_myDb,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          
    if((mysqli_num_rows($result)) == 1) {
        $_SESSION['login_user'] = $username;    
        header('Location: index.php');
    }else {
        header('Location: login.php?error=Invalid Credentials!');
    }
    exit;