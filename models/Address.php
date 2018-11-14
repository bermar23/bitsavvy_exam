<?php

namespace Models;

class Address extends Db{

    public function __construct() {
        parent::__construct();
    }

    public static function getData($_q, $_sort_field, $_sort_by, $limit = 50){

        $db = self::connect();

        $q = mysqli_real_escape_string($db, $_q);
        $sort_field = mysqli_real_escape_string($db, $_sort_field); 
        $sort_by = mysqli_real_escape_string($db, $_sort_by); 

        $where = "";

        if($q){
            $where = "AND name LIKE '%$q%' OR address LIKE '%$q%' OR city LIKE '%$q%' OR state LIKE '%$q%' OR zipcode LIKE '%$q%' OR phone LIKE '%$q%'";
        }
        
        $sql = "SELECT * FROM address WHERE 1 $where ORDER BY $sort_field $sort_by LIMIT $limit;";

        $result = mysqli_query($db, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function getDataByID($id){
        
        $db = self::connect();

        $id = mysqli_real_escape_string($db, $id);
        
        $query = "SELECT * FROM address WHERE `id` = $id;";

        $result = mysqli_query($db, $query);

        return mysqli_fetch_assoc($result);
    }

    /**
     * Insert and update data
     */
    public static function createUpdate($data){

        $db = self::connect();
        
        $name = mysqli_real_escape_string($db, $data['name']);
        $address = mysqli_real_escape_string($db, $data['address']);
        $city = mysqli_real_escape_string($db, $data['city']);
        $state = mysqli_real_escape_string($db, $data['state']);
        $zipcode = mysqli_real_escape_string($db, $data['zipcode']);
        $phone = mysqli_real_escape_string($db, $data['phone']);
        
        if(isset($data['address_id'])&&$data['address_id']){
            $_address = self::getDataByID($data['address_id']);
            if(!$_address){
                return false;
            }

            //update data
            $address_id = mysqli_real_escape_string($db, $data['address_id']);

            //update query
            $query = "UPDATE address 
                        SET 
                            `name`='$name',
                            `address`='$address',
                            `city`='$city',
                            `state`='$state',
                            `zipcode`='$zipcode',
                            `phone`='$phone' 
                        WHERE `id`=$address_id";

            if (mysqli_query($db, $query)) {
                $updated_address = self::getDataByID($data['address_id']);
                return $updated_address;
            } else {
                return false;
            }

        }else{

            //insert query
            $query = "INSERT INTO address (`name`, `address`, `city`, `state`, `zipcode`, `phone`)
                VALUES ('$name', '$address', '$city', '$state', '$zipcode', '$phone')";

            if (mysqli_query($db, $query)) {
                $new_address_id = mysqli_insert_id($db);

                $updated_address = self::getDataByID($new_address_id);
                return $updated_address;
            } else {
                return false;
            }
        }

    }

    public static function deleteAddress($id){

        if(!$id){
            return false;
        }
        
        $db = self::connect();

        $id = mysqli_real_escape_string($db, $id);

        $query= "DELETE FROM address WHERE id=$id";
        
        if (mysqli_query($db, $query)) {
            return true;
        } else {
            return false;
        }
    }

    //end of class
}