<?php

include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/database/connection.php';
class Settings extends connection
{



  public function update($appName,$logo,$notifyDate,$qtyNumber,$address,$phone,$email)
  {
    $query = 'UPDATE settings SET appName = ?,logo = ?,notifyDate = ?,qtyNumber = ?,address = ?,phone = ?,email = ?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$appName,$logo,$notifyDate,$qtyNumber,$address,$phone,$email]);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }




  public function details()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM  settings LIMIT 1");
    $query->execute();
    return  $query->fetch();
  }
}