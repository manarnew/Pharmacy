<?php
include  $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include  $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/returnPurchase.php';
$get = new ReturnPurchase();
$sup = $get->getSuppliers();

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
              <form class="form-horizontal" method="post" action="/pharmacyapp/includes/returnPurchaseOpration.php">

                <div class="form-group">
                  <div class="controls">
                    <label class="form-control-label" for="appendedInput">Suppliers</label>
                    <select class="form-control select2" name="supplierId" id="supplierId" onchange="supplierChange(this.value);" style="width: 100;">
                      <?php foreach ($sup as $supp) : ?>
                        <option value="<?php echo $supp['supplierId']; ?>"><?php echo $supp['supplierName'] ?></option>
                      <?php  endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="controls">
                    <label class="form-control-label" for="appendedInput">Purchase invoices numbers</label>
                    <select class="form-control select2" name="invoiceNumber" id="invoiceNumber" style="width: 100;">
                    
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="form-control-label" for="prependedInput">Details</label>
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <textarea class="form-control" name="details" rows="3" placeholder="Enter ..."></textarea>
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
  function supplierChange(supplierId) {
    if (supplierId != '') {
      let data = {
        'supplierId': supplierId
      }
      $.ajax({
        url: 'invoiceNumAjax.php',
        method: 'get',
        data: data,
        success: function(data) {
          $('#invoiceNumber').html(data);
        }
      });
    } else {
      $('#invoiceNumber').html('none');
    }
  };
</script>