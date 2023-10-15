<?php
include '../model/supplier.php';
class supplierController extends Supplier{
    public function supplierAdd($supplierName,$phone,$address){
        if($supplierName== ''||$phone== ''||$address == ''){
            $_SESSION['flush'] = 'check the input all the filed are required';
            header("location: ../view/suppliers/suppliers.php");
            exit;
        }
       if($this->add($supplierName,$phone,$address)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/suppliers/suppliers.php");
       }
    }
    public function deleteSuppliers($id){
        if($this->delete($id)){
            return true;
           }else{
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/suppliers/suppliers.php");
           }
    }

    public function edit($supplierName,$phone,$address,$id){
        if($supplierName== ''||$phone== ''||$address== ''||$id == ''){
            $_SESSION['flush'] = 'check the input all the filed are required';
            header("location: ../view/suppliers/suppliers.php");
            exit;
        }
       if($this->update($supplierName,$phone,$address,$id)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/suppliers/suppliers.php");
       }
    }
}