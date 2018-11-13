<?php

namespace Models;

class User extends Db{

    public function __construct() {
        parent::__construct();
    }

    public static function authenticate($_username, $_password){
    
        $db = self::connect();
        
        $username = mysqli_real_escape_string($db, $_username);
        $password = mysqli_real_escape_string($db, $_password); 
        
        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

        $result = mysqli_query($db,$sql);
            
        if((mysqli_num_rows($result)) == 1) {
            $_SESSION['login_user'] = $_username;
            return true;
        }else {
            return false;   
        }
    }

    //end of class
}