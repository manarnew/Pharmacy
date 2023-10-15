<?php

include '/xampp/htdocs/pharmacyapp/database/connection.php';
class Supplier extends connection{
  public function add($supplierName,$phone,$address){
    $query = 'INSERT INTO suppliers (supplierName,phone,address) VALUE (?,?,?)';

    $query =  $this->dbConnction()->prepare($query);
     
    $query->execute([$supplierName,$phone,$address]);

    if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }

  public function index(){
      $query = $this->dbConnction()->prepare("SELECT *  FROM suppliers");
      $query->execute();
      return $query->fetchAll();
  }

  public function delete($id){
     $query = 'DELETE FROM suppliers WHERE supplierId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
  public function getOneSup($id){
    $query = 'SELECT * FROM suppliers WHERE supplierId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetch();
  }

  public function update($supplierName,$phone,$address,$id){
     $query = 'UPDATE suppliers SET supplierName = ?,phone = ?,address = ? WHERE supplierId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$supplierName,$phone,$address,$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
}