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

  public function dateSearch($startDate,$endDate)
  {
    if (empty($endDate)) $endDate = date("Y/m/d");
    $temp = '';
   if($startDate > $endDate){
    $temp = $startDate;
    $startDate = $endDate;
    $endDate = $temp;
   }
    $query = $this->dbConnction()->prepare("SELECT * FROM accounting WHERE  date BETWEEN ? AND  ? ORDER BY accountId DESC");
    $query->execute([$startDate,$endDate]);
    return $query->fetchAll();
  }
}
