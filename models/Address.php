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

        $id = mysqli_real_escape_string($id);
        
        $sql = "SELECT * FROM address WHERE id = $id;";

        $result = mysqli_query($db, $sql);

        return mysqli_fetch_assoc($result);
    }

    public static function update($data){

        $db = self::connect();

        //get data if not exist
        
        if(isset($data['address_id'])||$data['address_id']){
            $address = self::getDataByID($data['address_id']);
            if($address==null){
                return false;
            }

            //update data
            $address_id = mysqli_real_escape_string($db, $data['address_id']);
            $name = mysqli_real_escape_string($db, $data['name']);
            $address = mysqli_real_escape_string($db, $data['address']);
            $city = mysqli_real_escape_string($db, $data['city']);
            $state = mysqli_real_escape_string($db, $data['state']);
            $zipcode = mysqli_real_escape_string($db, $data['zipcode']);
            $phone = mysqli_real_escape_string($db, $data['phone']);

        }else{
            return false;
        }

        //create data

        //return address data

        $where = "";

        if($q){
            $where = "AND name LIKE '%$q%' OR address LIKE '%$q%' OR city LIKE '%$q%' OR state LIKE '%$q%' OR zipcode LIKE '%$q%' OR phone LIKE '%$q%'";
        }
        
        $sql = "SELECT * FROM address WHERE 1 $where ORDER BY $sort_field $sort_by LIMIT $limit;";

        $result = mysqli_query($db, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //end of class
}