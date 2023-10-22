<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class Accounting extends connection
{
  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT * FROM accounting ORDER BY accountId DESC");
    $query->execute();
    return $query->fetchAll();
  }
}
