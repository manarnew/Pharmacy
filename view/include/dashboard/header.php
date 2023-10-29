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

  <!-- Toastr -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="/pharmacyapp/view/include/assets/plugins/toastr/toastr.min.css">
  <style>
    @media print {
      .noPrint {
        display: none;
      }
    }
    @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="/pharmacyapp/view/include/images/<?php echo $setting['logo'] ?>" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include 'nav.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'side.php'; ?>
    <!-- Content Wrapper. Contains page content -->