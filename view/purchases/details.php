<?php
include '/xampp/htdocs/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include '/xampp/htdocs/pharmacyapp/model/purchase.php';
$pur = new Purchase();
$purchase = $pur->details($_GET['id']);
$getDetails = $pur->getPurchaseDetail($_GET['id']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Purchase details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Purchase</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background-color:darkblue;">
              <h3 class="card-title" style=" color: white;">Pay invoice information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <?php if (!empty($_SESSION["flush"])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-session">
              <?php print_r($_SESSION["flush"]);
              unset($_SESSION["flush"]); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>
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
              </table>
              <div class="text-center">
                <button type="button" style="margin-top: 10px;" class="btn btn-info" data-toggle="modal" data-target="#modal-info<?php $purchase['purchaseId'] ?>">
                  Add medicine
                </button>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Medicine name</th>
                      <th>unit Name</th>
                      <th>Quantity</th>
                      <th>Pay price</th>
                      <th>Total price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tableData">
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
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>

<?php
include 'addMedicineModal.php';
include 'editPayInvoiceModel.php';
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
        } else {
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
    document.getElementById('batchNumber').value = '';
  }
  $('#Edit').click(function() {});
</script>