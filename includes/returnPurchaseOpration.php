<?php
session_start();
include '../controller/returnPurchaseController.php';

// add purchase
if(isset($_POST['productSubmit'])){
   $purchase = new ReturnPurchaseController();
   $supplierId=$_POST['supplierId'];
   $details=$_POST['details'];
   // if the invoice number is null well generate random number
   $invoiceNumber=($_POST['invoiceNumber']==null)?('#'.$purchase->invoiceNum()):$_POST['invoiceNumber'];
   if($purchase->purchaseAdd($supplierId,$details,$invoiceNumber)){
    $_SESSION['flush'] =  'Return purchase created successfully';
    header("location: ../view/returnPurchase/purchases.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/returnPurchase/add.php");
      exit;
   }
}
// add pay invoice details
if(isset($_POST['wholesaleUnitId'])){
   $batchNumber = $_POST['batchNumber'];
   $purchaseId = $_POST['purchaseId'];
   $hasChildUnit = $_POST['hasChildUnit'];
   $RetailQty = $_POST['RetailQty'];
   $productId=$_POST['productId'];
    $wholesaleUnitId =$_POST['wholesaleUnitId'];
    $WholesaleQty =$_POST['WholesaleQty'];
    $WholesalePayPrice =$_POST['WholesalePayPrice'];
    $purchase = new ReturnPurchaseController();
   $check = $purchase->purchaseDetailsReturn($purchaseId,$productId,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice,$RetailQty,$hasChildUnit,$batchNumber);
   if($check === -1){
      echo 'the medicine already added';
   }else if($check === true){
      echo 'Return done successfully';
   }else{
      echo 'something went wrong';
   }
}

   // delete medicine form purchase details
 
   if(isset($_POST['medicineIDForDelete'])){
    $id=$_POST['medicineIDForDelete'];
    $med = new ReturnPurchaseController();
   if( $med->deleteMedicine($id)){
   echo 'Medicine deleted successfully';
   }else{
      echo 'Error something wrong try agin';
   }
}
   // update product
if(isset($_POST['updateInvoice'])){
   $purchaseId=$_POST['purchaseId'];
   $details=$_POST['details'];
   $Remained=$_POST['Remained'];
   $paid=$_POST['paid'];
   $purchase = new ReturnPurchaseController();
   if($purchase->edit($details,$purchaseId,$Remained,$paid)){
    $_SESSION['flush'] =  'Return Purchase updated successfully';
   header("location: ../view/returnPurchase/details.php?id=$purchaseId");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/returnPurchase/details.php?id=$purchaseId");
      exit;
   }
}


if (isset($_POST['query'])) {
   $product=$_POST['query'];
   $invoiceNumber=$_POST['invoiceNumber'];
   $pur = new ReturnPurchaseController();
   $get = $pur->goeProductForAddMedicine($product);
   $WholesalePayPrice = $pur->WholesalePayPrice($product,$invoiceNumber);
   if ($get['productId']>0) {
        
      $detail[] = array('hasChildUnit'=>$get['hasChildUnit'],'RetailQty'=>$WholesalePayPrice['RetailQty'],'productId'=>$get['productId'],'wholesaleUnitName'=>$get['unitName'],
      'wholesaleUnitId'=>$get['unitId'],'WholesalePayPrice'=>$WholesalePayPrice['WholesalePayPrice'],'batchNumber'=>$WholesalePayPrice['batchNumber']);
      echo  json_encode($detail);
   } else {
      $detail[] = array('warning'=>"Medicine not found");
     echo  json_encode($detail);
   }
 }

 // Add the accounting for received money

 if(isset($_POST['receivedAccounting'])){
   $paid=$_POST['ReceivedForReturn'];
   $Remained=$_POST['remainedForReturn'];
   $purchaseId=$_POST['purchaseId'];
   $purchase = new ReturnPurchaseController();
   if($purchase->ReveivedAccounting($paid,$Remained,$purchaseId)){
    $_SESSION['flush'] =  'Accounting updated successfully';
   header("location: ../view/returnPurchase/details.php?id=$purchaseId");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/returnPurchase/details.php?id=$purchaseId");
      exit;
   }
 }

 if(isset($_GET['approveId'])){
   $app = new ReturnPurchaseController();
   $approve = $app->approved($_GET['approveId']);
   if($approve === true){
      $_SESSION['flush'] =  'Purchase approved successfully';
      header("location: ../view/returnPurchase/purchases.php");
      exit;
   }else{
      $_SESSION['flush'] =  'Error '.$approve;
      header("location: ../view/returnPurchase/purchases.php");
      exit;
   }
   
 }

  // delete Purchase
 
  if(isset($_GET['deletePurchaseId'])){
   $id=$_GET['deletePurchaseId'];
   $med = new ReturnPurchaseController();
   $purh =$med->deletePurchase($id);
  if($purh ===true ){
  $_SESSION['flush'] = 'Purchase deleted successfully '; 
  header("location: ../view/purchases/purchases.php");
  exit;
  }else{
   $_SESSION['flush'] = "Error .$approve";
   header("location: ../view/purchases/purchases.php");
  }
}

