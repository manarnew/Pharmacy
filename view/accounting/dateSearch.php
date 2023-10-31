<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/accounting.php';
if(isset($_GET['startDate'])){
$Accounting = new Accounting();
$startDate=$_GET['startDate'];
$endDate=$_GET['endDate'];
$stores = $Accounting->dateSearch($startDate,$endDate);
}
?>
<thead style="color:white;">
                  <tr>
                   <th>serial</th>
                    <th>Account Name</th>
                    <th>debit</th>
                    <th>credit</th>
                    <th>Added date</th>
                  </tr>
                </thead>
                <tbody id="dateTable">
                  <?php $debitTotal=$creditTotal=$i = 0; foreach ($stores as $row) :  ?>
                    <?php if($row['debit']>0): ?> 
                     <tr style="background-color: azure;">
                     <?php elseif($row['credit']>0): ?>
                      <tr style="background-color:beige;">
                      <?php endif ?>
                      <td><?php $i++ ;echo $i  ;?></td>
                      <td><?php echo $row['AccountName']; ?></td>
                      <td><?php echo $row['debit'];$debitTotal+=$row['debit']; ?></td>
                      <td><?php echo $row['credit'];$creditTotal+=$row['credit'];?></td>
                      <td><?php echo $row['date']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
<tr><td style="color: red;">Total Price</td><td></td><td style="color: red;"><?php echo $creditTotal - $debitTotal ; ?></td></tr>
              