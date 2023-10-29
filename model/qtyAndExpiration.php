<?php
class qtyAndExpiration
{
  private $dsn = "mysql:host=localhost;dbname=pharmacyapp";
  private $password = "";
  private $username = "root";

  public function dbConnction()
  {
    try {
      $db = new PDO($this->dsn, $this->username, $this->password);
    } catch (PDOException $e) {
      print "Database error : " . $e->getMessage();
      die();
    }
    return $db;
  }
  public function getQty()
  {
    $query = $this->dbConnction()->prepare("SELECT products.productName,sum(batches.qty) AS quantity FROM products
    INNER JOIN batches ON batches.productId =products.productId
     GROUP BY products.productName ASC LIMIT 4");
    $query->execute();
    return $query->fetchAll();
  }
  public function batches()
  {
    $query = $this->dbConnction()->prepare("SELECT products.productName,batches.expirationDate FROM products
     INNER JOIN batches ON batches.productId =products.productId
      ORDER BY batches.expirationDate ASC LIMIT 4");
    $query->execute();
    return $query->fetchAll();
  }
  public function setting()
  {
    $query = $this->dbConnction()->prepare("SELECT * FROM  settings LIMIT 1");
    $query->execute();
    return  $query->fetch();
  }

  public function allExpired()
  {
    $query = $this->dbConnction()->prepare("SELECT products.productName,products.productId,batches.expirationDate 
    ,batches.qty FROM products
     INNER JOIN batches ON batches.productId =products.productId
      ORDER BY batches.expirationDate ASC");
    $query->execute();
    return $query->fetchAll();
  }

  public function AddEnddedQty()
  {
    $query = $this->dbConnction()->prepare("SELECT products.productName,sum(batches.qty) AS quantity FROM products
    INNER JOIN batches ON batches.productId =products.productId
     GROUP BY products.productName ASC");
    $query->execute();
    return $query->fetchAll();
  }

  public function deleteExpiredProduct($productId, $expirationDate, $qty)
  {
    try{
    $now = date('y/m/d');
    $userId = $_SESSION['id'];
    $query = $this->dbConnction()->prepare("DELETE FROM batches WHERE productId =?
    AND expirationDate =?");
    $query->execute([$productId, $expirationDate]);

    $stores = $this->dbConnction()->prepare("SELECT  * FROM stores WHERE  productId=? ORDER BY 
    `stores`.`storeId` DESC LIMIT 1");
    $stores->execute([$productId]);
    $stores = $stores->fetch();
    $qtyRemining =  $stores['qtyRemining'] - $qty;
    $store = $this->dbConnction()->prepare('INSERT INTO stores (qtyRemining ,qty,storeDate,productId,userId,Type)
         VALUE (?,?,?,?,?,?)');
    // type 4 means delete a expired products
    $store->execute([$qtyRemining, $qty, $now, $productId, $userId, 4]);
    return true;
  }catch(Exception $e){
    return 'Error '.$e->getMessage();
  }
  }
}
