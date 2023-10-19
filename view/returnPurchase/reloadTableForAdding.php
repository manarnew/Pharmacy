<?php include '/xampp/htdocs/pharmacyapp/model/purchase.php';
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
            <button class="btn btn-danger btn-sm" onclick="deleteMedicine(<?php echo $row['purchaseDetailId'] ?>)">Delete</button>
        </td>
    </tr>
<?php endforeach; ?>