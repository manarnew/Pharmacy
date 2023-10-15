<?php
include '/xampp/htdocs/pharmacyapp/database/connection.php';
class Unit extends connection{
  public function add($parentUnit,$childUnit){
    $query = 'INSERT INTO units (parentName,childName) VALUE (?,?)';

    $query =  $this->dbConnction()->prepare($query);
     
    $query->execute([$parentUnit,$childUnit]);

    if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }

  public function index(){
      $query = $this->dbConnction()->prepare("SELECT *  FROM units");
      $query->execute();
      return $query->fetchAll();
  }

  public function delete($id){
     $query = 'DELETE FROM units WHERE unitId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
  public function getOneUnit($id){
    $query = 'SELECT * FROM units WHERE unitId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetch();
  }

  public function update($parentUnit,$childUnit,$id){
     $query = 'UPDATE units SET parentName =? ,childName = ? WHERE unitId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$parentUnit,$childUnit,$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
}