<?php

namespace Models;

use Models\MyModel;

class Address implements MyModel{

    public static function setDB(){

    }

    public static function getData($_q, $_sort_field, $_sort_by, $limit = 50){

        $_myDb = mysqli_connect(CONFIG_DB_SERVER, CONFIG_DB_USERNAME, CONFIG_DB_PASSWORD, CONFIG_DB_DATABASE);

        $q = mysqli_real_escape_string($_myDb, $_q);
        $sort_field = mysqli_real_escape_string($_myDb, $_sort_field); 
        $sort_by = mysqli_real_escape_string($_myDb, $_sort_by); 

        $where = "";

        if($q){
            $where = "AND name LIKE '%$q%' OR address LIKE '%$q%' OR city LIKE '%$q%' OR state LIKE '%$q%' OR zipcode LIKE '%$q%' OR phone LIKE '%$q%'";
        }
        
        $sql = "SELECT * FROM address WHERE 1 $where LIMIT $limit;";

        $result = mysqli_query($_myDb, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //end of class
}