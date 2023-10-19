<?php

include '/xampp/htdocs/pharmacyapp/database/connection.php';
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

      $accounting = 'INSERT INTO accounting (AccountName,debit) VALUE (?,?)';
      $accounting =  $this->dbConnction()->prepare($accounting);
      $accounting->execute(['Account pay for suppliers', $payPrice]);

      return true;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }
}
