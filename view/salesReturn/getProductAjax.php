<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/saleReturn.php';
if (isset($_GET['query'])) {
    $sale = new SaleReturn();
    $sales =  $sale->index($_GET['query']);
}
?>

<option></option>
<?php foreach ($sales as $row) : ?>
    <option value="<?php echo $row['productId'] ?>">
        <?php echo $row['productName'] ?>
    </option>
<?php endforeach; ?>
