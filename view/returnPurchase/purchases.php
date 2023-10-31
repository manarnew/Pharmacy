<?php
include  $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include  $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/returnPurchase.php';
include '../include/dashboard/dataTableHeader.php';
$purchase = new ReturnPurchase();
$pur = $purchase->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show  return Purchases</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> Return Purchases</li>
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
              <a class="btn btn-info float-right" href="add.php"><i class="fas fa-plus"></i> Add return purchases</a>
              <h3 class="card-title">Show return Purchase</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Start date:</label>
                    <div class="input-group date">
                      <input type="date" id="startDate" name="startDate" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>End date:</label>
                    <div class="input-group date" >
                      <input type="date" id="endDate" name="endDate" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>search</label>
                    <div class="input-group date">
                      <button type="submit" onclick="submitDate()" id="submitDate" class="btn btn-info">Search</button>
                    </div>
                  </div>
                </div>
              </div>
              <table id="purchase" class="table table-bordered table-striped">
                <thead class="bg-info">
                  <tr>
                  <th>serial</th>
                    <th>Invoice number</th>
                    <th>Supplier</th>
                    <th>Added date</th>
                    <th>Added by</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($pur as $row) :  ?>
                    <tr>
                    <td><?php $i++;echo $i; ?></td>
                      <td>
                      <a href="details.php?id=<?php echo $row['purchaseId']; ?>">
                        <?php echo $row['invoiceNumber']; ?>
                        </a>
                      </td>
                      <td><?php echo $row['supplierName']; ?></td>
                      <td><?php echo $row['addedDate']; ?></td>
                      <td><?php echo $row['userName']; ?></td>
                      <td>
                        <?php if ($row['approved'] != 1) : ?>
                          <a href="../../includes/returnPurchaseOpration.php?deletePurchaseId=<?php echo $row['purchaseId']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                          <a href="../../includes/returnPurchaseOpration.php?approveId=<?php echo $row['purchaseId']; ?>" class="btn btn-success"><i class="fas fa-check-circle"></i> Approve</a>
                        <?php else: echo '<div class="text-center" style="color:blue">Approved</div>'; endif; ?>
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
<?php include '../include/dashboard/dataTableFooter.php'; ?>
<!-- dataTable script -->
<script>
  $(function() {
    $("#purchase").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#purchase_wrapper .col-md-6:eq(0)');

  });
  
  function submitDate() {
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    if (startDate == '') {
      toastr.warning('Start date can not be empty');
      $('#startDate').focus();
      return false;
    }
    $.ajax({
      url: 'dateSearch.php',
      type: 'get',
      data: {
        endDate: endDate,
        startDate: startDate,
      },
      success: function(response) {
        $('#purchase').html(response);
      },
      error: function(xhr, status, error) {
        toastr.warning(xhr.responseText)
      }

    });
  };
</script>