<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/sale.php';
if (isset($_GET['invoiceNumber'])) {
   $sale = new Sale();
   $sales = $sale->showSalesDetailFromAjax($_GET['invoiceNumber']);
}
?>
<?php foreach($sales as $row):?>
<tr>
    <td><?php echo $row['productName']; ?></td>
    <td><?php echo  $row['qty'] ;?></td>
    <td><?php echo $row['salePrice']; ?></td>
    <td><?php echo $row['qty']*$row['salePrice']; ?></td>
    <td>
        <button type="submit" id="delete" name="delete" class="btn btn-danger">Delete</button>
    </td>
</tr>
<?php endforeach;?>