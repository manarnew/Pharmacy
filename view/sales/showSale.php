<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/sale.php';
include '../include/dashboard/dataTableHeader.php';
$showSale = new Sale();
$sales = $showSale->showSale();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show sales</h1>
        </div><!-- /.col -->
        <div class="col-sm-6" >
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sales</li>
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
          <div class="card">
            <div class="card-header">
              <a class="btn btn-info float-right" href="sales.php">Add sale</a>
              <h3 class="card-title">Show sales</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="product" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>serial</th>
                    <th>Invoice number</th>
                    <th>Total price</th>
                    <th>Total quantity</th>
                    <th>Added date</th>
                    <th>Added by</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $totalPrice=$i = 0; foreach ($sales as $row) :  
                    $totalPrice += $row['totalQty'] * $row['TotalPrice'];
                    ?>
                    <tr>
                    <td><?php $i++;echo $i; ?></td>
                      <td>
                        <a href="showSaleDetails.php?invoiceNumber=<?php echo $row['invoiceNumber']?>">
                        <?php echo $row['invoiceNumber']; ?>
                        </a>
                      </td>
                      <td><?php echo $row['TotalPrice']; ?></td>
                      <td><?php echo $row['totalQty']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                      <td><?php echo $row['userName']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
<tr><td style="color: red;">Total Price</td><td></td><td style="color: red;"><?php echo $totalPrice; ?></td></tr>
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
<?php include '../include/dashboard/dataTableFooter.php'; ?>
<!-- dataTable script -->
<script>
  $(function() {
    $("#product").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": [ "excel", "pdf", "print"]
      
    }).buttons().container().appendTo('#product_wrapper .col-md-6:eq(0)');
  });
</script>