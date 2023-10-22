<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class Store extends connection
{
  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT users.userName,products.productName,
                  stores.qty,stores.qtyRemining ,stores.Type ,stores.storeDate FROM products 
                  INNER JOIN  stores ON stores.productId =products.productId 
                  INNER JOIN  users ON users.userId =stores.userId 
                  ORDER BY storeId DESC");
    $query->execute();
    return $query->fetchAll();
  }
}
