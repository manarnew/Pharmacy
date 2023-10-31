<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/settings.php';
$settings = new Settings;
$app = $settings->details();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Settings</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Settings details</li>
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
          <div class="card text-center">
            <div class=" card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-default">
                    <div class="card-header" style="background-color: darkblue;">
                      <h3 class="card-title" style=" color: white;">
                        Settings details
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body ">
                      <?php if (!empty($_SESSION["flush"])) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-session">
                          <?php print_r($_SESSION["flush"]);
                          unset($_SESSION["flush"]); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      <?php endif; ?>
                      <table id="example2" class="table table-bordered table-hover">
                        <tr>
                          <td class="width30">App name</td>
                          <td class="width30"><?php echo $app['appName'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">notify date for the expiration</td>
                          <td class="width30"><?php echo $app['notifyDate'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">notify for quantity end</td>
                          <td class="width30"><?php echo $app['qtyNumber'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Address</td>
                          <td class="width30"><?php echo $app['address'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Phone</td>
                          <td class="width30"><?php echo $app['phone'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Email</td>
                          <td class="width30"><?php echo $app['email'] ?></td>
                        </tr>
                        <tr>
                          <td class="width30">App logo</td>
                          <td class="width30"><img src="../include/images/<?php echo $app['logo'] ?>" width="150" height="150" alt="App logo"></td>
                        </tr>
                        <tr>
                          <td class="width30">Edit</td>
                          <td class="width30">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                              <i class="fas fa-edit"></i>
                              Edit
                            </button>
                            <?php include 'editModal.php'; ?>
                          </td>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
            </div>
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