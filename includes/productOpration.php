<?php
session_start();
include '../controller/productController.php';
// add product
if(isset($_POST['productSubmit'])){
   $productName=$_POST['name'];
   $categoryId=$_POST['categoryId'];
   $payPrice=$_POST['pay'];
   $salePrice=$_POST['sale'];
   $supplierId=$_POST['supplierId'];
   $endDate=$_POST['endDate'];
   $details=$_POST['details'];
   $qty=$_POST['quantity'];
   $barcode=($_POST['barcode']==null)?uniqid():$_POST['barcode'];
   if ($_FILES["image"]["error"] == UPLOAD_ERR_OK){
      $folder = "../view/include/images/";
      if(!file_exists($folder))mkdir($folder);
      $temp = explode(".",$_FILES["image"]["name"]);
      $tempName = $_FILES["image"]["tmp_name"];
      $newFileName = round(microtime(true)) . '.'. end($temp);
      move_uploaded_file($tempName, $folder.$newFileName);
  }
   $product = new productController();
   if($product->productAdd($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$newFileName)){
    $_SESSION['flush'] =  'Product created successfully';
    header("location: ../view/products/addProduct.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/products/addProduct.php");
      exit;
   }
}

   //delete product
 
   if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sup = new productController();
   if( $sup->deleteProduct($id)){
   $_SESSION['flush'] = 'product deleted successfully';
    header("location: ../view/products/products.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/products/products.php");
      exit;
   }
}
   // update product
if(isset($_POST['updateProduct'])){
   $productName=$_POST['name'];
   $productId=$_POST['productId'];
   $categoryId=$_POST['categoryId'];
   $payPrice=$_POST['pay'];
   $salePrice=$_POST['sale'];
   $supplierId=$_POST['supplierId'];
   $endDate=$_POST['endDate'];
   $details=$_POST['details'];
   $qty=$_POST['quantity'];
   $barcode=$_POST['barcode'];
   $image=$_POST['oldImage'];
      if(isset($_FILES["image"]["name"])){
         unlink("../include/images/$image");
   if ($_FILES["image"]["error"] == UPLOAD_ERR_OK){
      $folder = "../view/include/images/";
      if(!file_exists($folder))mkdir($folder);
      $temp = explode(".",$_FILES["image"]["name"]);
      $tempName = $_FILES["image"]["tmp_name"];
      $newFileName = round(microtime(true)) . '.'. end($temp);
      move_uploaded_file($tempName, $folder.$newFileName);
      $image = $newFileName;
  }
}
   $sup = new productController();
   if($sup->edit($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$image,$productId)){
    $_SESSION['flush'] =  'Suppliers updated successfully';
   header("location: ../view/products/products.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/products/products.php");
      exit;
   }
}