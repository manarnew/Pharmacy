<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/saleReturn.php';
include '../include/dashboard/header.php';
$sale = new SaleReturn();
$sales = $sale->getAllProduct();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Sales Return</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sales Return</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php if (!empty($_SESSION["flush"])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-session">
              <?php print_r($_SESSION["flush"]);
              unset($_SESSION["flush"]); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>
          <div class="card">
            <div class="card-header" style="background-color:blueviolet;">
              <h3 class="card-title">Sales return</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form id="submitSale" class="noPrint">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Barcode</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="barcode" class="form-control" size="16" type="text" name="barcode">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-control-label" for="prependedInput">Medicine name</label>
                    <select class="form-control select2" onchange="fetchProduct(this.value);" name="productId" id="productId" style="width: 100;">
                      <option></option>
                      <?php foreach ($sales as $row) : ?>
                        <option value="<?php echo $row['productId'] ?>">
                          <?php echo $row['productName'] ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Invoice number</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="invoiceNumber" readonly class="form-control" value="<?php echo '#'.$sale->invoiceNum(); ?>" size="16" type="text" name="invoiceNumber">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Expiation date</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="expiationDate"  class="form-control" size="16" type="date" name="expiationDate">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 noPrint">
                    <label class="form-control-label" for="appendedInput">Sale price</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="text" name="SalePrice" id="SalePrice" class="form-control">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 noPrint">
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Quantity</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="qty" class="form-control" size="16" type="number" name="qty">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 noPrint">
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">The total</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="total" readonly class="form-control" size="16" type="number" name="total">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" text-center">
                  <button type="submit" id="salebtn" name="salebtn" class="btn btn-success">Add</button>
                </div>
              </form>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Medicine name</th>
                      <th>Quantity</th>
                      <th>Sale price</th>
                      <th>Total price</th>
                      <th class="noPrint">Action</th>
                    </tr>
                  </thead>
                  <tbody id="tableDataSales">
                  </tbody>
                </table>
              </div>
              <br>
              <button type="submit" style="display: none;"  id="saveAndPrint" class="btn btn-info noPrint">Save</button>
              <button type="submit"   class="btn btn-info float-right noPrint" id="btnCancel">Cancel</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../include/dashboard/footer.php'; ?>
<!-- dataTable script -->
<script>
  $(document).ready(function() {
    $("#barcode").on('input', function() {
      var query = $(this).val();
      if (query != "") {
        $.ajax({
          url: 'getProductAjax.php',
          method: 'get',
          data: {
            query: query
          },
          success: function(data) {
            $('#productId').html(data);
          }
        });
      }
    });

  });


  function fetchProduct(val) {
    document.getElementById('total').value = '';
    if (val != "") {
      $.ajax({
        type: 'post',
        url: '/pharmacyapp/includes/saleReturnOpration.php',
        dataType: 'json',
        data: {
          query: val,
        },
        success: function(data) {
          if (data.salePrice > 0) {
              document.getElementById('SalePrice').value = data.salePrice;
            $("#qty").on('input', function() {
              let qty = $('#qty').val();
              let SalePrice = document.getElementById('SalePrice').value;
              let total = document.getElementById('total').value = qty * SalePrice;
            });
          }

        }

      });
    }
    $(document).on('input', '#qty,#SalePrice', function() {
      let qty = $('#qty').val();
      let SalePrice = document.getElementById('SalePrice').value;
      let total = document.getElementById('total').value = qty * SalePrice;
      let qtyRemaining = document.getElementById('qtyRemaining').value;
      if((qtyRemaining-qty)<0){
        toastr.error('Quantity can not be bigger then remaining quantity');
        $(this).focus();
        return false;
      }
    });
  }

 
  $("#salebtn").on('click', function(e) {
    e.preventDefault();
    let total = $('#total').val();
    let qty = $('#qty').val();
    let SalePrice = $('#SalePrice').val();
    let productName = $('#productId').val();
    if (productName == null) {
      toastr.warning('Product name can not be empty');
      $('#productId').focus();
      return false;
    }
    if (qty == '') {
      toastr.warning('Quantity can not be empty');
      $('#qty').focus();
      return false;
    }
    if (SalePrice == '') {
      toastr.warning('Sale Price can not be empty');
      $('#SalePrice').focus();
      return false;
    }
let expiationDate= $('#expiationDate').val();
    if (expiationDate == '') {
      toastr.warning('Expiration date can not be empty');
      $('#expiationDate').focus();
      return false;
    }
    
    // inset data to the purchase details
    let formData = new FormData($('#submitSale')[0]);
    $.ajax({
      url: '/pharmacyapp/includes/saleReturnOpration.php',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        toastr.info(response);
        loadDetailsTable();
        $('#saveAndPrint').show();
      },
      error: function(xhr, status, error) {
        toastr.warning(xhr.responseText)
      }

    });

  });
  //Delete medicine 
  function deleteMedicine(id, invoiceNumber, totalPrice, qty) {
    let data = {
      "medicineIDForDelete": id,
      "invoiceNumber": invoiceNumber,
      "totalPrice": totalPrice,
      "qty": qty,
    };
    $.ajax({
      url: '/pharmacyapp/includes/saleReturnOpration.php',
      type: 'POST',
      data: data,
      success: function(response) {
        toastr.error(response);
        loadDetailsTable();
      },
    });
  }

  function loadDetailsTable() {
    let invoiceNumber = $('#invoiceNumber').val();
    $.ajax({
      type: 'get',
      url: 'tableForProduct.php',
      data: {
        invoiceNumber: invoiceNumber,
      },
      success: function(data) {
        $('#tableDataSales').html(data);
      }
    });
  }
  $("#saveAndPrint").on('click', function(e) {

      let invoiceNumber = $('#invoiceNumber').val();
      let data = {
      'invoiceNumberForSaveAndPrint':invoiceNumber
    };
    console.log(data);
    $.ajax({
      url: '/pharmacyapp/includes/saleReturnOpration.php',
      type: 'POST',
      data: data,
      success: function(response) {
        toastr.error('Return sale saved successfully');
        location.replace(location.href);
      },
    });
  });

  $("#btnCancel").on('click', function(e) {
    let invoiceNumber = $('#invoiceNumber').val();
      let data = {
      'invoiceNumberForCancel':invoiceNumber
    };
    console.log(data);
    $.ajax({
      url: '/pharmacyapp/includes/saleReturnOpration.php',
      type: 'POST',
      data: data,
      success: function(response) {
        location.replace(location.href);
      },
    });
});
</script>