<?php

class connection{
    private $dsn = "mysql:host=localhost;dbname=pharmacyapp";
    private $password = "";
    private $username = "root";

    public function dbConnction(){
        try{
        $db = new PDO($this->dsn,$this->username,$this->password);
        }catch(PDOException $e) {
            print "Database error : ".$e->getMessage();
            die();
        }
        return $db;
    }
}