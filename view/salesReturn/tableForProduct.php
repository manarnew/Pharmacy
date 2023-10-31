<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/sale.php';
if (isset($_GET['invoiceNumber'])) {
   $sale = new Sale();
   $sales = $sale->showSalesDetailFrom($_GET['invoiceNumber']);
}
$totalPrice = 0;
?>
<?php foreach($sales as $row):?>
<tr>
    <td><?php echo $row['productName']; ?></td>
    <td><?php echo  $row['qty'] ;?></td>
    <td><?php echo $row['salePrice']; ?></td>
    <td><?php 
    echo $row['qty']*$row['salePrice'];
    $totalPrice +=$row['qty']*$row['salePrice'];
    ?></td>
    <td>
        <button type="submit" onclick="deleteMedicine('<?php echo $row['productId']; ?>'
        ,'<?php echo $row['invoiceNumber']; ?>','<?php echo $row['qty']*$row['salePrice']; ?>','<?php echo $row['qty']; ?>')" 
         class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
    </td>

</tr>
<?php endforeach;?>
<tr><td style="color: red;" colspan="3">Total Price</td><td style="color: red;" colspan="2"><?php echo $totalPrice; ?></td></tr>
