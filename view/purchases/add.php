<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/purchase.php';
$get = new Purchase();
$sup = $get->getSuppliers();
$cat = $get->getCat();
$un = $get->getUnitMaster();
$unchild = $get->getUnitChild();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Purchase</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add purchase</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
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
            <div class=" card-body">
              <form class="form-horizontal" method="post" action="/pharmacyapp/includes/purchaseOpration.php">

              <div class="form-group">
                  <label class="form-control-label" for="prependedInput">Pay invoice number</label>
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <input id="invoiceNumber" class="form-control" size="16" type="text" name="invoiceNumber">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="appendedInput">Suppliers</label>
                  <div class="controls">
                    <div class="input-group">
                      <select id="select" name="supplierId" class="form-control" size="1" required>
                        <?php foreach ($sup as $supp) : ?>
                          <option value="<?php echo $supp['supplierId']; ?>"><?php echo $supp['supplierName'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>

                  <div class="form-group">
                    <label class="form-control-label" for="prependedInput">Details</label>
                    <div class="controls">
                      <div class="input-prepend input-group">
                        <textarea class="form-control" name="details" rows="3" placeholder="Enter ..." ></textarea>
                      </div>
                    </div>
                  </div>

                <div class="form-actions text-center">
                  <button type="submit" name="productSubmit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
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

<script>
  $(document).ready(function() {
    $(document).on('change', '#doesItHaveChild', function(e) {
      if ($(this).val() == 1) {
        $('.showUnit').show();
        $(document).on('focusout', '#RetailQty,#WholesaleSalePrice,#WholesaleQty', function() {
          // calculate the retail unit price
          let WholesaleSalePrice = document.getElementById('WholesaleSalePrice').value;
          let WholesaleQty = document.getElementById('WholesaleQty').value;
          let RetailQty = document.getElementById('RetailQty').value;
          let TotalRetailQty = (WholesaleQty * RetailQty);
          let RetailSalePrice = (WholesaleSalePrice * WholesaleQty) / TotalRetailQty;
          document.getElementById('RetailSalePrice').value = (RetailSalePrice).toFixed(2);
          document.getElementById('TotalRetailQty').value = TotalRetailQty;
        })
      } else {
        $('.showUnit').hide();
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#barcode").on('change' , function() {
      var query = $(this).val();
      if (query != "") {
        $.ajax({
          url: '/pharmacyapp/includes/purchaseOpration.php',
          method: 'POST',
          dataType: 'JSON',
          data: {
            query: query
          },
          success: function(data) {
            document.getElementById('name').value = data[0].productName;
            document.getElementById('productId').value = data[0].productId;

          }
        });
      } else {
        $('#search_result').css('display', 'none');
      }
    });
  });
</script>