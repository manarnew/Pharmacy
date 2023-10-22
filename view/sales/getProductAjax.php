<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/sale.php';
if (isset($_GET['query'])) {
    $sale = new Sale();
    $sales =  $sale->index($_GET['query']);
}
?>

<option></option>
<?php foreach ($sales as $row) : ?>
    <option value="<?php echo $row['batchId'] ?>">
        <?php echo $row['productName'] ?>&nbsp; &nbsp;&nbsp;
        Expiration date: <?php echo $row['expirationDate'] ?>
        Price: <?php ($row['hasChildUnit'] == 1) ? print $row['RetailSalePrice'] : print $row['WholesaleSalePrice']; ?>
    </option>
<?php endforeach; ?>
