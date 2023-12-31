<?php
session_start();
include '../controller/saleController.php';
if (isset($_POST['query'])) {
    $sale = new SaleController();
    $get = $sale->fetchProductDetails($_POST['query']);
    if ($get) {
        $salePrice = 0;
        echo  json_encode($get);
    }
}

if (isset($_POST['batchNumber'])) {
    $batchNumber=$_POST['batchNumber'];
    $qty=$_POST['qty'];
    $productId=$_POST['product'];
    $total=$_POST['total'];
    $SalePrice=$_POST['SalePrice'];
    $invoiceNumber=$_POST['invoiceNumber'];
    $barcode=$_POST['barcode'];
    $sale = new SaleController();
    $get = $sale->addSale($productId,$qty,$total,$SalePrice,$invoiceNumber,$barcode,$batchNumber);
    if ($get === true) {
        echo 'Medicine add successfully';
    } else {
        echo $get;
    }
    
}

if (isset($_POST['medicineIDForDelete'])) {
    $invoiceNumber=$_POST['invoiceNumber'];
    $productId=$_POST['medicineIDForDelete'];
    $totalPrice=$_POST['totalPrice'];
    $qty=$_POST['qty'];
    $sale = new SaleController();
    $get = $sale->delete($productId,$invoiceNumber,$totalPrice,$qty);
    if ($get === true) {
        echo 'Medicine Deleted successfully';
    } else {
        echo $get;
    }
    
}

if (isset($_POST['invoiceNumberForSaveAndPrint'])) {
    $invoiceNumber=$_POST['invoiceNumberForSaveAndPrint'];
    $sale = new SaleController();
    $get = $sale->SaveAndPrint($invoiceNumber);
    if ($get === true) {
        echo 'Medicine Deleted successfully';
    } else {
        echo $get;
    }
    
}
if (isset($_POST['invoiceNumberForCancel'])) {
    $invoiceNumber=$_POST['invoiceNumberForCancel'];
    $sale = new SaleController();
    $get = $sale->cancel($invoiceNumber);
    if ($get === true) {
        echo 'Medicine Deleted successfully';
    } else {
        echo $get;
    }
    
}
