<?php
include '/xampp/htdocs/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include '/xampp/htdocs/pharmacyapp/model/product.php';
$get = new Product();
$sup = $get->getSuppliers();
$cat = $get->getCat();
$un = $get->getUnitMaster();
$unchild = $get->getUnitChild();
if(isset($_GET['id']))
{
  $pro = $get->details($_GET['id']);
  $sup = $get->getSuppliers();
  $cat = $get->getCat();
  $RetailUnit = $pro->RetailUnitId($_GET['id']);
}
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
                      <input id="prependedInput" value="<?php echo $pro['productName']; ?>" class="form-control" size="16" type="text" name="name" required>
                      <input id="prependedInput" value="<?php echo $pro['productId']; ?>" class="form-control" size="16" type="hidden" name="productId" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="prependedInput">barcode</label>
                  <div class="controls">
                    <div class="input-prepend input-group">
                     <input id="prependedInput" value="<?php echo $pro['barcode']; ?>" class="form-control" size="16" type="text" name="barcode">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                        <label class="form-control-label" for="appendedInput">Category</label>
                        <div class="controls">
                            <div class="input-group">
                            <select id="select" name="categoryId" class="form-control" size="1" required>
                            <option value="<?php echo $pro['categoryId'] ;?>"><?php echo $pro['categoryName']; ?></option>
                            <?php foreach($cat as $cat):
                              if($pro['categoryId'] == $cat['categoryId']){}else{
                              ?>
                                  <option value="<?php echo $cat['categoryId'] ;?>"><?php echo $cat['categoryName']; ?></option>
                                  <?php }endforeach;?>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="appendedInput">Suppliers</label>
                        <div class="controls">
                            <div class="input-group">
                            <select id="select" name="supplierId" class="form-control" size="1" required>
                            <option value="<?php echo $pro['supplierId'] ;?>"><?php echo $pro['supplierName']?></option>
                            <?php foreach($sup as $supp):
                               if($supp['supplierId'] == $pro['supplierId']){}else{
                              ?>
                                  <option value="<?php echo $supp['supplierId'] ;?>"><?php echo $supp['supplierName']?></option>
                             <?php }endforeach;?>
                            </select>
                            </div>
                        </div>
                    </div>
                    
                <label class="form-control-label" for="appendedInput">Expiration Date</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="date" name="endDate" value="<?php echo $pro['endDate']; ?>" class="form-control float-right" id="reservation">
                </div>
                <br>
              
                <div class="row">
                  <div class=" col-sm-6">
                    <div class="form-group">
                      <label class="form-control-label" for="appendedInput">Wholesale unit Name</label>
                      <div class="controls">
                        <div class="input-group">
                          <select id="select" name="wholesaleUnitId" class="form-control" size="1" required>
                          <option value="<?php echo $pro['unitId']; ?>"><?php echo $pro['unitName'] ?></option>
                            <?php foreach ($un as $un) :
                               if($supp['unitId'] == $pro['unitId']){}else{
                              ?> ?>
                              <option value="<?php echo $un['unitId']; ?>"><?php echo $un['unitName'] ?></option>
                            <?php }endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Wholesale Quantity</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="WholesaleQty" value="<?php echo $un['WholesaleQty']; ?>"> class="form-control" size="16"  type="number" name="WholesaleQty" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class=" col-sm-6">
                    <label class="form-control-label" for="appendedInput">Pay price</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="text" value="<?php echo $pro['WholesalePayPrice']; ?>" name="WholesalePayPrice" id="WholesalePayPrice" class="form-control">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                    <label class="form-control-label" for="appendedInput">Sale price</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                      </div>
                      <input type="text" name="WholesaleSalePrice" value="<?php echo $pro['WholesaleSalePrice']; ?>" id="WholesaleSalePrice" class="form-control">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class=" col-sm-6">
                    <div class="form-group">
                      <label class="form-control-label" for="prependedInput">Does it have retail unit</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <select id="doesItHaveChild" name="hasChildUnit" value="<?php echo $pro['hasChildUnit']; ?>" class="form-control" size="1" required>
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
                          <option value="<?php echo $RetailUnit['RetailUnitId']; ?>"><?php echo $RetailUnit['unitName'] ?></option>
                            <?php foreach ($unchild as $unchild) : 
                                 if($unchild['unitId'] == $RetailUnit['unitId']){}else{?>
                              <option value="<?php echo $unchild['unitId']; ?>"><?php echo $unchild['unitName'] ?></option>
                            <?php }endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6" >
                  <div class="form-group showUnit" style="display: none;">
                      <label class="form-control-label" for="prependedInput">Retail unit price</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="RetailSalePrice" readonly value="<?php echo $RetailUnit['RetailSalePrice']; ?>"  class="form-control" size="16" type="number" name="RetailSalePrice" >
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group showUnit" style="display: none;">
                      <label class="form-control-label" for="prependedInput">Retail unit Quantity</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <input id="RetailQty" class="form-control"  size="16" type="number" name="RetailQty" >
                          <input id="TotalRetailQty" class="form-control" value="<?php echo $RetailUnit['TotalRetailQty']; ?>"  size="16" type="hidden" name="TotalRetailQty" >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                    <div class="form-group">
                      <h4><img src="../include/images/<?php echo $pro['image'] ?>" width="200" alt="product image"></h4>
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="customFile">
                      <input type="hidden" name="oldImage" value="<?php echo $pro['image'] ?>" class="custom-file-input" id="customFile">
                      <label class="custom-file-label"  for="customFile">Choose image</label>
                    </div>
                  </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose image</label>
                  </div>
                </div>
                <!-- textarea -->
                <div class="form-group" >
                      <label class="form-control-label" for="prependedInput">Details</label>
                      <div class="controls">
                        <div class="input-prepend input-group">
                        <textarea class="form-control" name="details" rows="3" placeholder="Enter ..." required><?php echo $pro['details']; ?></textarea>
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