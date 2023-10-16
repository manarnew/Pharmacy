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

  public function purchaseDetailsInvoice($purchaseId,$productId,$endDate,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice
  ,$WholesaleSalePrice,$hasChildUnit,$RetailUnitId,$RetailSalePrice,$RetailPayPrice,$RetailQty,$TotalRetailQty,$batchNumber)
  {
    $check =$this->dbConnction()->prepare( 'SELECT productId FROM purchasedetails WHERE productId=? AND  purchaseId =? LIMIT 1');
    $check->execute([$productId,$purchaseId]);
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

    $query->execute([$purchaseId,$productId,$endDate,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice
    ,$WholesaleSalePrice,$hasChildUnit,$RetailUnitId,$RetailSalePrice,$RetailPayPrice,$RetailQty,$TotalRetailQty,$batchNumber,$userId]);

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

  public function update($invoiceNumber,$details,$supplierId,$purchaseId){
  
    $query = 'UPDATE purchases SET invoiceNumber =?, details = ?,supplierId = ? WHERE purchaseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$invoiceNumber,$details,$supplierId,$purchaseId]);
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

  public function getPurchaseDetail($purchaseId){
    try{
      $query = $this->dbConnction()->prepare("SELECT purchasedetails.purchaseDetailId,products.productName,units.unitName,purchasedetails.WholesaleQty,purchasedetails.WholesalePayPrice FROM units
      INNER JOIN  purchasedetails ON units.unitId = purchasedetails.wholesaleUnitId
      INNER JOIN  products ON products.productId = purchasedetails.productId
      where purchaseId = ?");
      $query->execute([$purchaseId]);
      return $query->fetchAll();
    }catch(Exception $e){
      echo $e->getMessage();
    }
 
    
  }
}
