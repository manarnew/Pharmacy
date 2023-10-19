<?php
include '/xampp/htdocs/pharmacyapp/view/users/session.php';
include '/xampp/htdocs/pharmacyapp/model/unit.php';
include '../include/dashboard/header.php';
$unit = new Unit();
$units = $unit->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Units</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Units management</li>
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
              <a class="btn btn-info float-right" data-toggle="modal" data-target="#modal-addUnit">Add Product</a>
              <h3 class="card-title">Unit table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>serial</th>
                    <th>Parent unit Name</th>
                    <th>Is master</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($units as $row) :  ?>
                    <tr>
                      <td><?php $i++;echo $i; ?></td>
                      <td><?php echo $row['unitName']; ?></td>
                      <td><?php ($row['isMaster'] == 1) ? print 'Yes' : print 'No'; ?></td>
                      <td>
                        <a href="../../includes/unitOpration.php?id=<?php echo $row['unitId']; ?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?php echo $row['unitId']; ?>">
                          Edit
                        </button>
                        <?php include 'editModal.php'; ?>
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
<?php include '../include/dashboard/footer.php';
include 'addModal.php';
?>