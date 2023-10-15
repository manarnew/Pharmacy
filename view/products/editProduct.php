<?php 
 include '/xampp/htdocs/pharnacyapp/view/users/session.php';
 include '../include/dashboard/header.php' ;
 include '/xampp/htdocs/pharnacyapp/model/product.php';

if(isset($_GET['id']))
{
  $get = new Product();
  $pro = $get->details($_GET['id']);
  $sup = $get->getSuppliers();
  $cat = $get->getCat();
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
              <li class="breadcrumb-item active">Add user</li>
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

        <?php if(!empty($_SESSION["flush"])):?>
             <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-session">
                         <?php print_r( $_SESSION["flush"]) ;unset($_SESSION["flush"]) ;?>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
              </div>
              <?php endif ;?>
              
            <div class="card">
            <div class=" card-body">
                <form class="form-horizontal" method="post" action="/pharnacyapp/includes/productOpration.php" enctype="multipart/form-data">

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
                        <label class="form-control-label" for="prependedInput">Quantity</label>
                        <div class="controls">
                            <div class="input-prepend input-group">
                                <input id="prependedInput" value="<?php echo $pro['qty']; ?>" class="form-control" size="16" type="number" name="quantity" required>
                            </div>
                        </div>
                    </div>
                    <label class="form-control-label" for="appendedInput">Pay price</label>
                    <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" value="<?php echo $pro['payPrice']; ?>" name="pay" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
               <br>
               <label class="form-control-label" for="appendedInput">Sale price</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" value="<?php echo $pro['salePrice']; ?>" name="sale" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
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
                    <input type="date" value="<?php echo $pro['endDate']; ?>" name="endDate" class="form-control float-right" id="reservation">
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

                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Details</label>
                        <textarea class="form-control" name="details" rows="3" ><?php echo $pro['details']?></textarea>
                      </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="updateProduct" class="btn btn-primary">Save</button>
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