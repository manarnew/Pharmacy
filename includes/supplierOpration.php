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