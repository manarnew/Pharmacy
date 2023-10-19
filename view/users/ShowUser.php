<?php
include '/xampp/htdocs/pharnacyapp/view/users/session.php';
include '/xampp/htdocs/pharnacyapp/model/user.php';
include '../include/dashboard/dataTableHeader.php';
$users = new User();
$users = $users->showUser();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show user</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">show</li>
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
              <a class="btn btn-info float-right" href="addUser.php">Add User</a>
              <h3 class="card-title">Show users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="user" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>serial</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($users as $row) :  ?>
                    <tr>
                      <td><?php $i++;
                          echo $i; ?></td>
                      <td><?php echo $row['userName']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['userType'] == 1 ? 'Admin' : 'User'; ?></td>
                      <td>
                        <a href="../../includes/categoryOpration.php?id=<?php echo $row['userId']; ?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?php echo $row['userId']; ?>">
                          Edit
                        </button>
                        <?php include 'editUserModal.php'; ?>
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
</div>
<?php include '../include/dashboard/dataTableFooter.php'; ?>
<!-- dataTable script -->
<script>
  $(function() {
    $("#user").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#user_wrapper .col-md-6:eq(0)');

  });
</script>
<!-- /.content-wrapper -->