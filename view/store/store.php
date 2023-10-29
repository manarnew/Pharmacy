<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/store.php';
include '../include/dashboard/dataTableHeader.php';
$store = new Store();
$stores = $store->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show Store Movement</h1>
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
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Quantity remaining</th>
                    <th>Type</th>
                    <th>User Name</th>
                    <th>Added date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($stores as $row) :  ?>
                    <?php if($row['Type']==1): ?> 
                     <tr style="background-color: azure;">
                     <?php elseif($row['Type']==0): ?>
                      <tr style="background-color:beige;">
                      <?php elseif($row['Type']==2): ?>
                      <tr style="background-color:aliceblue;">
                      <?php elseif($row['Type']==3): ?>
                      <tr style="background-color:bisque;">
                      <?php elseif($row['Type']==4): ?>
                      <tr style="background-color:cornsilk;">
                      <?php endif ?>
                      <td><?php $i++ ;echo $i  ;?></td>
                      <td><?php echo $row['productName']; ?></td>
                      <td><?php echo $row['qty']; ?></td>
                      <td><?php echo $row['qtyRemining']; ?></td>
                      <td>
                        <?php if($row['Type']==1){
                          print('Purchase');
                        }elseif($row['Type']==0){
                          print('Return purchase');
                        }elseif($row['Type']==2){
                          print('Sales');
                        }elseif($row['Type']==3){
                          print('Sales return');
                        }elseif($row['Type']==4){
                          print('Delete expired medicines');} ?>
                      </td>
                      <td><?php echo $row['userName']; ?></td>
                      <td><?php echo $row['storeDate']; ?></td>
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