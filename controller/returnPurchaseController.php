<?php
include '../model/returnPurchase.php';
class ReturnPurchaseController extends ReturnPurchase{
    public function purchaseAdd($supplierId,$details,$invoiceNumber){
        if($supplierId == null||$invoiceNumber== null){
          
           
           $_SESSION['flush'] = 'All the filed are required';
           header("location: ../view/returnPurchase/purchases.php");
           exit;
       }
       if($this->add($supplierId,$details,$invoiceNumber)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/returnPurchase/purchases.php");
        exit;
       }
    }
    public function purchaseDetailsReturn($purchaseId,$productId,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice,$RetailQty,$hasChildUnit,$batchNumber){
     $check =$this->purchaseDetailsReturnInvoice($purchaseId,$productId,$wholesaleUnitId,$WholesaleQty,$WholesalePayPrice,$RetailQty,$hasChildUnit,$batchNumber);
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
    public function deletePurchase($id){
        if($this->deletePurh($id)){
            return true;
           }else{
            return false;
           }
    }
    public function edit($details,$purchaseId,$Remained,$paid){
       if($this->update($details,$purchaseId,$Remained,$paid)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/returnPurchase/details.php?id=$purchaseId");
       }
    }

    public function ReveivedAccounting($paid,$Remained,$purchaseId){
       if($this->addAReveivedAccounting($paid,$Remained,$purchaseId)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/returnPurchase/details.php?id=$purchaseId");
       }
    }


}