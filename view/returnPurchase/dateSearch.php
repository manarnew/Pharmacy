<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/returnPurchase.php';
if (isset($_GET['startDate'])) {
  $pur = new ReturnPurchase();
  $startDate = $_GET['startDate'];
  $endDate = $_GET['endDate'];
  $purchase = $pur->dateSearch($startDate, $endDate);
}
?>
<thead>
  <tr>
    <th>serial</th>
    <th>Invoice number</th>
    <th>Supplier</th>
    <th>Added date</th>
    <th>Added by</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php $i = 0;
  foreach ($purchase as $row) :  ?>
    <tr>
      <td><?php $i++;
          echo $i; ?></td>
      <td><?php echo $row['invoiceNumber']; ?></td>
      <td><?php echo $row['supplierName']; ?></td>
      <td><?php echo $row['addedDate']; ?></td>
      <td><?php echo $row['userName']; ?></td>
      <td>
        <a href="details.php?id=<?php echo $row['purchaseId']; ?>" class="btn btn-info">Purchase details</a>
        <?php if ($row['approved'] != 1) : ?>
          <a href="../../includes/purchaseOpration.php?deletePurchaseId=<?php echo $row['purchaseId']; ?>" class="btn btn-danger">Delete</a>
          <a href="../../includes/purchaseOpration.php?approveId=<?php echo $row['purchaseId']; ?>" class="btn btn-success">Approve</a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>