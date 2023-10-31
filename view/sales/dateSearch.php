<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/sale.php';
if (isset($_GET['startDate'])) {
  $showSale = new Sale();
  $startDate = $_GET['startDate'];
  $endDate = $_GET['endDate'];
  $Sale = $showSale->dateSearch($startDate, $endDate);
}
?>
<thead>
  <tr>
    <th>serial</th>
    <th>Invoice number</th>
    <th>Total price</th>
    <th>Total quantity</th>
    <th>Added date</th>
    <th>Added by</th>
  </tr>
</thead>
<tbody>
  <?php $totalPrice = $i = 0;
  foreach ($Sale as $row) :
    $totalPrice += $row['totalQty'] * $row['TotalPrice'];
  ?>
    <tr>
      <td><?php $i++;
          echo $i; ?></td>
      <td>
        <a href="showSaleDetails.php?invoiceNumber=<?php echo $row['invoiceNumber'] ?>">
          <?php echo $row['invoiceNumber']; ?>
        </a>
      </td>
      <td><?php echo $row['TotalPrice']; ?></td>
      <td><?php echo $row['totalQty']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td><?php echo $row['userName']; ?></td>
    </tr>
  <?php endforeach; ?>
</tbody>
<tr><td style="color: red;">Total Price</td><td></td><td style="color: red;"><?php echo $totalPrice; ?></td></tr>
           