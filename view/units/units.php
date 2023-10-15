<?php 
include '/xampp/htdocs/pharmacyapp/view/users/session.php';
include '/xampp/htdocs/pharmacyapp/model/unit.php';
include '../include/dashboard/header.php' ;
$unit = new Unit();
$units =$unit->index();
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
      <form method="post" action="../../includes/unitOpration.php">
             <div class="d-flex justify-content-center mb-4">
               <div class="form-outline me-3" style="width: 14rem">
                    <input type="text"  name="parentUnit"  class="form-control"  placeholder="Parent Unit name" required>
               </div>
               <div class="form-outline me-3" style="width: 14rem">
                    <input type="text"  name="childUnit"  class="form-control"  placeholder="Child Unit  name">
               </div>
                  <button type="submit" name="addUnit" class="btn btn-primary sm" style=" margin-left: 10px;">Add category</button>
              </div>
              </form>
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
                <h3 class="card-title">Unit table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Parent unit Name</th>
                      <th>Child unit Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($units as $row):  ?>
                    <tr>
                      <td><?php echo $row['unitId'] ;?></td>
                      <td><?php echo $row['parentName'] ;?></td>
                      <td><?php echo $row['childName'] ;?></td>
                      <td>
                        <a href="../../includes/unitOpration.php?id=<?php echo $row['unitId'] ;?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?php echo $row['unitId'] ;?>">
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
   <?php include '../include/dashboard/footer.php'; ?>