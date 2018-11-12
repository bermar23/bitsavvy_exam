<?php

namespace Models;

use Models\MyModel;

class Address implements MyModel{

    public static function setDB(){

    }

    public static function getData($sort_field, $sort_by, $limit = 50){

        $_myDb = mysqli_connect(CONFIG_DB_SERVER, CONFIG_DB_USERNAME, CONFIG_DB_PASSWORD, CONFIG_DB_DATABASE);
    }

    //end of class
}