<?php

include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/database/connection.php';
class Supplier extends connection
{
  public function add($supplierName, $phone, $address)
  {
    $query = 'INSERT INTO suppliers (supplierName,phone,address) VALUE (?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([$supplierName, $phone, $address]);

    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM suppliers");
    $query->execute();
    return $query->fetchAll();
  }

  public function delete($id)
  {
    $check = $query = $this->dbConnction()->prepare("SELECT supplierId  FROM purchases where supplierId = ?
    LIMIT 1");
    $check->execute([$id]);
    $supplierId = $query->fetch();
    if($supplierId > 0){
      $_SESSION['flush'] = 'This supplier related with purchases can not be deleted';
      header("location: ../view/suppliers/suppliers.php");
      exit;
    }
    $query = 'DELETE FROM suppliers WHERE supplierId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }
  public function getOneSup($id)
  {
    $query = 'SELECT * FROM suppliers WHERE supplierId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetch();
  }

  public function update($supplierName, $phone, $address, $id)
  {
    $query = 'UPDATE suppliers SET supplierName = ?,phone = ?,address = ? WHERE supplierId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$supplierName, $phone, $address, $id]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function supplierAccounting()
  {
    $query = 'SELECT * FROM suppliers
              INNER JOIN supplieraccounting ON suppliers.supplierId = supplieraccounting.supplierId';
    $query = $this->dbConnction()->prepare($query);
    $query->execute();
    return $query->fetchAll();
  }
  public function supplierDetail($id)
  {
    $query = 'SELECT * FROM  supplieraccounting  WHERE supplierId = ?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetchAll();
  }
  public function paySupplier($id,$remained,$payPrice){
    try
    {
      $now = date("Y/m/d");
      $supplier = 'INSERT INTO supplieraccounting (supplierId,paid,remained,remainedBefor,date) VALUE (?,?,?,?,?)';
      $supplier =  $this->dbConnction()->prepare($supplier);
      $supplier->execute([$id,$payPrice, $remained, $remained,$now]);

      $accounting = 'INSERT INTO accounting (AccountName,debit,date) VALUE (?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account pay for suppliers', $payPrice,$now]);

      return true;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }
  public function receivedSupplier($id,$remainedReceive,$receivedPrice){
    try
    {
      $now = date("Y/m/d");
      $supplier = 'INSERT INTO supplieraccounting (supplierId,ReceivedForReturn,remainedForReturn,remainedBefor,date) VALUE (?,?,?,?,?)';
      $supplier =  $this->dbConnction()->prepare($supplier);
      $supplier->execute([$id,$receivedPrice, $remainedReceive, -$remainedReceive,$now]);

      $accounting = 'INSERT INTO accounting (AccountName,credit,,date) VALUE (?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account receive for suppliers', $receivedPrice,$now]);

      return true;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }
}
