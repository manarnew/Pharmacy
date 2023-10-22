<?php
session_start();
include '../controller/supplierController.php';
// add suppliers
if(isset($_POST['addSupplier'])){
   $name=$_POST['name'];
   $phone=$_POST['phone'];
   $address=$_POST['address'];
   $cat = new supplierController();
   if($cat->supplierAdd($name,$phone,$address)){
    $_SESSION['flush'] =  'Suppliers created successfully';
    header("location: ../view/suppliers/suppliers.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/suppliers/suppliers.php");
      exit;
   }
}

   //delete suppliers
 
   if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sup = new supplierController();
   if( $sup->deleteSuppliers($id)){
   $_SESSION['flush'] = 'Suppliers deleted successfully';
    header("location: ../view/suppliers/suppliers.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/suppliers/suppliers.php");
      exit;
   }
}
   // update suppliers
if(isset($_POST['updateSup'],$_POST['name'],$_POST['phone'],$_POST['address'],$_POST['supplierId'])){
   $name=$_POST['name'];
   $phone=$_POST['phone'];
   $address=$_POST['address'];
   $id=$_POST['supplierId'];
   $sup = new supplierController();
   if($sup->edit($name,$phone,$address,$id)){
    $_SESSION['flush'] =  'Suppliers updated successfully';
   header("location: ../view/suppliers/suppliers.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/suppliers/suppliers.php");
      exit;
   }
}

if(isset($_POST['PayForSupplier'])){
   $id=$_POST['supplierId'];
   $remained=$_POST['remained'];
   $payPrice=$_POST['payPrice'];
   $sup = new supplierController();
   $sup =$sup->payForSupplier($id,$remained,$payPrice);
  if($sup ===true ){
  $_SESSION['flush'] = 'Payment completed successfully '; 
  header("location: ../view/suppliers/details.php?supplierId=$id");
  exit;
  }else{
   $_SESSION['flush'] = "Error  $sup";
   header("location: ../view/suppliers/details.php?supplierId=$id");
  }
}

if(isset($_POST['ReceiveForSupplier'])){
   $id=$_POST['supplierId'];
   $receivedPrice=$_POST['receivedPrice'];
   $remainedReceive=$_POST['remainedReceive'];
   $sup = new supplierController();
   $sup =$sup->receivedForSupplier($id,$remainedReceive,$receivedPrice);
  if($sup ===true ){
  $_SESSION['flush'] = 'Payment completed successfully '; 
  header("location: ../view/suppliers/details.php?supplierId=$id");
  exit;
  }else{
   $_SESSION['flush'] = "Error  $sup";
   header("location: ../view/suppliers/details.php?supplierId=$id");
  }
}