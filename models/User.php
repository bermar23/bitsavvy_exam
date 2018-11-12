<?php

namespace Models;

use Models\MyModel;

class User {

    public static function authenticate($_username, $_password){
        $_myDb = mysqli_connect(CONFIG_DB_SERVER, CONFIG_DB_USERNAME, CONFIG_DB_PASSWORD, CONFIG_DB_DATABASE);
        $username = mysqli_real_escape_string($_myDb, $_username);
        $password = mysqli_real_escape_string($_myDb, $_password); 
        
        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

        $result = mysqli_query($_myDb,$sql);
            
        if((mysqli_num_rows($result)) == 1) {
            $_SESSION['login_user'] = $_username;
            return true;
        }else {
            return false;   
        }
    }

    //end of class
}