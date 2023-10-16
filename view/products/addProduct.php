<?php
include '/xampp/htdocs/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include '/xampp/htdocs/pharmacyapp/model/product.php';
$get = new Product();
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
          <h1 class="m-0">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add product</li>
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
            <div class=" card-body">
              <form class="form-horizontal" method="post" action="/pharmacyapp/includes/productOpration.php" enctype="multipart/form-data">

                <div class="form-group">
                  <label class="form-control-label" for="prependedInput">Medicine name</label>
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <input id="prependedInput" class="form-control" size="16" type="text" name="name" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="prependedInput">barcode</label>
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <input id="prependedInput" class="form-control" size="16" type="text" name="barcode">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-control-label" for="appendedInput">Category</label>
                  <div class="controls">
                    <div class="input-group">
                      <select id="select" name="categoryId" class="form-control" size="1" required>
                        <?php foreach ($cat as $cat) : ?>
                          <option value="<?php echo $cat['categoryId']; ?>"><?php echo $cat['categoryName'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                    <div class="form-group">
                      <label class="form-control-label" for="appendedInput">Wholesale unit Name</label>
                      <div class="controls">
                        <div class="input-group">
                          <select id="select" name="wholesaleUnitId" class="form-control" size="1" required>
                            <?php foreach ($un as $un) : ?>
                              <option value="<?php echo $un['unitId']; ?>"><?php echo $un['unitName'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Does it have retail unit</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <select id="doesItHaveChild" name="hasChildUnit" class="form-control" size="1" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group showUnit" style="display: none;">
                      <label class="form-control-label" for="appendedInput">Retail unit name</label>
                      <div class="controls">
                        <div class="input-group">
                          <select id="select" name="RetailUnitId" class="form-control" size="1" >
                            <option>Select retail name</option>
                            <?php foreach ($unchild as $unchild) : ?>
                              <option value="<?php echo $unchild['unitId']; ?>"><?php echo $unchild['unitName'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <br>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose image</label>
                  </div>
                </div>
                <div class="form-group" >
                      <label class="form-control-label" for="prependedInput">Details</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                        <textarea class="form-control" name="details" rows="3" placeholder="Enter ..." ></textarea>
                      </div>
                    </div>
                </div>
            <div class="form-actions">
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

  $(document).ready(function(){
    $(document).on('change','#doesItHaveChild',function(e){
       if($(this).val()==1){
        $('.showUnit').show();
        $(document).on('focusout','#RetailQty,#WholesaleSalePrice,#WholesaleQty',function(){
          // calculate the retail unit price
       let WholesaleSalePrice =  document.getElementById('WholesaleSalePrice').value;
        let WholesaleQty =  document.getElementById('WholesaleQty').value;
        let RetailQty =  document.getElementById('RetailQty').value;
        let TotalRetailQty = (WholesaleQty * RetailQty);
        let RetailSalePrice =   ( WholesaleSalePrice * WholesaleQty) / TotalRetailQty;
        document.getElementById('RetailSalePrice').value= (RetailSalePrice).toFixed(2);
        document.getElementById('TotalRetailQty').value= TotalRetailQty;
    })
       }else{
        $('.showUnit').hide();
       }
    });
  });

</script>