<?php

include '/xampp/htdocs/pharmacyapp/database/connection.php';
class Product extends connection{
  public function add($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$qrcode,$image){
    $now= date("Y/m/d");
    $userId = $_SESSION['id'];
    $query = 'INSERT INTO products (productName,categoryId,payPrice,salePrice,addedDate,endDate,supplierId,details,userId,qty,barcode,image) 
                    VALUE 
                    (?,?,?,?,?,?,?,?,?,?,?,?)';

    $query =  $this->dbConnction()->prepare($query);
     
    $query->execute([$productName,$categoryId,$payPrice,$salePrice,$now,$endDate,$supplierId,$details,$userId,$qty,$qrcode,$image]);

    if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }

  public function index(){
      $query = $this->dbConnction()->prepare("SELECT *  FROM categories INNER JOIN products ON categories.categoryId
                                               = products.categoryId");
      $query->execute();
      return $query->fetchAll();
  }

  public function delete($id){
     $query = 'DELETE FROM products WHERE productId=?';
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

  public function update($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$image,$productId){
     $query = 'UPDATE products SET productName = ?,categoryId = ?,payPrice = ?,salePrice = ?,endDate = ?
                            ,supplierId = ?,details = ?,qty = ?,barcode = ?,image = ? WHERE productId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$image,$productId]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }

  public function getCat(){
    $query = $this->dbConnction()->prepare("SELECT *  FROM categories");
    $query->execute();
    return $query->fetchAll();
  }

  public function getSuppliers(){
    $query = $this->dbConnction()->prepare("SELECT supplierId,supplierName  FROM suppliers");
    $query->execute();
    return $query->fetchAll();
  }


  public function details($id){
    $query = $this->dbConnction()->prepare("SELECT *  FROM categories  
                                           INNER JOIN products  ON categories.categoryId= products.categoryId
                                           INNER JOIN users  ON users.userId= products.userId
                                           INNER JOIN suppliers  ON suppliers.supplierId= products.supplierId
                                           WHERE products.productId = $id");
     $query->execute();
    return  $query->fetch();
}
}