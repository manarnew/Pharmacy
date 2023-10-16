<?php
include '../model/Purchase.php';
class purchaseController extends Purchase{
    public function purchaseAdd($supplierId,$details,$invoiceNumber){
        if($supplierId == null||$invoiceNumber== null){
          
           
           $_SESSION['flush'] = 'All the filed are required';
           header("location: ../view/purchases/purchases.php");
           exit;
       }
       if($this->add($supplierId,$details,$invoiceNumber)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/purchases/purchases.php");
        exit;
       }
    }
    public function purchaseDetailsAdd($purchaseId,$productId,$endDate,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice
    ,$WholesaleSalePrice,$hasChildUnit,$RetailUnitId,$RetailSalePrice,$RetailPayPrice,$RetailQty,$TotalRetailQty,$batchNumber){
     $check =$this->purchaseDetailsInvoice($purchaseId,$productId,$endDate,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice
     ,$WholesaleSalePrice,$hasChildUnit,$RetailUnitId,$RetailSalePrice,$RetailPayPrice,$RetailQty,$TotalRetailQty,$batchNumber);
        if($check === true){
        return true;
       }else if($check === -1){
        return -1;
       }
       else{
        return false;
       }
    }
    public function deleteMedicine($id){
        if($this->delete($id)){
            return true;
           }else{
            echo 'Something went wrong';
           }
    }

    public function edit($invoiceNumber,$details,$supplierId,$purchaseId,$Remained,$tax,$paid,$costOnPay){
        if($invoiceNumber==''||$supplierId==''||$purchaseId==''){
            $_SESSION['flush'] = 'All the filed are required';
            header("location: ../view/products/details.php?id=$purchaseId");
            exit;
        }
       if($this->update($invoiceNumber,$details,$supplierId,$purchaseId,$Remained,$tax,$paid,$costOnPay)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/products/details.php?id=$purchaseId");
       }
    }

    public function addAccounting($paid,$tax,$Remained,$costOnPay,$purchaseId){
       if($this->addAccount($paid,$tax,$Remained,$costOnPay,$purchaseId)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/products/details.php?id=$purchaseId");
       }
    }


}