<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/database/connection.php';
class Login extends connection{
    protected function getUser($email,$mdPass){
        $check = $query = $this->dbConnction()->prepare("SELECT *  FROM users where password = ?
        AND email = ?  LIMIT 1");
       $check->execute([$mdPass,$email]);
       $query=$query->fetchAll();
       if(count($query) == 0){
             session_start();
             $_SESSION['flush'] = 'This user does not exist';
             header("location: /pharnacyapp/index.php");
             exit;
       }
      
            session_start();
            $_SESSION["id"]=$query[0]['userId'];
            $_SESSION["type"]=$query[0]['usertype'];
            $_SESSION["name"]=$query[0]['userName'];
        
     }

    }