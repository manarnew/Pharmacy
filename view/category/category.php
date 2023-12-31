<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/category.php';
include '../include/dashboard/header.php';
$cat = new Category;
$categories = $cat->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Categories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Categories management</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form method="post" action="../../includes/categoryOpration.php">
        <div class="d-flex justify-content-center mb-4">
          <div class="form-outline me-3" style="width: 14rem">
            <input type="text" name="category" class="form-control" placeholder="Category name" required>
          </div>
          <button type="submit" name="addCategory" class="btn btn-primary sm" style=" margin-left: 10px;"><i class="fas fa-plus"></i> Add category</button>
        </div>
      </form>
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
            <div class="card-header bg-info">
              <h3 class="card-title">Categories table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>serial</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($categories as $row) :  ?>
                    <tr>
                    <td><?php $i++ ;echo $i  ;?></td>
                      <td><?php echo $row['categoryName']; ?></td>
                      <td>
                        <a href="../../includes/categoryOpration.php?id=<?php echo $row['categoryId']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?php echo $row['categoryId']; ?>">
                        <i class="fas fa-edit"></i>
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
<?php include '../include/dashboard/footer.php'; ?>