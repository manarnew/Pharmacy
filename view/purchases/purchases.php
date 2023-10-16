<?php
include '/xampp/htdocs/pharmacyapp/view/users/session.php';
include '/xampp/htdocs/pharmacyapp/model/purchase.php';
include '../include/dashboard/dataTableHeader.php';
$purchase = new Purchase();
$pur = $purchase->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">suppliers</li>
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
              <a class="btn btn-info float-right" href="add.php">Add Purchase</a>
              <h3 class="card-title">Show Purchase</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="product" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Invoice number</th>
                    <th>Supplier</th>
                    <th>Added date</th>
                    <th>Added by</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pur as $row) :  ?>
                    <tr>
                      <td><?php echo $row['invoiceNumber']; ?></td>
                      <td><?php echo $row['supplierName']; ?></td>
                      <td><?php echo $row['addedDate']; ?></td>
                      <td><?php echo $row['userName']; ?></td>
                      <td>
                        <a href="details.php?id=<?php echo $row['purchaseId']; ?>" class="btn btn-info">Purchase details</a>
                        <?php if($row['approved']!=1):?>
                        <a href="../../includes/productOpration.php?id=<?php echo $row['purchaseId']; ?>" class="btn btn-danger">Delete</a>
                        <a href="../../includes/purchaseOpration.php?approveId=<?php echo $row['purchaseId']; ?>" class="btn btn-success">Approve</a>
                      <?php endif;?>
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
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#product_wrapper .col-md-6:eq(0)');

  });
</script>