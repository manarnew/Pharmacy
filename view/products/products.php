<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/product.php';
include '../include/dashboard/dataTableHeader.php';
$Product = new Product();
$prp = $Product->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show Medicines</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Medicines</li>
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
            <div class="card-header">
              <a class="btn btn-info float-right" href="addProduct.php"><i class="fas fa-plus"></i> Add Medicine</a>
              <h3 class="card-title">All Medicines</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
              <table id="product" class="table table-bordered table-striped">
                <thead class=" bg-info">
                  <tr>
                   <th>serial</th>
                    <th>Medicine Name</th>
                    <th>Category</th>
                    <th>Added date</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($prp as $row) :  ?>
                    <tr>
                      <td><?php $i++ ;echo $i  ;?></td>
                      <td>
                      <a href="details.php?id=<?php echo $row['productId']; ?>">
                        <?php echo $row['productName']; ?>
                        </a>
                      </td>
                      <td><?php echo $row['categoryName']; ?></td>
                      <td><?php echo $row['addedDate']; ?></td>
                      <td><img src="../include/images/<?php echo $row['image'] ?>" height="100" width="150" alt="product image"></td>
                      <td>
                        <a href="../../includes/productOpration.php?id=<?php echo $row['productId']; ?>" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                        <a href="editProduct.php?id=<?php echo $row['productId']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
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
<?php include '../include/dashboard/dataTableFooter.php'; ?>
<!-- dataTable script -->
<script>
  $(function() {
    $("#product").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": [ "excel", "pdf", "print"]
    }).buttons().container().appendTo('#product_wrapper .col-md-6:eq(0)');

  });
</script>