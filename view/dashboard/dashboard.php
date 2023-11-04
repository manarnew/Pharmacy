<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/view/users/session.php';
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/dashboard.php';
include '../include/dashboard/header.php';
$dashboard = new Dashboard();
$monthlySales = $dashboard->monthlySales();
$expenses = $dashboard->expenses();
$revenue = $dashboard->revenue();
$returnSales = $dashboard->returnSales();
$purchases = $dashboard->purchases();
$purchasesReturn = $dashboard->purchasesReturn();
$profit = $dashboard->profit();
$monthlyExpenses = $dashboard->monthlyExpenses();
$users = $dashboard->users();
$suppliers = $dashboard->suppliers();
$numberOfSales = $dashboard->numberOfSales();
$qtyAvailbaleProduct = $dashboard->qtyAvailbaleProduct();



//Charts area
$qty = [];
$month = [];
foreach ($monthlySales as $monthlySales) {
  $changeMonths = date("F", mktime(0, 0, 0, $monthlySales['monthly'], 1));
  $qty[] =  $monthlySales['qty'];
  $month[] =  $changeMonths;
}
$qty = json_encode($qty);
$month = json_encode($month);

//expenses
$pieData = [];
$totalExpenses = 0;
foreach ($expenses as $expenses) {
  $totalExpenses =  $expenses['totalExpenses'];
}
$pieData[] = $totalExpenses;
//revenue
$totalSales = 0;
foreach ($revenue as $revenue) {
  $totalSales =  $revenue['totalSales'];
}
$Sales = 0;
foreach ($returnSales as $returnSales) {
  $Sales =  $returnSales['totalSales'];
}
$pieData[] = $totalSales - $Sales;
//purchases
$totalPurchases = 0;
foreach ($purchases as $purchases) {
  $totalPurchases =  $purchases['totalPurchases'];
}
$purchasesReturnTotal = 0;
foreach ($purchasesReturn as $purchasesReturn) {
  $purchasesReturnTotal =  $purchasesReturn['totalPurchases'];
}
$pieData[] = $totalPurchases - $purchasesReturnTotal;
$pieData = json_encode($pieData);
//profit
$monthForProfit = [];
$totalProfit = [];
foreach ($profit as $key => $profit) {
  $monthName = date("F", mktime(0, 0, 0, $key, 1));
  $monthForProfit[] =  $monthName;
  if (key_exists($key, $monthlyExpenses)) {
    $totalProfit[] = $profit - $monthlyExpenses[$key];
  } else {
    $totalProfit[] = $profit;
  }
}
$monthForProfit = json_encode($monthForProfit);
$totalProfit = json_encode($totalProfit);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
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
              <h3 class="card-title">Dashboard</h3>
            </div>
            <!-- /.card-header -->
            <div class="row">
              <div class="col-sm-6 col-md-4" style="padding-left: 25px;padding-top: 25px;padding-right: 25px;">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo count($users)  ?></h3>
                    <p> Number of users</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4" style="padding-left: 25px;padding-top: 25px;padding-right: 25px;">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo count($suppliers)  ?></h3>
                    <p> Number of suppliers</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4" style="padding-left: 25px;padding-top: 25px;25px;padding-right: 25px;">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo count($numberOfSales)  ?></h3>
                    <p> Number of sales</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4" style="padding-left: 25px;padding-top: 25px;margen-right: 25px;padding-right: 25px;">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $qtyAvailbaleProduct['qtyCount']  ?></h3>
                    <p> Quantity of available product</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                </div>
              </div>
              <div class="row">
              
                <div class="col-md-6">
                  <div class="card-body">
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">Quantity of sales</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <div class="card card-success">
                      <div class="card-header">
                        <h3 class="card-title">Profit</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="ProfitChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card-body">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title">Cash movement</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="chart">
                          <canvas id="pieRev" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../include/dashboard/footer.php'; ?>
<!-- dataTable script -->
<script>
  $(document).ready(function() {
    //monthly sales quantity 
    var month = <?php print_r($month); ?>;
    var qty = <?php print_r($qty); ?>;
    new Chart("stackedBarChart", {
      type: "bar",
      data: {
        labels: month,
        responsive: true,
        datasets: [{
          backgroundColor: '#007bff',
          data: qty
        }],
      },
    });
    //monthly profit quantity 
    new Chart("ProfitChart", {
      type: "bar",
      data: {
        labels: <?php print_r($monthForProfit); ?>,
        responsive: true,
        datasets: [{
          backgroundColor: '#17a2b8',
          data: <?php print_r($totalProfit); ?>
        }],
      },
    });
    //'Expenses', 'Revenue', 'Purchase and cost'
    var label = ['Expenses', 'Revenue', 'Purchase and cost'];
    new Chart("pieRev", {
      type: "pie",
      data: {
        labels: label,
        datasets: [{
          data: <?php print_r($pieData); ?>,
          backgroundColor: ['#007bff', '#f56954', '#00a65a'],
        }]
      },
    });
  });
</script>
</body>

</html>