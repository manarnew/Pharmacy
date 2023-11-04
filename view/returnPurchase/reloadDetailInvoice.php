<?php
include  $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/purchase.php';
$pur = new Purchase();
$purchase = $pur->details($_GET['id']);
$getDetails = $pur->getPurchaseDetail($_GET['id']);
$countProduct = count($getDetails);
?>
   <table id="detailTable" class="table table-bordered table-hover">
                <tr>
                  <td class="width30">Invoice number</td>
                  <td class="width30"><?php echo $purchase['invoiceNumber'] ?> </td>
                </tr>
                <?php
                $totalUnit = 0;
                $totalPrice = 0;
                $countProduct = 0;
                foreach ($getDetails as $row) {
                  $countProduct++;
                  $totalUnit += $row['WholesaleQty'];
                  $totalPrice += ($row['WholesalePayPrice'] * $row['WholesaleQty']);
                }
                ?>
                <tr>
                  <td class="width30">Total quantity of product</td>
                  <td class="width30"><?php echo $countProduct ?> </td>
                </tr>
                <tr>
                  <td class="width30">Total number of unit quantity</td>
                  <td class="width30"><?php echo $totalUnit ?> </td>
                </tr>
                <tr>
                  <td class="width30">Total price</td>
                  <td class="width30"><?php echo $totalPrice ?> </td>
                </tr>
               
                <tr>
                  <td class="width30">Received</td>
                  <td class="width30"><?php echo $purchase['paid'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Remained</td>
                  <td class="width30"><?php echo $purchase['Remained'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Supplier Name</td>
                  <td class="width30"><?php echo $purchase['supplierName'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Added By</td>
                  <td class="width30"><?php echo $purchase['userName'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Added At</td>
                  <td class="width30"><?php echo $purchase['addedDate'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Invoice note</td>
                  <td class="width30"> <?php echo $purchase['details'] ?></td>
                </tr>
                <tr>
                  <td class="width30">Edit invoice</td>
                  <?php if($purchase['approved']!=1):?>
                  <td class="width30"> <button type="button" style="margin-top: 10px;" class="btn btn-info" data-toggle="modal" data-target="#modal-edit<?php $purchase['purchaseId'] ?>">
                      Edit
                    </button>
                    <?php endif;?>
                  </td>
                </tr>
                <tr>
                  <td class="width30">Edit invoice</td>
                  <td class="width30">
                      <?php if($purchase['approved']!=1):?>
                    <?php if($purchase['tax']==0 && $purchase['paid']==0 && $purchase['costOnPay']==0 && $purchase['Remained']==0):?>
                     <button type="button" style="margin-top: 10px;" class="btn btn-info" data-toggle="modal" data-target="#modal-account<?php $purchase['purchaseId'] ?>">
                      Add accounting
                    </button>
                    <?php endif;?>
                    <?php endif;?>
                  </td>
                </tr>
              </table>

              
<?php
include 'editPayInvoiceModel.php';
include 'accountModal.php';
?>
<script>
  // for calculate the remained price
    $(document).on('input', '#ReceivedForReturn', function() {
    let ReceivedForReturn = document.getElementById('ReceivedForReturn').value;
    let forCulc = document.getElementById('forCulc').value;
    if((forCulc-ReceivedForReturn)<0){
      toastr.warning("Received price can not be bigger than the total price");
      $('#ReceivedForReturn').focus();
      return false;
    }
    document.getElementById('remainedForReturn').value =  forCulc - ReceivedForReturn ;
    });
 </script>

 <script>
  // for calculate the remained price
    $(document).on('input', '#paid', function() {
    let paid = document.getElementById('paid').value;
    let forCulc = document.getElementById('forCulc1').value;
    if((forCulc-paid)<0){
      toastr.warning("Paid price can not be bigger than the total price");
      $('#paid').focus();
      return false;
    }
    document.getElementById('Remained').value =  forCulc - paid ;
    console.log(paid);
    });
 </script>
 <script>
  // print
  $(document).on('click', '#print', function() {
    print();
  });
</script>