<?php
include '/xampp/htdocs/pharmacyapp/model/returnPurchase.php';
if(isset($_GET['supplierId'])){
   $id=$_GET['supplierId'];
   $purchase = new ReturnPurchase();
   foreach($purchase->goeInvoicesNumber($id) as $pur){ ?>
     <option value="<?php echo $pur["invoiceNumber"]?>"><?php echo $pur["invoiceNumber"]?></option>
   <?php };?>
<?php }?>