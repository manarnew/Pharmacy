<?php 
include '/xampp/htdocs/pharnacyapp/view/users/session.php';
include '/xampp/htdocs/pharnacyapp/model/supplier.php';
include '../include/dashboard/dataTableHeader.php' ;
$supplier = new Supplier();
$supp = $supplier->index();
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">suppliers management</h1>
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
        <?php if(!empty($_SESSION["flush"])):?>
             <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-session">
                         <?php print_r( $_SESSION["flush"]) ;unset($_SESSION["flush"]) ;?>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
              </div>
              <?php endif ;?>
              <div class="card">
                <div class="card-header">
                <?php include 'addModal.php';?>
                  <a class="btn btn-info float-right" data-toggle="modal" data-target="#modal-Add">Add User</a>
                <h3 class="card-title">Show users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="suppliers" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Supplier Name</th>
                      <th>Supplier phone</th>
                      <th>Supplier address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($supp as $row):  ?>
                    <tr>
                      <td><?php echo $row['supplierId'] ;?></td>
                      <td><?php echo $row['supplierName'] ;?></td>
                      <td><?php echo $row['phone'] ;?></td>
                      <td><?php echo $row['address'] ;?></td>
                      <td>
                        <a href="../../includes/supplierOpration.php?id=<?php echo $row['supplierId'] ;?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-Edit<?php echo $row['supplierId'] ;?>" >
                        Edit
                         </button>
                  <?php include 'editModal.php';?>
                      </td>
                    </tr>
                    <?php  endforeach; ?>
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
  $(function () {
    $("#suppliers").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#suppliers_wrapper .col-md-6:eq(0)');
    
  });
</script>