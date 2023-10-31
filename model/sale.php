<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class Sale extends connection
{
  public function index($barcode)
  {
    try {
      $product = $this->dbConnction()->prepare("SELECT productId FROM products where barcode=?");
      $product->execute([$barcode]);
      $productId = $product->fetch();

      $query = $this->dbConnction()->prepare("SELECT products.productName,products.productId,products.hasChildUnit,
        batches.qty,batches.batchId,batches.expirationDate,purchasedetails.RetailSalePrice,purchasedetails.WholesaleSalePrice FROM products 
        INNER JOIN  batches ON batches.productId =products.productId 
        INNER JOIN  purchasedetails ON purchasedetails.productId =batches.productId  AND
         purchasedetails.batchNumber =batches.batchNumber AND  purchasedetails.madeAt > 0 
        WHERE products.productId=? ORDER BY expirationDate ASC ");
      $query->execute([$productId['productId']]);
      return $query->fetchAll();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function getAllProduct()
  {
    try {
      $query = $this->dbConnction()->prepare("SELECT products.productName,products.productId,products.hasChildUnit,
        batches.qty,batches.batchId,batches.expirationDate,purchasedetails.RetailSalePrice,purchasedetails.WholesaleSalePrice FROM products 
        INNER JOIN  batches ON batches.productId =products.productId 
        INNER JOIN  purchasedetails ON purchasedetails.productId =batches.productId  AND
         purchasedetails.batchNumber =batches.batchNumber AND  purchasedetails.madeAt > 0 
         ORDER BY expirationDate ASC ");
      $query->execute();
      return $query->fetchAll();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
  public function fetchProductDetails($id)
  {
    try {
      $product = $this->dbConnction()->prepare("SELECT productId,batchNumber FROM batches WHERE batchId=?");
      $product->execute([$id]);
      $productId = $product->fetch();
      $query = $this->dbConnction()->prepare("SELECT purchasedetails.productId,purchasedetails.hasChildUnit,
        batches.qty,batches.batchNumber,purchasedetails.RetailSalePrice,purchasedetails.WholesaleSalePrice FROM batches 
        INNER JOIN  purchasedetails ON purchasedetails.productId =batches.productId  AND
         purchasedetails.batchNumber =batches.batchNumber 
        WHERE purchasedetails.productId=? AND purchasedetails.batchNumber=? AND  purchasedetails.madeAt > 0  ");
      $query->execute([$productId['productId'], $productId['batchNumber']]);
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

  public function add($productId, $qty, $total, $salePrice, $invoiceNumber, $barcode, $batchNumber)
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
        //Type one means it is sales 
        $sales =  $sales->execute([$invoiceNumber, $total, $qty, $now, $userId, 1]);
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
        $salesdetails = 'INSERT INTO salesdetails (invoiceNumber,barcode,productId,qty,salePrice,date,userId,batchNumber) VALUE (?,?,?,?,?,?,?,?)';
        $salesdetails =  $this->dbConnction()->prepare($salesdetails);
        $salesdetails->execute([$invoiceNumber, $barcode, $productId, $qty, $salePrice, $now, $userId, $batchNumber]);
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
        $batchNumber = $this->dbConnction()->prepare("SELECT  * FROM batches WHERE batchNumber=? 
        AND  productId=?");
        $batchNumber->execute([$sale['batchNumber'], $sale['productId']]);
        $batchNumber = $batchNumber->fetch();
        $qty =  $batchNumber['qty'] - $sale['qty'];
        if ($qty == 0) {
          // Delete when quantity equal to zero from batches table
          $batches = $this->dbConnction()->prepare('DELETE FROM batches WHERE batchNumber=?  AND  productId=?');
          $batches->execute([$sale['batchNumber'], $sale['productId']]);
        } else {
          // update the quantity batches table
          $batches = $this->dbConnction()->prepare('UPDATE batches SET qty=? WHERE batchNumber=?  AND  productId=?');
          $batches->execute([$qty, $sale['batchNumber'], $sale['productId']]);
        }
        // store table
        $stores = $this->dbConnction()->prepare("SELECT  * FROM stores WHERE  productId=? ORDER BY 
        `stores`.`storeId` DESC LIMIT 1");
        $stores->execute([$sale['productId']]);
        $stores = $stores->fetch();
        $qty =  $stores['qtyRemining'] - $sale['qty'];
        $store = $this->dbConnction()->prepare('INSERT INTO stores (qtyRemining ,qty,storeDate,productId,userId,Type)
         VALUE (?,?,?,?,?,?)');
        // type 2 means it is coming from sales
        $store->execute([$qty, $sale['qty'], $now, $sale['productId'], $userId, 2]);


        $totalPrice += $sale['qty'] * $sale['salePrice'];
      }
      // insert into accounting table
      $accounting = 'INSERT INTO accounting (AccountName,credit,date) VALUE (?,?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account Sales', $totalPrice, $now]);

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
      sales INNER JOIN users ON users.userId = sales.userId
      WHERE type = 1;
       ORDER BY `sales`.`saleId` DESC ');
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
    sales INNER JOIN users ON users.userId = sales.userId WHERE type = 1 AND date BETWEEN ? AND  ? ORDER BY `sales`.`saleId` DESC");
    $query->execute([$startDate, $endDate]);
    return $query->fetchAll();
  }
}
