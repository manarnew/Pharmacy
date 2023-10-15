<?php
include '../model/product.php';
class productController extends Product{
    public function productAdd($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$filename){
        if($productName==null||$categoryId==null||$payPrice==null||$salePrice==null||$endDate==null||$supplierId==null||$details==null||$qty==null||$barcode==null||$filename==null){
            $_SESSION['flush'] = 'All the filed are required except the barcode';
            header("location: ../view/products/addProduct.php");
            exit;
        }
      
       if($this->add($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$filename)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/products/addProduct.php");
        exit;
       }
    }
    public function deleteProduct($id){
        if($this->delete($id)){
            return true;
           }else{
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/products/products.php");
           }
    }

    public function edit($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$image,$productId){
      
      
       if($this->update($productName,$categoryId,$payPrice,$salePrice,$endDate,$supplierId,$details,$qty,$barcode,$image,$productId)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/products/editProduct.php");
       }
    }
}