<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/purchase.php';
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
                  <td class="width30">Paid</td>
                  <td class="width30"><?php echo $purchase['paid'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Remained</td>
                  <td class="width30"><?php echo $purchase['Remained'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Cost on purchase</td>
                  <td class="width30"><?php echo $purchase['costOnPay'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Tax</td>
                  <td class="width30"><?php echo $purchase['tax'] ?> </td>
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
                  <td class="width30"> <button type="button" style="margin-top: 10px;" class="btn btn-info" data-toggle="modal" data-target="#modal-edit<?php $purchase['purchaseId'] ?>">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr>
                  <td class="width30">Add account</td>
                  <?php if($purchase['tax']==0 && $purchase['paid']==0 && $purchase['costOnPay']==0 && $purchase['Remained']==0):?>
                  <td class="width30"> <button type="button" style="margin-top: 10px;" class="btn btn-info" data-toggle="modal" data-target="#modal-account<?php $purchase['purchaseId'] ?>">
                      Add accounting
                    </button>
                    <?php endif;?>
                  </td>
                </tr>
              </table>

          
<?php
include 'editPayInvoiceModel.php';
include 'accountModal.php';
include '../include/dashboard/footer.php';
?>
<script>
  $('#payInvoiceForm').submit(function(event) {
    event.preventDefault();
    // validation the input 
    let endDate = $('#endDate').val();
    if (endDate == '') {
      toastr.warning('Expiration Date can not be empty');
      $('#endDate').focus();
      return false;
    }
    let madeAt = $('#madeAt').val();
    if (madeAt == '') {
      toastr.warning('Made Date can not be empty');
      $('#madeAt').focus();
      return false;
    }
    let WholesaleQty = $('#WholesaleQty').val();
    if (WholesaleQty == '') {
      toastr.warning('Wholesale Qty can not be empty')
      $('#WholesaleQty').focus();
      return false;
    }
    let WholesalePayPrice = $('#WholesalePayPrice').val();
    if (WholesalePayPrice == '') {
      toastr.warning('Wholesale pay price can not be empty');
      $('#WholesalePayPrice').focus();
      return false;
    }

    let hasChildUnit = $('#hasChildUnit').val();
    if (hasChildUnit == 0) {
      let WholesaleSalePrice = $('#WholesaleSalePrice').val();
      if (WholesaleSalePrice == '' || WholesaleSalePrice == 0) {
        toastr.warning('Wholesale sale price can not be empty');
        $('#WholesaleSalePrice').focus();
        return false;
      }
    } else {
      let RetailSalePrice = $('#RetailSalePrice').val();
      if (RetailSalePrice == '' || RetailSalePrice == 0) {
        toastr.warning('Retail unit sale price can not be empty');
        $('#RetailSalePrice').focus();
        return false;
      }
      let RetailQty = $('#RetailQty').val();
      if (RetailQty == '' || RetailQty == 0) {
        toastr.warning('Retail unit Qty  can not be empty');
        $('#RetailQty').focus();
        return false;
      }
    }
    // inset data to the purchase details
    let formData = new FormData($(this)[0]);
    $.ajax({
      url: '/pharmacyapp/includes/purchaseOpration.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        if (response == "the product already added") {
          toastr.info(response);
        }else if (response == "the batch number already exist change it or let it empty") {
          toastr.warning(response);
        }
        else {
          toastr.success(response);
        }
        //make all input empty
        emptyTheInput();
        // Reload the medicine table after adding
        reload();
        reloadTotals();
      },
      error: function(xhr, status, error) {
        toastr.warning(xhr.responseText)
      }

    });
  });
  //Delete medicine 
  function deleteMedicine(id) {
    let data = {
      "medicineIDForDelete": id
    };
    $.ajax({
      url: '/pharmacyapp/includes/purchaseOpration.php',
      type: 'POST',
      data: data,
      success: function(response) {
        toastr.error(response);
        reload();
        reloadTotals();
      },
    });
  }

  function reload() {
    let data = {
      'id': $('#purchaseId').val()
    }
    $.ajax({
      url: 'reloadTableForAdding.php',
      type: 'get',
      data: data,
      success: function(response) {
        $('#tableData').html(response);
      },
    });
  }

  function reloadTotals() {
    let data = {
      'id': $('#purchaseId').val()
    }
    $.ajax({
      url: 'reloadDetailInvoice.php',
      type: 'get',
      data: data,
      success: function(response) {
        $('#detailTable').html(response);
      },
    });
  }

  function emptyTheInput() {
    document.getElementById('WholesaleSalePrice').value = '';
    document.getElementById('WholesalePayPrice').value = '';
    document.getElementById('WholesaleQty').value = '';
    document.getElementById('wholesaleUnitName').value = '';
    document.getElementById('wholesaleUnitId').value = '';

    document.getElementById('hasChildUnit').value = 0;
    document.getElementById('TotalRetailQty').value = '';
    document.getElementById('RetailUnitId').value = '';
    document.getElementById('RetailUnitName').value = '';
    document.getElementById('RetailPayPrice').value = '';
    document.getElementById('RetailQty').value = '';
    document.getElementById('RetailSalePrice').value = '';

    document.getElementById('endDate').value = '';
    document.getElementById('madeAt').value = '';
    document.getElementById('batchNumber').value = '';
  }
  // $('#Edit').click(function() {});
</script>


<script>
  // for calculate the remained price
  $(document).on('input', '#paid', function() {
    let paid = document.getElementById('paid').value;
    let forCulc = document.getElementById('forCulc').value;
    if ((forCulc - paid) < 0) {
      toastr.warning("Paid price can not be bigger than the total price");
      $('#paid').focus();
      return false;
    }
    document.getElementById('Remained').value = forCulc - paid;
  });
</script>

<script>
  // for calculate the remained price
  $(document).on('input', '#paid1', function() {
    let paid = document.getElementById('paid1').value;
    let forCulc = document.getElementById('forCulc1').value;
    if ((forCulc - paid) < 0) {
      toastr.warning("Paid price can not be bigger than the total price");
      $('#paid').focus();
      return false;
    }
    document.getElementById('Remained1').value = forCulc - paid;
    console.log(paid);
  });
</script>
<script>
  // print
  $(document).on('click', '#print', function() {
    print();
  });
</script>