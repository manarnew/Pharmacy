<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/database/connection.php';
class Dashboard extends connection
{

  public function monthlySales()
  {
    $query = $this->dbConnction()->prepare("SELECT MONTH(date) AS monthly,SUM(totalQty) AS qty   
      FROM sales  GROUP BY MONTH(date)");
    $query->execute();
    return $query->fetchAll();
  }

  public function expenses()
  {
    $query = $this->dbConnction()->prepare("SELECT SUM(expensePrice) as totalExpenses FROM expenses GROUP BY 
    YEAR(date)");
    $query->execute();
    return $query->fetchAll();
  }

  public function revenue()
  {
    $query = $this->dbConnction()->prepare("SELECT SUM(TotalPrice) as totalSales FROM sales WHERE type =1 GROUP BY 
    YEAR(date)");
    $query->execute();
    return $query->fetchAll();
  }
  public function returnSales()
  {
    $query = $this->dbConnction()->prepare("SELECT SUM(TotalPrice) as totalSales FROM sales WHERE type =0 GROUP BY 
    YEAR(date)");
    $query->execute();
    return $query->fetchAll();
  }
  public function purchases()
  {
    $query = $this->dbConnction()->prepare("SELECT SUM(tax+costOnPay+paid+Remained) as totalPurchases FROM purchases 
    WHERE approved = 1 AND type = 1  GROUP BY  YEAR(addedDate)");
    $query->execute();
    return $query->fetchAll();
  }
  public function purchasesReturn()
  {
    $query = $this->dbConnction()->prepare("SELECT SUM(tax+costOnPay+paid+Remained) as totalPurchases FROM purchases 
    WHERE approved = 1 AND type = 0  GROUP BY  YEAR(addedDate)");
    $query->execute();
    return $query->fetchAll();
  }
  public function profit()
  {
    $payPrice  = 0;
    $arrPaytotal = [];
    $month = '';
    $calculateAllProductFromMonth = 0;
    $salesdetails = $this->dbConnction()->prepare("SELECT batchNumber,productId,MONTH(date) as monthly,SUM(qty) as totalQty
    ,SUM(salePrice) as totalPrice FROM salesdetails WHERE batchNumber != ''
    GROUP BY productId, MONTH(date) ORDER BY MONTH(date)");
    $salesdetails->execute();
    $batchNumber = $salesdetails->fetchAll();
    foreach ($batchNumber as $batchNumber) {
      $salesdetails = $this->dbConnction()->prepare("SELECT hasChildUnit,RetailPayPrice,WholesalePayPrice 
    FROM purchasedetails WHERE madeAt > 0 AND batchNumber=? AND productId=? ");
      $salesdetails->execute([$batchNumber['batchNumber'], $batchNumber['productId']]);
      $salesdetails = $salesdetails->fetch();
      if ($salesdetails['hasChildUnit'] == 1) {
        $payPrice = $salesdetails['RetailPayPrice'] * $batchNumber['totalQty'];
      } else {
        $payPrice  = $salesdetails['WholesalePayPrice'] * $batchNumber['totalQty'];
      }
      if ($month == $batchNumber['monthly']) {
        $arrPaytotal[$batchNumber['monthly']] = $calculateAllProductFromMonth+= ($batchNumber['totalQty'] * $batchNumber['totalPrice']) - $payPrice;
      } else {
        $arrPaytotal[$batchNumber['monthly']] = ($batchNumber['totalQty'] * $batchNumber['totalPrice']) - $payPrice;
        $calculateAllProductFromMonth = ($batchNumber['totalQty'] * $batchNumber['totalPrice']) - $payPrice;
      }
      $month = $batchNumber['monthly'];
    }
    return $arrPaytotal;
  }

  public function monthlyExpenses()
  {
    $query = $this->dbConnction()->prepare("SELECT MONTH(date) as monthly,SUM(expensePrice) as totalExpenses FROM expenses GROUP BY 
    Month(date)");
    $query->execute();
    $monthly = [];
    foreach($query->fetchAll() as $month){
       $monthly[$month['monthly']]=$month['totalExpenses'];
    }
    return $monthly;
  }
  public function users()
  {
    $query = $this->dbConnction()->prepare("SELECT userId FROM users");
    $query->execute();
    
    return $query->fetchAll();
  }
  public function suppliers()
  {
    $query = $this->dbConnction()->prepare("SELECT supplierId FROM suppliers");
    $query->execute();
    
    return $query->fetchAll();
  }
  public function numberOfSales()
  {
    $query = $this->dbConnction()->prepare("SELECT saleId FROM sales where type = 1");
    $query->execute();
    
    return $query->fetchAll();
  }
  public function qtyAvailbaleProduct()
  {
    $query = $this->dbConnction()->prepare("SELECT SUM(qty) as qtyCount FROM batches");
    $query->execute();
    
    return $query->fetch();
  }
}
