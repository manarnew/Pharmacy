<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/database/connection.php';

class User extends connection{
    // Add user to database
    protected function setUser($username,$mdPass,$type,$email){ 
        $query = 'INSERT INTO users (userName,password,userType,email) VALUE (?,?,?,?)';

        $query =  $this->dbConnction()->prepare($query);
         
        $query->execute([$username,$mdPass,$type,$email]);
    
        return true;
     }
     // check if the user exist or not
     public function checkUser($name,$email){
        $check = $query = $this->dbConnction()->prepare("SELECT *  FROM users where userName = ?
                                                        AND email = ?  LIMIT 1");
       $check->execute([$name,$email]);
       $name=$query->fetchAll();
    
        if(count($name) > 0){
            $_SESSION['flush'] = 'This user is exist';
            header("location: ../view/users/addUser.php");
            exit;
        }
    }
   // get one user for Edit to profile page
    public function getUserProfile(){
        
        $id = $_SESSION["id"];

        $query = $query = $this->dbConnction()->prepare("SELECT *  FROM users where userId = ? LIMIT 1");
        $query->execute([$id]);
        $query=$query->fetch();

        if($query['userId'] > 0){
          return $query;
        }
    }

    protected function editUser($username,$type,$mdPass,$email,$id){ 
      // Update user from user page 
      if(!empty($type)){
        $query = 'UPDATE users SET userName=?,userType=?,password=?,email=? WHERE userId = ?';
        $query =  $this->dbConnction()->prepare($query);
        $query->execute([$username,$type,$mdPass,$email,$id]);
      }
      else{ // Update user from profile page
        $query = 'UPDATE users SET userName=?,password=?,email=? WHERE userId = ?';

        $query =  $this->dbConnction()->prepare($query);
         
        $query->execute([$username,$mdPass,$email,$id]);
      }
        return true;
     }
     public function showUser(){

        $query = $query = $this->dbConnction()->prepare("SELECT *  FROM users");
        $query->execute();
        $query=$query->fetchAll();
        return $query;
     }
     // get one user for Edit to user page
     public function getUser($id){
        $query = $query = $this->dbConnction()->prepare("SELECT *  FROM users where userId = ? LIMIT 1");
        $query->execute([$id]);
        $query=$query->fetch();

        if($query['userId'] > 0){
          return $query;
        }
     }
     public function delete($id)
     {
      $auth = $_SESSION['Id'];
       $check = $query = $this->dbConnction()->prepare("SELECT userId  FROM products where userId = ?
       LIMIT 1");
       $check->execute([$id]);
       $userId = $query->fetch();
       if($userId > 0 || $auth == $id){
         $_SESSION['flush'] = 'This user  related with products can not be deleted';
         header("location: ../view/users/showUser.php");
         exit;
       }
       $query = 'DELETE FROM users WHERE userId=?';
       $query = $this->dbConnction()->prepare($query);
       $query->execute([$id]);
       if ($query->rowCount()) {
         return true;
       } else {
         return false;
       }
     }
}