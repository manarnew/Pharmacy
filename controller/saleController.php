<?php
include '../model/sale.php';
class SaleController extends Sale
{
    public function addSale( $productId, $qty, $total, $salePrice, $invoiceNumber, $barcode,$batchNumber)
    {
        $add =  $this->add( $productId, $qty, $total, $salePrice, $invoiceNumber, $barcode,$batchNumber);
        if ($add === true) {
            return true;
        } else {
            return $add;
        }
    }
    public function delete($productId,$invoiceNumber,$totalPrice,$qty)
    {
        $deleteMedicine =  $this->deleteMedicine($productId,$invoiceNumber,$totalPrice,$qty);
        if ($deleteMedicine === true) {
            return true;
        } else {
            return $deleteMedicine;
        }
    }
    public function SaveAndPrint($invoiceNumber)
    {
        $SaveAndPrint =  $this->Save($invoiceNumber);
        if ($SaveAndPrint === true) {
            return true;
        } else {
            return $SaveAndPrint;
        }
    }
    public function cancel($invoiceNumber)
    {
        $SaveAndPrint =  $this->cancelInvoice($invoiceNumber);
        if ($SaveAndPrint === true) {
            return true;
        } else {
            return $SaveAndPrint;
        }
    }
}
