<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class SaleReturn extends connection
{
  public function index($barcode)
  {
    try {
      $product = $this->dbConnction()->prepare("SELECT  products.productId,products.productName FROM salesdetails 
      INNER JOIN products ON products.productId =  salesdetails.productId
       where products.barcode=? GROUP BY products.productName");
      $product->execute([$barcode]);
      return $product->fetchAll();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function getAllProduct()
  {
    try {
      $product = $this->dbConnction()->prepare("SELECT  products.productId,products.productName FROM salesdetails 
      INNER JOIN products ON products.productId =  salesdetails.productId GROUP BY products.productName");
      $product->execute();
      return $product->fetchAll();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function fetchProductDetails($id)
  {
    try {
      $query = $this->dbConnction()->prepare("SELECT  salePrice ,productId
        FROM salesdetails WHERE productId=? ORDER BY `salesdetails`.`saleDetailId` DESC LIMIT 1 ");
      $query->execute([$id]);
      return $query->fetch();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }


  public function getProductName($id)
  {
    try {
      $product = $this->dbConnction()->prepare("SELECT productName FROM products where productId=?");
      $product->execute([$id]);
      return $product->fetch();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }

  public function add($productId, $qty, $total, $salePrice, $invoiceNumber, $barcode, $expiationDate)
  {
    try {
      $now = date("Y/m/d");
      $userId = $_SESSION['id'];

      $product = $this->dbConnction()->prepare("SELECT invoiceNumber,saleId,TotalPrice,totalQty FROM sales where invoiceNumber=?");
      $product->execute([$invoiceNumber]);
      $check = $product->fetch();
      if (!$check) {
        $sales = 'INSERT INTO sales (invoiceNumber,TotalPrice,totalQty,date,userId,type) VALUE (?,?,?,?,?,?)';
        $sales =  $this->dbConnction()->prepare($sales);
         //Type zero  means it is sales return
        $sales =  $sales->execute([$invoiceNumber, $total, $qty, $now, $userId, 0]);
      } else {
        $TotalPrice = $check['TotalPrice'] + $total;
        $totalQty = $check['totalQty'] + $qty;
        $sales = 'UPDATE sales SET TotalPrice=?,totalQty=? WHERE invoiceNumber=?';
        $sales =  $this->dbConnction()->prepare($sales);
        $sales->execute([$TotalPrice, $totalQty, $invoiceNumber]);
      }
      $checkIfProductExists = $this->dbConnction()->prepare("SELECT qty FROM salesdetails
        where invoiceNumber=? AND productId=? ");
      $checkIfProductExists->execute([$invoiceNumber, $productId]);
      $checkIfProductExists = $checkIfProductExists->fetch();
      if (!$checkIfProductExists) {
        $salesdetails = 'INSERT INTO salesdetails (invoiceNumber,barcode,productId,qty,salePrice,date,userId,expirationDate) VALUE (?,?,?,?,?,?,?,?)';
        $salesdetails =  $this->dbConnction()->prepare($salesdetails);
        $salesdetails->execute([$invoiceNumber, $barcode, $productId, $qty, $salePrice, $now, $userId, $expiationDate]);
      } else {
        $qtyNew = $checkIfProductExists['qty'] + $qty;
        $sales = 'UPDATE salesdetails SET qty=? WHERE invoiceNumber=? AND productId=?';
        $sales =  $this->dbConnction()->prepare($sales);
        $sales->execute([$qtyNew, $invoiceNumber, $productId]);
      }



      return true;
    } catch (Exception $e) {
      return "Error " . $e->getMessage();
    }
  }


  public function showSalesDetailFrom($invoiceNumber)
  {
    try {
      $salesdetails = $this->dbConnction()->prepare("SELECT qty,salePrice,salesdetails.invoiceNumber,products.productId,products.productName FROM salesdetails
      INNER JOIN products ON products.productId = salesdetails.productId
      WHERE invoiceNumber=? ");
      $salesdetails->execute([$invoiceNumber]);
      return $salesdetails->fetchAll();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function deleteMedicine($productId, $invoiceNumber, $totalPrice, $qty)
  {
    try {
      $product = $this->dbConnction()->prepare("SELECT TotalPrice,totalQty FROM sales where invoiceNumber=?");
      $product->execute([$invoiceNumber]);
      $check = $product->fetch();

      $TotalPrice = $check['TotalPrice'] - $totalPrice;
      $totalQty = $check['totalQty'] - $qty;
      $sales = 'UPDATE sales SET TotalPrice=?,totalQty=? WHERE invoiceNumber=?';
      $sales =  $this->dbConnction()->prepare($sales);
      $sales->execute([$TotalPrice, $totalQty, $invoiceNumber]);

      $salesdetails = $this->dbConnction()->prepare("DELETE FROM  salesdetails WHERE invoiceNumber=? AND  productId=?");
      $salesdetails->execute([$invoiceNumber, $productId]);
      return true;
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function Save($invoiceNumber)
  {
    $totalPrice = 0;
    $now = date("Y/m/d");
    $userId = $_SESSION['id'];
    try {


      $salesdetails = $this->dbConnction()->prepare("SELECT  * FROM salesdetails WHERE invoiceNumber=?");
      $salesdetails->execute([$invoiceNumber]);
      $sale = $salesdetails->fetchAll();
      foreach ($sale as $sale) {
        $batchNumber = $this->dbConnction()->prepare("SELECT  * FROM batches WHERE expirationDate=? 
        AND  productId=?");
        $batchNumber->execute([$sale['expirationDate'], $sale['productId']]);
        $batchNumber = $batchNumber->fetch();

        if (!$batchNumber) {
          // insert when it empty that means it is last one has been sell in the return inserted again 
          $sale['qty'];
          $batches = $this->dbConnction()->prepare('INSERT INTO batches (productId,batchNumber,expirationDate,qty) VALUE (?,?,?,?)');
          $batchNumber = (uniqid() . microtime(true));
          $batches->execute([$sale['productId'], $batchNumber, $sale['expirationDate'], $sale['qty']]);
        } else {
          // update the quantity batches table
          $qty = $sale['qty'] + $batchNumber['qty'];
          $batches = $this->dbConnction()->prepare('UPDATE batches SET qty=? WHERE expirationDate=?  AND  productId=?');
          $batches->execute([$qty, $sale['expirationDate'], $sale['productId']]);
        }
        // store table
        $stores = $this->dbConnction()->prepare("SELECT  * FROM stores WHERE  productId=? ORDER BY 
        `stores`.`storeId` DESC LIMIT 1");
        $stores->execute([$sale['productId']]);
        $stores = $stores->fetch();
        $qty =  $stores['qtyRemining'] + $sale['qty'];
        $store = $this->dbConnction()->prepare('INSERT INTO stores (qtyRemining ,qty,storeDate,productId,userId,Type)
         VALUE (?,?,?,?,?,?)');
        // type 3 means it is coming from sales return
        $store->execute([$qty, $sale['qty'], $now, $sale['productId'], $userId, 3]);


        $totalPrice += $sale['qty'] * $sale['salePrice'];
      }
      // insert into accounting table
      $accounting = 'INSERT INTO accounting (AccountName,debit,date) VALUE (?,?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account Sales Return', $totalPrice, $now]);

      return true;
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }

  public function cancelInvoice($invoiceNumber)
  {
    try {


      $salesdetails = $this->dbConnction()->prepare("DELETE FROM salesdetails WHERE invoiceNumber=?");
      $salesdetails->execute([$invoiceNumber]);

      $sales = $this->dbConnction()->prepare("DELETE FROM sales WHERE invoiceNumber=?");
      $sales->execute([$invoiceNumber]);
      return true;
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function showSale()
  {
    try {
      $sale = $this->dbConnction()->prepare('SELECT invoiceNumber,TotalPrice,totalQty,date,users.userName FROM 
      sales INNER JOIN users ON users.userId = sales.userId WHERE type = 0 ORDER BY `sales`.`saleId` DESC 
      ');
      $sale->execute();
      return $sale->fetchAll();
    } catch (Exception $e) {
      return 'error ' . $e->getMessage();
    }
  }
  public function dateSearch($startDate, $endDate)
  {
    if (empty($endDate)) $endDate = date("Y/m/d");
    $temp = '';
    if ($startDate > $endDate) {
      $temp = $startDate;
      $startDate = $endDate;
      $endDate = $temp;
    }
    $query = $this->dbConnction()->prepare("SELECT invoiceNumber,TotalPrice,totalQty,date,users.userName FROM 
    sales INNER JOIN users ON users.userId = sales.userId WHERE type = 0 AND date BETWEEN ? AND  ? ORDER BY `sales`.`saleId` DESC");
    $query->execute([$startDate, $endDate]);
    return $query->fetchAll();
  }
  public function invoiceNum(){
    $query = $this->dbConnction()->prepare("SELECT saleId FROM sales ORDER BY `sales`.`saleId` DESC");
    $query->execute();
    $number = $query->fetch();
    if($query->rowCount()>0){
      return $number['saleId']+1;
    }else{
      return 1;
    }
  }
}
