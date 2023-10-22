<?php
include '../model/sale.php';
class SaleController extends Sale
{
    public function addSale( $productId, $qty, $total, $salePrice, $invoiceNumber, $barcode)
    {
        $add =  $this->add( $productId, $qty, $total, $salePrice, $invoiceNumber, $barcode);
        if ($add === true) {
            return true;
        } else {
            return $add;
        }
    }
}
