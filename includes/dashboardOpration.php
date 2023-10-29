<?php
session_start();
include '../model/dashboard.php';

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
