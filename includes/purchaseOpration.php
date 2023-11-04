<?php
session_start();
include '../controller/purchaseController.php';

// add purchase
if(isset($_POST['productSubmit'])){
   $purchase = new purchaseController();
   $supplierId=$_POST['supplierId'];
   $details=$_POST['details'];
   // if the invoice number is null well generate random number
   $invoiceNumber=($_POST['invoiceNumber']==null)?('#'.$purchase->invoiceNum()):$_POST['invoiceNumber'];
   if($purchase->purchaseAdd($supplierId,$details,$invoiceNumber)){
    $_SESSION['flush'] =  'Purchase created successfully';
    header("location: ../view/purchases/purchases.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/purchases/add.php");
      exit;
   }
}
// add pay invoice details
if(isset($_POST['wholesaleUnitId'])){
   $purchase = new purchaseController();
   $purchaseId = $_POST['purchaseId'];
   $productId=$_POST['productId'];
   $endDate=$_POST['endDate'];
   $madeAt=$_POST['madeAt'];
    $wholesaleUnitId =$_POST['wholesaleUnitId'];
    $WholesaleQty =$_POST['WholesaleQty'];
    $WholesalePayPrice =$_POST['WholesalePayPrice'];
    $WholesaleSalePrice =$_POST['WholesaleSalePrice'];
    $hasChildUnit =$_POST['hasChildUnit'];
    $RetailUnitId =$_POST['RetailUnitId'];
    $RetailSalePrice =$_POST['RetailSalePrice'];
    $RetailQty =$_POST['RetailQty'];
    $RetailPayPrice =$_POST['RetailPayPrice'];
    $TotalRetailQty =$_POST['TotalRetailQty'];
   $batchNumber=($_POST['batchNumber']==null)?('#BH'.$purchase->invoiceNum()):$_POST['batchNumber'];
   $purchase = new purchaseController();
   $check = $purchase->purchaseDetailsAdd($purchaseId,$productId,$endDate,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice
   ,$WholesaleSalePrice,$hasChildUnit,$RetailUnitId,$RetailSalePrice,$RetailPayPrice,$RetailQty,$TotalRetailQty,$batchNumber,$madeAt);
   if($check === -1){
      echo 'the medicine already added';
   }else if($check === 0){
      echo 'the batch number already exist change it or let it empty';
   }else if($check === true){
      echo 'Medicine created successfully';
   }
   else{
      echo 'something went wrong';
   }
}

   // delete medicine form purchase details
 
   if(isset($_POST['medicineIDForDelete'])){
    $id=$_POST['medicineIDForDelete'];
    $med = new purchaseController();
   if( $med->deleteMedicine($id)){
   echo 'Medicine deleted successfully';
   }else{
      echo 'Error something wrong try agin';
   }
}
   // update product
if(isset($_POST['updateInvoice'])){
   $purchaseId=$_POST['purchaseId'];
   $invoiceNumber=$_POST['invoiceNumber'];
   $supplierId=$_POST['supplierId'];
   $details=$_POST['details'];
   $Remained=$_POST['Remained'];
   $tax=$_POST['tax'];
   $paid=$_POST['paid'];
   $costOnPay=$_POST['costOnPay'];
   $purchase = new purchaseController();
   if($purchase->edit($invoiceNumber,$details,$supplierId,$purchaseId,$Remained,$tax,$paid,$costOnPay)){
    $_SESSION['flush'] =  'Purchase updated successfully';
   header("location: ../view/purchases/details.php?id=$purchaseId");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/purchases/details.php?id=$purchaseId");
      exit;
   }
}


if (isset($_POST['query'])) {
   $product=$_POST['query'];
   $pur = new purchaseController();
   $get = $pur->goeProductForAddMedicine($product);
   $RetailUnitName = $pur->RetailUnitName($product);
   if ($get['productId']>0) {
        
      $detail[] = array('hasChildUnit'=>$get['hasChildUnit'],'productId'=>$get['productId'],'wholesaleUnitName'=>$get['unitName'],
      'wholesaleUnitId'=>$get['unitId'],'RetailUnitName'=>$RetailUnitName['unitName'],'RetailUnitId'=>$RetailUnitName['RetailUnitId']);
      echo  json_encode($detail);
   } else {
      $detail[] = array('warning'=>"Medicine not found");
     echo  json_encode($detail);
   }
 }

 // Add the accounting 

 if(isset($_POST['addAccounting'])){
   $paid=$_POST['paid'];
   $tax=$_POST['tax'];
   $Remained=$_POST['Remained'];
   $costOnPay=$_POST['costOnPay'];
   $purchaseId=$_POST['purchaseId'];
   $purchase = new purchaseController();
   if($purchase->addAccounting($paid,$tax,$Remained,$costOnPay,$purchaseId)){
    $_SESSION['flush'] =  'Accounting updated successfully';
   header("location: ../view/purchases/details.php?id=$purchaseId");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/purchases/details.php?id=$purchaseId");
      exit;
   }
 }

 if(isset($_GET['approveId'])){
   $app = new purchaseController();
   $approve = $app->approved($_GET['approveId']);
   if($approve === true){
      $_SESSION['flush'] =  'Purchase approved successfully';
      header("location: ../view/purchases/purchases.php");
      exit;
   }else{
      $_SESSION['flush'] =  'Error '.$approve;
      header("location: ../view/purchases/purchases.php");
      exit;
   }
   
 }

  // delete Purchase
 
  if(isset($_GET['deletePurchaseId'])){
   $id=$_GET['deletePurchaseId'];
   $med = new purchaseController();
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