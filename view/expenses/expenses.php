<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/expenses.php';
include '../include/dashboard/dataTableHeader.php';
$Expenses = new Expenses();
$Expense = $Expenses->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Expenses management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Expenses</li>
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
              <?php include 'addModal.php'; ?>
              <a class="btn btn-info float-right" data-toggle="modal" data-target="#modal-Add">Add expense</a>
              <h3 class="card-title">Show expenses</h3>
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
                    <div class="input-group date">
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
              <table id="expense" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>serial</th>
                    <th>Note</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $totalPrice = $i = 0;
                  foreach ($Expense as $row) :  ?>
                    <tr>
                      <td><?php $i++;
                          echo $i; ?></td>
                      <td>
                        <?php echo $row['expenseNote']; ?>
                        </a>
                      </td>
                      <td><?php echo $row['expensePrice'];
                          $totalPrice += $row['expensePrice']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                      <td>
                        <a href="../../includes/expenseOpration.php?id=<?php echo $row['expenseId']; ?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-Edit">
                          Edit
                        </button>
                        <?php include 'editModal.php'; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tr>
                  <td style="color: red;">Total Price</td>
                  <td></td>
                  <td style="color: red;"><?php echo $totalPrice; ?></td>
                </tr>

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
    $("#expense").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#expense_wrapper .col-md-6:eq(0)');

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
        $('#expense').html(response);
      },
      error: function(xhr, status, error) {
        toastr.warning(xhr.responseText)
      }

    });
  };
</script>