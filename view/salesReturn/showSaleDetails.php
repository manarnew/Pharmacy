<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/saleReturn.php';
include '../include/dashboard/header.php';
if (isset($_GET['invoiceNumber'])) {
  $sale = new SaleReturn();
  $sales = $sale->showSalesDetailFrom($_GET['invoiceNumber']);
}
$totalPrice = 0;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show sales details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sales details</li>
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
            <div class="card-header" style="background-color:blueviolet;">
              <h3 class="card-title">Show details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap " >
                  <thead >
                    <tr>
                      <th>Medicine name</th>
                      <th>Quantity</th>
                      <th>Sale price</th>
                      <th>Total price</th>
                    </tr>
                  </thead>
                  <tbody id="tableDataSales">
                    <?php foreach ($sales as $row) : ?>
                      <tr>
                        <td><?php echo $row['productName']; ?></td>
                        <td><?php echo  $row['qty']; ?></td>
                        <td><?php echo $row['salePrice']; ?></td>
                        <td><?php
                            echo $row['qty'] * $row['salePrice'];
                            $totalPrice += $row['qty'] * $row['salePrice'];
                            ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td style="color: red;">Total Price</td>
                      <td></td>
                      <td></td>
                      <td style="color: red;"><?php echo $totalPrice; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <button type="submit" id="Print" class="btn btn-info noPrint">Print</button>
              </div>
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
<?php include '../include/dashboard/footer.php'; ?>
<!-- dataTable script -->
<script>
  $("#Print").on('click', function(e) {
    print();

  });
</script>