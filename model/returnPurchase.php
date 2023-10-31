<?php

include '/xampp/htdocs/pharmacyapp/database/connection.php';
class ReturnPurchase extends connection
{
  public function add($supplierId, $details, $invoiceNumber)
  {
    $now = date("Y/m/d");
    $userId = $_SESSION['id'];
    $query = 'INSERT INTO purchases (supplierId,details,invoiceNumber,userId,addedDate,type) 
                    VALUE 
                    (?,?,?,?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([$supplierId, $details, $invoiceNumber, $userId, $now, 0]);

    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function purchaseDetailsReturnInvoice($purchaseId, $productId, $wholesaleUnitId, $WholesaleQty, $WholesalePayPrice, $RetailQty, $hasChildUnit, $batchNumber)
  {
    $check = $this->dbConnction()->prepare('SELECT productId FROM purchasedetails WHERE productId=? AND  purchaseId =? LIMIT 1');
    $check->execute([$productId, $purchaseId]);
    $product = $check->fetchAll();
    if (count($product) > 0) {
      return -1;
    }

    $userId = $_SESSION['id'];
    $query = 'INSERT INTO purchasedetails (purchaseId,productId,wholesaleUnitId,WholesaleQty,WholesalePayPrice,RetailQty,hasChildUnit,batchNumber,userId) 
                    VALUE 
                    (?,?,?,?,?,?,?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([$purchaseId, $productId, $wholesaleUnitId, $WholesaleQty, $WholesalePayPrice, $RetailQty, $hasChildUnit, $batchNumber, $userId]);

    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM   suppliers  
    INNER JOIN  purchases  ON suppliers.supplierId= purchases.supplierId
    INNER JOIN users  ON users.userId= purchases.userId
    where type = 0");
    $query->execute();
    return  $query->fetchAll();
  }

  public function delete($id)
  {
    $query = 'DELETE FROM purchasedetails WHERE purchaseDetailId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }
  public function getPurchaseForEdit($id)
  {
    $query = 'SELECT * FROM suppliers
              INNER JOIN purchases on suppliers.supplierId= purchases.supplierId WHERE purchaseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetch();
  }

  public function update($details, $purchaseId, $Remained, $paid)
  {

    $query = 'UPDATE purchases SET details = ?,Remained = ?
             ,paid = ? WHERE purchaseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$details, $Remained, $paid, $purchaseId]);
    if ($query->rowCount()) {
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
  public function getSuppliers()
  {
    $query = $this->dbConnction()->prepare("SELECT supplierId,supplierName  FROM suppliers");
    $query->execute();
    return $query->fetchAll();
  }


  public function details($id)
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM   suppliers  
    INNER JOIN  purchases  ON suppliers.supplierId= purchases.supplierId
    INNER JOIN users  ON users.userId= purchases.userId
    WHERE purchases.purchaseId = ?");
    $query->execute([$id]);
    return  $query->fetch();
  }


  public function goeOnePurchasedetails($Numbers)
  {
    $invoiceNumber = $this->dbConnction()->prepare("SELECT purchaseId,invoiceNumber FROM purchases where invoiceNumber ='$Numbers' and type = 1");
    $invoiceNumber->execute();
    $purchaseId = $invoiceNumber->fetch();

    $query = $this->dbConnction()->prepare("SELECT   purchasedetails.batchNumber,purchases.supplierId,products.productId,products.productName,purchasedetails.WholesaleQty,purchasedetails.hasChildUnit,batches.qty 
                                           FROM purchasedetails INNER JOIN products  ON products.productId = purchasedetails.productId
                                            INNER JOIN batches  ON batches.batchNumber= purchasedetails.batchNumber and batches.productId= purchasedetails.productId
                                            INNER JOIN purchases  ON purchases.purchaseId= purchasedetails.purchaseId
                                            where purchases.purchaseId =?");
    $query->execute([$purchaseId['purchaseId']]);
    return $query->fetchAll();
  }

  public function RetailUnitName($product)
  {
    $query = $this->dbConnction()->prepare("SELECT unitName,RetailUnitId  FROM   units  
                                         INNER JOIN   products ON units.unitId =products.RetailUnitId OR products.wholesaleUnitId
                                         where products.productId = ?");
    $query->execute([$product]);
    return  $query->fetch();
  }
  public function goeProductForAddMedicine($product)
  {
    $query = $this->dbConnction()->prepare("SELECT unitName,unitId,productName,productId,hasChildUnit  FROM units
                                           INNER JOIN  products ON units.unitId = products.wholesaleUnitId
                                          where productId = ?");
    $query->execute([$product]);
    return $query->fetch();
  }

  public function getPurchaseDetail($purchaseId)
  {
    try {
      $query = $this->dbConnction()->prepare("SELECT purchasedetails.purchaseDetailId,products.productName,units.unitName,purchasedetails.WholesaleQty,purchasedetails.WholesalePayPrice FROM units
      INNER JOIN  purchasedetails ON units.unitId = purchasedetails.wholesaleUnitId
      INNER JOIN  products ON products.productId = purchasedetails.productId
      where purchaseId = ?");
      $query->execute([$purchaseId]);
      return $query->fetchAll();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }


  public function addAReveivedAccounting($paid, $Remained, $purchaseId)
  {
    $query = 'UPDATE purchases SET paid = ?,Remained =? WHERE purchaseId = ?';
    $query =  $this->dbConnction()->prepare($query);
    $query->execute([$paid,  $Remained,  $purchaseId]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }



  public function deletePurh($id)
  {
    try {
      $purchase = 'DELETE FROM purchases WHERE purchaseId=?';
      $purchase = $this->dbConnction()->prepare($purchase);
      $purchase->execute([$id]);

      $query = 'DELETE FROM purchasedetails WHERE purchaseId=?';
      $query = $this->dbConnction()->prepare($query);
      $query->execute([$id]);
      return true;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  public function goeInvoicesNumber($id)
  {
    try {
      $query = $this->dbConnction()->prepare("SELECT * FROM purchases where supplierId =?");
      $query->execute([$id]);
      return $query->fetchAll();
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  public function WholesalePayPrice($productId, $invoiceNum)
  {
    try {
      $invoiceNumber = $this->dbConnction()->prepare("SELECT purchaseId,invoiceNumber FROM purchases where invoiceNumber ='$invoiceNum' and type = 1");
      $invoiceNumber->execute();
      $purchaseId = $invoiceNumber->fetch();
      $query = $this->dbConnction()->prepare("SELECT  WholesalePayPrice,RetailQty,batchNumber FROM purchasedetails
                                          where productId = ? AND purchaseId = ? ");
      $query->execute([$productId, $purchaseId['purchaseId']]);
      return $query->fetch();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public function approved($approveId)
  {
    try {

      $now = date("Y/m/d");
      $userId = $_SESSION['id'];
      $query = $this->dbConnction()->prepare("SELECT hasChildUnit,RetailQty,WholesaleQty,productId,batchNumber  FROM purchasedetails WHERE purchaseId = ?");
      $query->execute([$approveId]);
      $pur = $query->fetchAll();
      $qty = 0;
      $qtyRemining = 0;
      foreach ($pur as $pur) {
        /* 
      store the batches
      */
        $RetailQty = $this->dbConnction()->prepare("SELECT hasChildUnit,RetailQty  FROM purchasedetails WHERE productId = ? AND batchNumber = ?");
        $RetailQty->execute([$pur['productId'], $pur['batchNumber']]);
        $Retail = $RetailQty->fetch();

        $batche = $this->dbConnction()->prepare("SELECT qty  FROM batches WHERE batchNumber = ? AND productId=?");
        $batche->execute([$pur['batchNumber'], $pur['productId']]);
        $batch = $batche->fetch();
        $query = 'UPDATE batches SET qty = ? WHERE batchNumber = ? AND productId=?';
        $query =  $this->dbConnction()->prepare($query);
        if ($Retail['hasChildUnit'] == 1) {
          $WholesaleQty = $pur['WholesaleQty'] * $Retail['RetailQty'];
          $qty = $batch['qty'] - $WholesaleQty;
        } else {
          $qty = $batch['qty'] - $pur['WholesaleQty'];
        }
        $query->execute([$qty, $pur['batchNumber'], $pur['productId']]);
        // end store the batches

        /* 
      store the stock 
      */
        $stor = $this->dbConnction()->prepare("SELECT *  FROM stores WHERE productId =? ORDER BY `stores`.`storeId` DESC LIMIT 1");
        $stor->execute([$pur['productId']]);
        $store = $stor->fetch();

        if ($Retail['hasChildUnit'] == 1) {
          $qty = $pur['WholesaleQty'] * $Retail['RetailQty'];
        } else {
          $qty = $pur['WholesaleQty'];
        }

        if ($store['productId'] > 0) {
          $qtyRemining = $store['qtyRemining'] - $qty;
        }
        $query = 'INSERT INTO stores (productId,Type,qty,qtyRemining,userId,storeDate) VALUE (?,?,?,?,?,?)';
        $query =  $this->dbConnction()->prepare($query);
        // type 0 means this a Return purchase
        $query->execute([$pur['productId'], 0, $qty, $qtyRemining, $userId, $now]);

        // end store the stock 
      }
      // Insert accounting 
      $select = $this->dbConnction()->prepare("SELECT Remained,supplierId,invoiceNumber,paid FROM purchases WHERE purchaseId = ?");
      $select->execute([$approveId]);
      $select = $select->fetch();
      $accounting = 'INSERT INTO accounting (AccountName,credit,date) VALUE (?,?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account Return Purchase', $select['paid'],$now]);
      //insert supplier account 
      $supplieraccounting = $this->dbConnction()->prepare("SELECT remainedBefor  FROM supplieraccounting ORDER BY `supplieraccounting`.`supplierAccountingId` DESC LIMIT 1");
      $supplieraccounting->execute();
      $supplieraccounting = $supplieraccounting->fetch();

      // remainedBefor if it bcome less than zero means here we need money from him
      $remainedBefor = $supplieraccounting['remainedBefor'] - $select['Remained'];

      $supplier = 'INSERT INTO supplieraccounting (supplierId,invoiceNumber,ReceivedForReturn,remainedForReturn,remainedBefor,date) VALUE (?,?,?,?,?,?)';
      $supplier =  $this->dbConnction()->prepare($supplier);
      $supplier->execute([$select['supplierId'], $select['invoiceNumber'], $select['paid'], $select['Remained'], $remainedBefor, $now]);

      //end insert supplier account

      // Insert accounting 
      $update = 'UPDATE purchases SET approved =? WHERE purchaseId=?';
      $update = $this->dbConnction()->prepare($update);
      $update->execute([1, $approveId]);
      // update approve to approved

      return true;
    } catch (Exception $e) {
      return $e->getMessage();
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
    $query = $this->dbConnction()->prepare("SELECT *  FROM   suppliers  
    INNER JOIN  purchases  ON suppliers.supplierId= purchases.supplierId
    INNER JOIN users  ON users.userId= purchases.userId
    where type = 0 AND addedDate BETWEEN ? AND  ? ORDER BY `purchases`.`purchaseId` DESC");
    $query->execute([$startDate, $endDate]);
    return $query->fetchAll();
  }
}
