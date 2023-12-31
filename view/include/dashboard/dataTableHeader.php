<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pharmacyapp/model/qtyAndExpiration.php';
$store = new qtyAndExpiration();
$qty = $store->getQty();
$batches = $store->batches();
$setting = $store->setting();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $setting['appName'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->

  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/toastr/toastr.min.css">
  
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="/pharmacyapp/view/include/images/<?php echo $setting['logo'] ?>" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<?php include 'nav.php';?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include 'side.php';?>
<!-- Content Wrapper. Contains page content -->