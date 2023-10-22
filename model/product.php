<?php

include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/database/connection.php';
class Product extends connection
{
  public function add($productName, $categoryId, $details, $barcode, $newFileName, $wholesaleUnitId, $hasChildUnit, $RetailUnitId)
  {
    $check = $query = $this->dbConnction()->prepare("SELECT productId  FROM products where productName = ?
    LIMIT 1");
    $check->execute([$productName]);
    $name = $query->fetchAll();
    if (count($name) > 0) {
      $_SESSION['flush'] = 'This item is exist';
      header("location: ../view/products/addProduct.php");
      exit;
    }

    $now = date("Y/m/d");
    $userId = $_SESSION['id'];
    $query = 'INSERT INTO products (productName,categoryId,details,barcode,image,wholesaleUnitId,hasChildUnit,RetailUnitId,userId,addedDate) 
                    VALUE 
                    (?,?,?,?,?,?,?,?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([$productName, $categoryId, $details, $barcode, $newFileName, $wholesaleUnitId, $hasChildUnit, $RetailUnitId, $userId, $now]);

    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM categories INNER JOIN products ON categories.categoryId
                                               = products.categoryId ORDER BY productId DESC");
    $query->execute();
    return $query->fetchAll();
  }

  public function delete($id)
  {
    $check = $query = $this->dbConnction()->prepare("SELECT productId  FROM purchasedetails where productId = ?
    LIMIT 1");
    $check->execute([$id]);
    $productId = $query->fetch();
    if($productId > 0){
      $_SESSION['flush'] = 'This medicine related with purchases can not be deleted';
      header("location: ../view/products/products.php");
      exit;
    }
    $query = 'DELETE FROM products WHERE productId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }


  public function update($productName, $categoryId, $details, $barcode, $newFileName, $wholesaleUnitId, $hasChildUnit, $RetailUnitId, $productId)
  {
    $query = 'UPDATE products SET productName = ?,categoryId = ?,details = ?,barcode = ?,image = ?,wholesaleUnitId = ?
     ,RetailUnitId = ? ,hasChildUnit = ? WHERE productId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$productName, $categoryId, $details, $barcode, $newFileName, $wholesaleUnitId, $RetailUnitId, $hasChildUnit, $productId]);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  public function getCat()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM categories");
    $query->execute();
    return $query->fetchAll();
  }

  public function getUnitMaster()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM units WHERE isMaster = 1");
    $query->execute();
    return $query->fetchAll();
  }
  public function getUnitChild()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM units WHERE isMaster = 0");
    $query->execute();
    return $query->fetchAll();
  }


  public function details($id)
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM   categories  
                                           INNER JOIN  products  ON categories.categoryId= products.categoryId
                                           INNER JOIN users  ON users.userId= products.userId
                                           INNER JOIN  units ON units.unitId = products.wholesaleUnitId
                                           WHERE products.productId = $id");
    $query->execute();
    return  $query->fetch();
  }
  public function RetailUnitId($id)
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM   units  
                                         INNER JOIN  products ON units.unitId =products.RetailUnitId or products.wholesaleUnitId
                                         WHERE products.productId = $id");
    $query->execute();
    return  $query->fetch();
  }
}
