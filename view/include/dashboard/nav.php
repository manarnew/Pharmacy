
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <?php if (isset($_SESSION["id"])) ?>
        <span class="hidden-md-down"><?php echo $_SESSION["name"] ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-xs-center">
          <strong>Account</strong>
        </div>
        <?php if (isset($_SESSION["id"])) { ?>
          <a class="dropdown-item" href="/pharmacyapp/view/users/profile.php"><i class="fa fa-user"></i> Profile</a>
          <a class="dropdown-item" href="/pharmacyapp/view/users/logout.php"><i class="fa fa-lock"></i> Logout</a>
        <?php } ?>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <?php
        //Count how many notification we have
        $countQty = 0; 
        $countexpirationDate = 0;
        foreach ($qty as $qtys){
          if (($qtys['quantity'] - $setting['qtyNumber']) <= 0) $countQty++;
          }

          foreach ($batches as $batch){
            $now = date("Y/m/d") ;
            $now = new DateTime($now);
            
            $expirationDate = new DateTime($batch['expirationDate']);
            
            $diff = $now->diff($expirationDate);
            
            $daysDiff = $diff->d;
            if ($now >= $expirationDate) {$countexpirationDate++ ;}
            if(($daysDiff - $setting['notifyDate']) <= 0) {$countexpirationDate++ ;}
            }
        ?>
        <span class="badge badge-warning navbar-badge"><?php echo ($countQty+$countexpirationDate); ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <span class="dropdown-item dropdown-header"><?php echo ($countQty+$countexpirationDate); ?> Notifications</span>
        <?php  $x = 0; foreach ($qty as $qty) :
          if (($qty['quantity'] - $setting['qtyNumber']) <= 0) :
        ?>
            <a  class="dropdown-item">
              <i class="fas fa-file mr-2"></i>
              Product Name: <?php echo $qty['productName']; ?>
              <br>
              <span class="float-right text-muted text-sm">Quantity: <?php echo $qty['quantity']; ?></span>
            </a>
        <?php $x++; endif; 
        endforeach; ?>
        <?php if($x>=1):?>
         <div class="dropdown-divider"></div>
          <a href="/pharmacyapp/view/products/endProducts.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        <hr>
        <?php endif;?>
           <?php 
           $j = 0;
           foreach ($batches as $batches) :
                  $now = new DateTime();

                  $expirationDate = new DateTime($batches['expirationDate']);
                  $diff = $now->diff($expirationDate);

                  $daysDiff = $diff->d;
                  $settingDate = $setting['notifyDate'];
                  $now->modify("+$settingDate days");
                  $newdate = $now->format('Y-m-d');
                  if ($newdate >= $expirationDate->format('Y-m-d') || $now >= $expirationDate) 
                  {?>
            <a  class="dropdown-item">
              <i class="fas fa-file mr-2"></i>
              Product Name: <?php echo $batches['productName']; ?>
              <br>
              <span class="float-right text-muted text-sm bg-danger">Expiration date: <?php echo $expirationDate->format('Y-m-d'); ?></span>
            </a>
            <?php $j++; } endforeach;?>
        <?php if($j>=1):?>
            <div class="dropdown-divider"></div>
          <a href="/pharmacyapp/view/products/expiredproducts.php" class="dropdown-item dropdown-footer">See All Notifications</a>
          <?php endif;?>
        </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>