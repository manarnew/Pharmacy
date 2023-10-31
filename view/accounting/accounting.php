<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/accounting.php';
include '../include/dashboard/dataTableHeader.php';
$store = new Accounting();
$stores = $store->index();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Show accounting Movement</h1>
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
              
            <div class="row">
              <div  class="col-4">
              <div class="form-group">
                  <label>Start date:</label>
                    <div class="input-group date" id="reservationdate">
                        <input type="date" id="startDate" name="startDate" class="form-control">
                    </div>
                </div>
              </div>
              <div  class="col-4">
              <div class="form-group">
                  <label>End date:</label>
                    <div class="input-group date" id="reservationdate" >
                        <input type="date" id="endDate" name="endDate" class="form-control">
                    </div>
                </div>
              </div>
              <div  class="col-4">
              <div class="form-group">
                  <label>search</label>
                    <div class="input-group date" >
                    <button type="submit" onclick="submitDate()" id="submitDate" class="btn btn-info">Search</button>
                    </div>
                </div>
              </div>
            </div>
              <table id="dateTable" class="table table-bordered table-striped" style="background-color:darkblue;">
                <thead style="color:white;">
                  <tr>
                   <th>serial</th>
                    <th>Account Name</th>
                    <th>debit</th>
                    <th>credit</th>
                    <th>Added date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $debitTotal=$creditTotal=$i = 0; foreach ($stores as $row) :  ?>
                    <?php if($row['debit']>0): ?> 
                     <tr style="background-color: azure;">
                     <?php elseif($row['credit']>0): ?>
                      <tr style="background-color:beige;">
                      <?php endif ?>
                      <td><?php $i++ ;echo $i  ;?></td>
                      <td><?php echo $row['AccountName']; ?></td>
                      <td><?php echo $row['debit'];$debitTotal+=$row['debit']; ?></td>
                      <td><?php echo $row['credit'];$creditTotal+=$row['credit'];?></td>
                      <td><?php echo $row['date']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
<tr><td style="color: red;">Total Price</td><td></td><td style="color: red;"><?php echo $creditTotal - $debitTotal ; ?></td></tr>
              
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
    $("#dateTable").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#dateTable_wrapper .col-md-6:eq(0)');

  });
  
 function  submitDate() {
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    if (startDate == '') {
      toastr.warning('Start date can not be empty');
      $('#startDate').focus();
      return false;
    }
    console.log(endDate);
    $.ajax({
      url: 'dateSearch.php',
      type: 'get',
      data: {
        endDate: endDate,
        startDate: startDate,
      },
      success: function(response) {
        $('#dateTable').html(response);
      },
      error: function(xhr, status, error) {
        toastr.warning(xhr.responseText)
      }

    });
  };
</script>