<?php

namespace Models;

class Db {

    public static function connect() {
        $db = mysqli_connect(CONFIG_DB_SERVER, CONFIG_DB_USERNAME, CONFIG_DB_PASSWORD, CONFIG_DB_DATABASE);
        return $db;
    }
}