<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/product.php';
$pro = new Product;
$product = $pro->details($_GET['id']);
$RetailUnit = $pro->RetailUnitId($_GET['id']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product details</li>
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
          <div class="card text-center">
            <div class=" card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-default">
                    <div class="card-header"  style="background-color: darkblue;">
                      <h3 class="card-title" style=" color: white;">
                        Product details
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">

                      <table id="example2" class="table table-bordered table-hover">
                      <tr>
                          <td class="width30">Product name</td>
                          <td class="width30"><?php echo $product['productName'] ?></td>
                        </tr> 
                      <tr>
                          <td class="width30">Category name</td>
                          <td class="width30"><?php echo $product['categoryName'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Barcode</td>
                          <td class="width30"><?php echo $product['barcode'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Wholesale unit name</td>
                          <td class="width30"><?php echo $product['unitName'] ?></td>
                        </tr>
                        <?php if ($product['hasChildUnit'] == 1) : ?>
                          <tr>
                            <td class="width30">Retail unit name</td>
                            <td class="width30"><?php echo $RetailUnit['unitName'] ?></td>
                          </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="width30">Added date</td>
                          <td class="width30"><?php echo $product['addedDate'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Added By</td>
                          <td class="width30"><?php echo $product['userName'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Details</td>
                          <td class="width30"><?php echo $product['details'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Image</td>
                          <td class="width30"><img src="../include/images/<?php echo $product['image'] ?>" width="150" height="150" alt="product image"></td>
                        </tr>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
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