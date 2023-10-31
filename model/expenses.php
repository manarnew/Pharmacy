<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class Expenses extends connection
{
  public function add($note, $price)
  {
    $now = date("Y/m/d");
    $query = 'INSERT INTO expenses (expenseNote,expensePrice,date) VALUE (?,?,?)';

    $query =  $this->dbConnction()->prepare($query);

    $query->execute([$note, $price, $now]);

    $expenses = $this->dbConnction()->prepare("SELECT expenseId  FROM expenses ORDER BY `expenses`.`expenseId` DESC LIMIT 1");
    $expenses->execute();
    $expensesId = $expenses->fetch();

    $accounting = 'INSERT INTO accounting (AccountName,debit,date,expenseId) VALUE (?,?,?,?)';

    $accounting =  $this->dbConnction()->prepare($accounting);

    $accounting->execute(['Account expense', $price, $now,$expensesId['expenseId']]);


    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }

  public function index()
  {
    $query = $this->dbConnction()->prepare("SELECT *  FROM expenses ORDER BY `expenses`.`expenseId` DESC");
    $query->execute();
    return $query->fetchAll();
  }

  public function delete($id)
  {
    $query = 'DELETE FROM expenses WHERE expenseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);

    $accounting = 'DELETE FROM accounting WHERE expenseId=?';
    $accounting = $this->dbConnction()->prepare($accounting);
    $accounting->execute([$id]);
    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
  }
  public function getOneExpe($id)
  {
    $query = 'SELECT * FROM expenses WHERE expenseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetch();
  }

  public function update($expenseId, $note, $price)
  {
    $now = date("Y/m/d");
    $query = 'UPDATE expenses SET expensePrice = ?,expenseNote = ?,date = ?WHERE expenseId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$price, $note, $now, $expenseId]);

    $accounting = 'UPDATE accounting SET debit = ?,date = ?WHERE expenseId=?';
    $accounting = $this->dbConnction()->prepare($accounting);
    $accounting->execute([$price, $now, $expenseId]);

    if ($query->rowCount()) {
      return true;
    } else {
      return false;
    }
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
    $query = $this->dbConnction()->prepare("SELECT * FROM expenses WHERE  date BETWEEN ? AND  ? ORDER BY expenseId DESC");
    $query->execute([$startDate,$endDate]);
    return $query->fetchAll();
  }
}
