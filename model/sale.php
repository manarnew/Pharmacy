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
      $query->execute([$productId['productId'], $productId['batchNumber'] ]);
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

  public function add($productId,$qty,$total,$salePrice,$invoiceNumber,$barcode)
  {
    try{
      $now = date("Y/m/d");
      $userId = $_SESSION['id'];

      $product = $this->dbConnction()->prepare("SELECT invoiceNumber,saleId,TotalPrice,totalQty FROM sales where invoiceNumber=?");
      $product->execute([$invoiceNumber]);
      $check =$product->fetch();
      if(!$check)
      {
        $sales = 'INSERT INTO sales (invoiceNumber,TotalPrice,totalQty,date,userId) VALUE (?,?,?,?,?)';
        $sales =  $this->dbConnction()->prepare($sales);
        $sales =  $sales->execute([$invoiceNumber,$total,$qty,$now,$userId]);
      }else{
        $TotalPrice=$check['TotalPrice']+$total;
        $totalQty=$check['totalQty']+$qty;
        $sales = 'UPDATE sales SET TotalPrice=?,totalQty=? WHERE invoiceNumber=?';
        $sales =  $this->dbConnction()->prepare($sales);
        $sales->execute([$TotalPrice,$totalQty,$invoiceNumber]);
      }
      $checkIfProductExists = $this->dbConnction()->prepare("SELECT qty FROM salesdetails
        where invoiceNumber=? AND productId=? ");
      $checkIfProductExists->execute([$invoiceNumber,$productId]);
      $checkIfProductExists =$checkIfProductExists->fetch();
      if(!$checkIfProductExists)
      {
        $salesdetails = 'INSERT INTO salesdetails (invoiceNumber,barcode,productId,qty,salePrice,date,userId) VALUE (?,?,?,?,?,?,?)';
        $salesdetails =  $this->dbConnction()->prepare($salesdetails);
        $salesdetails->execute([$invoiceNumber,$barcode,$productId,$qty,$salePrice,$now,$userId]);
      }else
      {
        $qtyNew=$checkIfProductExists['qty']+$qty;
        $sales = 'UPDATE salesdetails SET qty=? WHERE invoiceNumber=? AND productId=?';
        $sales =  $this->dbConnction()->prepare($sales);
        $sales->execute([$qtyNew,$invoiceNumber,$productId]);
      }

   

      return true;
    }catch(Exception $e){
      return "Error ".$e->getMessage();
    }
  }


  public function showSalesDetailFromAjax($invoiceNumber)
  {
    try {
      $salesdetails = $this->dbConnction()->prepare("SELECT qty,salePrice,products.productName FROM salesdetails
      INNER JOIN products ON products.productId = salesdetails.productId
      where invoiceNumber=? ");
    $salesdetails->execute([$invoiceNumber]);
    return $salesdetails->fetchAll();
    } catch (Exception $e) {
      return 'Error ' . $e->getMessage();
    }
  }
}
