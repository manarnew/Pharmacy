<?php

include '/xampp/htdocs/pharmacyapp/database/connection.php';
class Purchase extends connection
{
  public function add($supplierId, $details, $invoiceNumber)
  {
    $now = date("Y/m/d");
    $userId = $_SESSION['id'];
    $query = 'INSERT INTO purchases (supplierId,details,invoiceNumber,userId,addedDate) 
                    VALUE 
                    (?,?,?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([$supplierId, $details, $invoiceNumber, $userId, $now]);

    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function purchaseDetailsInvoice(
    $purchaseId,
    $productId,
    $endDate,
    $wholesaleUnitId,
    $WholesaleQty,
    $WholesalePayPrice,
    $WholesaleSalePrice,
    $hasChildUnit,
    $RetailUnitId,
    $RetailSalePrice,
    $RetailPayPrice,
    $RetailQty,
    $TotalRetailQty,
    $batchNumber
  ) {
    $check = $this->dbConnction()->prepare('SELECT productId FROM purchasedetails WHERE productId=? AND  purchaseId =? LIMIT 1');
    $check->execute([$productId, $purchaseId]);
    $product = $check->fetchAll();
    if (count($product) > 0) {
      return -1;
    }

    $userId = $_SESSION['id'];
    $query = 'INSERT INTO purchasedetails (purchaseId,productId,endDate,wholesaleUnitId,WholesaleQty,WholesalePayPrice
    ,WholesaleSalePrice,hasChildUnit,RetailUnitId,RetailSalePrice,RetailPayPrice,RetailQty,TotalRetailQty,batchNumber,userId) 
                    VALUE 
                    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([
      $purchaseId, $productId, $endDate, $wholesaleUnitId, $WholesaleQty, $WholesalePayPrice, $WholesaleSalePrice, $hasChildUnit, $RetailUnitId, $RetailSalePrice, $RetailPayPrice, $RetailQty, $TotalRetailQty, $batchNumber, $userId
    ]);

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
    INNER JOIN users  ON users.userId= purchases.userId");
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

  public function update($invoiceNumber, $details, $supplierId, $purchaseId, $Remained, $tax, $paid, $costOnPay)
  {

    $query = 'UPDATE purchases SET invoiceNumber =?, details = ?,supplierId = ?,Remained = ?
             ,tax = ?,paid = ?,costOnPay = ? WHERE purchaseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$invoiceNumber, $details, $supplierId, $Remained, $tax, $paid, $costOnPay, $purchaseId]);
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


  public function goeOneProduct()
  {
    $query = $this->dbConnction()->prepare("SELECT productId,productName,barcode,hasChildUnit  FROM products");
    $query->execute();
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


  public function addAccount($paid, $tax, $Remained, $costOnPay, $purchaseId)
  {
    $query = 'UPDATE purchases SET paid = ?,tax =?,Remained =?,costOnPay =? WHERE purchaseId = ?';
    $query =  $this->dbConnction()->prepare($query);
    $query->execute([$paid, $tax, $Remained, $costOnPay, $purchaseId]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function approved($approveId)
  {
    try {

      $now = date("Y/m/d");
      $userId = $_SESSION['id'];
      $query = $this->dbConnction()->prepare("SELECT hasChildUnit,RetailQty,WholesaleQty,endDate,productId,batchNumber  FROM purchasedetails WHERE purchaseId = ?");
      $query->execute([$approveId]);
      $pur = $query->fetchAll();
      $qty = 0;
      $qtyRemining = 0;
      $totalPrice = 0;
      foreach ($pur as $pur) {
        /* 
      store the batches
      */
        $query = 'INSERT INTO batches (productId,batchNumber,expirationDate,qty) VALUE (?,?,?,?)';
        $query =  $this->dbConnction()->prepare($query);
        if ($pur['hasChildUnit'] == 1) {
          $qty = $pur['RetailQty'];
        } else {
          $qty = $pur['WholesaleQty'];
        }
        $query->execute([$pur['productId'], $pur['batchNumber'], $pur['endDate'], $qty]);
        // end store the batches

        /* 
      store the stock 
      */
        $stor = $this->dbConnction()->prepare("SELECT *  FROM stores WHERE productId =? ORDER BY `stores`.`storeId` DESC LIMIT 1");
        $stor->execute([$pur['productId']]);
        $store = $stor->fetch();
        if ($store['productId'] > 0) {
          $qtyRemining = $store['qtyRemining'] + $qty;
        } else {
          $qtyRemining = $qty;
        }
        $query = 'INSERT INTO stores (productId,Type,qty,qtyRemining,userId,storeDate) VALUE (?,?,?,?,?,?)';
        $query =  $this->dbConnction()->prepare($query);
        // type 1 means this a purchase
        $query->execute([$pur['productId'], 1, $qty, $qtyRemining, $userId, $now]);

        $totalPrice += ($pur['WholesalePayPrice'] * $pur['WholesaleQty']);
        // end store the stock 
      }
      // Insert accounting 
      $select = $this->dbConnction()->prepare("SELECT tax,costOnPay,Remained FROM purchases WHERE purchaseId = ?");
      $select->execute([$approveId]);
      $select = $select->fetch();
      $totalPrice -= $select['Remained'];
      $debit  = $totalPrice + $select['tax'] + $select['costOnPay'];
      $accounting = 'INSERT INTO accounting (AccountName,debit) VALUE (?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account Purchase cost', $debit]);
      // end Insert accounting 
      $update = 'UPDATE purchases SET approved =? WHERE purchaseId=?';
      $update = $this->dbConnction()->prepare($update);
      $update->execute([1, $approveId]);
      // update approve to approved

      return true;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
}
