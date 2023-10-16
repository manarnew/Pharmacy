<?php
include '/xampp/htdocs/pharmacyapp/database/connection.php';
class Unit extends connection{
  public function add($unitName,$isMaster){
    $query = 'INSERT INTO units (unitName,isMaster) VALUE (?,?)';

    $query =  $this->dbConnction()->prepare($query);
     
    $query->execute([$unitName,$isMaster]);

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

  public function update($unitName,$isMaster,$id){
     $query = 'UPDATE units SET unitName =? ,isMaster = ? WHERE unitId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$unitName,$isMaster,$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
}