<?php
session_start();
include '../controller/saleReturnController.php';
if (isset($_POST['query'])) {
    $sale = new SaleReturnController();
    $get = $sale->fetchProductDetails($_POST['query']);
    if ($get) {
        echo  json_encode($get);
    }
}

if (isset($_POST['expiationDate'])) {
    $expiationDate=$_POST['expiationDate'];
    $qty=$_POST['qty'];
    $productId=$_POST['productId'];
    $total=$_POST['total'];
    $SalePrice=$_POST['SalePrice'];
    $invoiceNumber=$_POST['invoiceNumber'];
    $barcode=$_POST['barcode'];
    $sale = new SaleReturnController();
    $get = $sale->addSale($productId,$qty,$total,$SalePrice,$invoiceNumber,$barcode,$expiationDate);
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
    $sale = new SaleReturnController();
    $get = $sale->delete($productId,$invoiceNumber,$totalPrice,$qty);
    if ($get === true) {
        echo 'Medicine Deleted successfully';
    } else {
        echo $get;
    }
    
}

if (isset($_POST['invoiceNumberForSaveAndPrint'])) {
    $invoiceNumber=$_POST['invoiceNumberForSaveAndPrint'];
    $sale = new SaleReturnController();
    $get = $sale->SaveAndPrint($invoiceNumber);
    if ($get === true) {
        echo 'Medicine Deleted successfully';
    } else {
        echo $get;
    }
    
}
if (isset($_POST['invoiceNumberForCancel'])) {
    $invoiceNumber=$_POST['invoiceNumberForCancel'];
    $sale = new SaleReturnController();
    $get = $sale->cancel($invoiceNumber);
    if ($get === true) {
        echo 'Medicine Deleted successfully';
    } else {
        echo $get;
    }
    
}
