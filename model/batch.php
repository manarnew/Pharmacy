<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class Batch extends connection
{
  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT products.productName,
                  batches.qty,batches.expirationDate FROM products 
                  INNER JOIN  batches ON batches.productId =products.productId 
                  ORDER BY expirationDate ASC");
    $query->execute();
    return $query->fetchAll();
  }
}
