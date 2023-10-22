<?php
 include $_SERVER['DOCUMENT_ROOT'] .'/pharnacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharnacyapp/model/user.php';
$prof = new User();
$info = $prof->getUserProfile();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
                        <div class=" card-body">
                            <form class="form-horizontal" method="post" action="../../includes/userOpeation.php">
                                <div class="form-group">
                                    <label class="form-control-label" for="prependedInput">Name</label>
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <input value="<?php echo $info['userName'];?>" class="form-control" size="16" type="text" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="prependedInput">Email</label>
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <input value="<?php echo $info['email'];?>" class="form-control" size="16" type="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="prependedInput">Password</label>
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <input value="<?php echo $info['password'];?>" class="form-control" size="16" type="password" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                                </div>
                            </form>
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