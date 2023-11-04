<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include '../include/dashboard/dataTableHeader.php';
$Product = new qtyAndExpiration();
$prp = $Product->allExpired();
$setting = $Product->setting();
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
              <h3 class="card-title">All Expired Medicines</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="product" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>serial</th>
                    <th>Medicine Name</th>
                    <th>Expiration date</th>
                    <th>Quantity</th>
                    <th>from store</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($prp as $row) :
                    $now = new DateTime();

                    $expirationDate = new DateTime($row['expirationDate']);
                    $diff = $now->diff($expirationDate);

                    $daysDiff = $diff->d;
                    $settingDate = $setting['notifyDate'];
                    $now->modify("+$settingDate days");
                    $newdate = $now->format('Y-m-d');
                    if ($newdate >= $expirationDate->format('Y-m-d') || $now >= $expirationDate) {
                  ?>
                      <tr>
                        <td><?php $i++;
                            echo $i; ?></td>
                        <td>
                          <?php echo $row['productName']; ?>
                        </td>
                        <td><?php echo $row['expirationDate']; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td>
                          <a href="../../includes/productOpration.php?productIdForDelete=<?php echo $row['productId']; ?>&
                          expirationDate=<?php echo $row['expirationDate']; ?>&qty=<?php echo $row['qty']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                  <?php }
                  endforeach; ?>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#product_wrapper .col-md-6:eq(0)');

  });
</script>