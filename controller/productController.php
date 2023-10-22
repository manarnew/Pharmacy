<?php
include '../model/product.php';
class productController extends Product{
    public function productAdd($productName,$categoryId,$details,$barcode,$newFileName,$wholesaleUnitId,$hasChildUnit,$RetailUnitId){
        if($productName==null||$categoryId==null||$barcode==null||$hasChildUnit==null||$wholesaleUnitId==null){
           $_SESSION['flush'] = 'All the filed are required';
           header("location: ../view/products/addProduct.php");
           exit;
       }
       if($hasChildUnit==1){
        if($RetailUnitId==null){
            $_SESSION['flush'] = 'All the filed are required';
            header("location: ../view/products/addProduct.php");
            exit;
        }
    }
       if($this->add($productName,$categoryId,$details,$barcode,$newFileName,$wholesaleUnitId,$hasChildUnit,$RetailUnitId)){
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

    public function edit($productName,$categoryId,$details,$barcode,$image,$wholesaleUnitId,$hasChildUnit,$RetailUnitId,$productId){
        if($productName==null||$categoryId==null||$barcode==null||$hasChildUnit==null||$wholesaleUnitId==null){
            $_SESSION['flush'] = 'All the filed are required';
            header("location: ../view/products/editProduct.php?productId=$productId");
            exit;
        }
        if($hasChildUnit==1){
         if($RetailUnitId==null){
             $_SESSION['flush'] = 'All the filed are required';
             header("location: ../view/products/editProduct.php?productId=$productId");
             exit;
         }
        }
       if($this->update($productName,$categoryId,$details,$barcode,$image,$wholesaleUnitId,$hasChildUnit,$RetailUnitId,$productId)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/products/editProduct.php?productId=$productId");
       }
    }
}