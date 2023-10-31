<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/expenses.php';
if (isset($_GET['startDate'])) {
  $Expenses =  new Expenses();
  $startDate = $_GET['startDate'];
  $endDate = $_GET['endDate'];
  $Expense = $Expenses->dateSearch($startDate, $endDate);
}
?>
<thead>
  <tr>
    <th>serial</th>
    <th>Note</th>
    <th>Price</th>
    <th>Date</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php $totalPrice = $i = 0;
  foreach ($Expense as $row) :  ?>
    <tr>
      <td><?php $i++;
          echo $i; ?></td>
      <td>
        <?php echo $row['expenseNote']; ?>
        </a>
      </td>
      <td><?php echo $row['expensePrice'];
          $totalPrice += $row['expensePrice']; ?></td>
      <td><?php echo $row['date']; ?></td>
      <td>
        <a href="../../includes/expenseOpration.php?id=<?php echo $row['expenseId']; ?>" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-Edit">
          Edit
        </button>
        <?php include 'editModal.php'; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>
<tr>
  <td style="color: red;">Total Price</td>
  <td></td>
  <td style="color: red;"><?php echo $totalPrice; ?></td>
</tr>