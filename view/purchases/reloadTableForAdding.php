<?php include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/purchase.php';
$pur = new Purchase();
$getDetails = $pur->getPurchaseDetail($_GET['id']);
?>
<?php foreach ($getDetails as $row) :  ?>
    <tr>
        <td><?php echo $row['productName']; ?></td>
        <td><?php echo $row['unitName']; ?></td>
        <td><?php echo $row['WholesaleQty']; ?></td>
        <td><?php echo $row['WholesalePayPrice']; ?></td>
        <td><?php echo ($row['WholesalePayPrice'] * $row['WholesaleQty']); ?></td>
        <td>
            <button class="btn btn-danger" onclick="deleteMedicine(<?php echo $row['purchaseDetailId'] ?>)"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
<?php endforeach; ?>