<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/accounting.php';
include '../include/dashboard/dataTableHeader.php';
$store = new Accounting();
$stores = $store->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show accounting Movement</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Store</li>
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
              <h3 class="card-title">All store movement</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="product" class="table table-bordered table-striped" style="background-color:darkblue;">
                <thead style="color:white;">
                  <tr>
                   <th>serial</th>
                    <th>Account Name</th>
                    <th>debit</th>
                    <th>credit</th>
                    <th>Added date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($stores as $row) :  ?>
                    <?php if($row['debit']>0): ?> 
                     <tr style="background-color: azure;">
                     <?php elseif($row['credit']>0): ?>
                      <tr style="background-color:beige;">
                      <?php endif ?>
                      <td><?php $i++ ;echo $i  ;?></td>
                      <td><?php echo $row['AccountName']; ?></td>
                      <td><?php echo $row['debit']; ?></td>
                      <td><?php echo $row['credit']; ?></td>
                      <td><?php echo $row['date']; ?></td>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#product_wrapper .col-md-6:eq(0)');

  });
</script>