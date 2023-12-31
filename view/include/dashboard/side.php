<?php
$store = new qtyAndExpiration();
$setting = $store->setting();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/pharmacyapp/view/dashboard/dashboard.php" class="brand-link">
    <img src="/pharmacyapp/view/include/images/<?php echo $setting['logo'] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo $setting['appName'] ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
            <p>
              Sales
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pharmacyapp/view/sales/showSale.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show sales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/sales/sales.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add sales</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-undo"></i>
            <p>
              Sales return
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pharmacyapp/view/salesReturn/showSale.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show sales return</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/salesReturn/sales.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add sale return</p>
              </a>
            </li>
          </ul>
        </li>
      


        <?php if($_SESSION["type"]==1):?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pharmacyapp/view/users/showUser.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/users/addUser.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add user</p>
              </a>
            </li>
          </ul>
        </li>
        <?php endif;?>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-user-md"></i>
            <p>
            Medicines
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="/pharmacyapp/view/category/category.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Categories</p>
          </a>
          </li>
          <li class="nav-item">
          <a href="/pharmacyapp/view/units/units.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Show units</p>
          </a>
        </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/products/products.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show Medicines</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/products/addProduct.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Medicines</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/products/endProducts.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>finished Medicines</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/products/expiredproducts.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Expired Medicines</p>
              </a>
            </li>
           
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
            <p>
              Purchases
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pharmacyapp/view/purchases/purchases.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show Purchases</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/Purchases/add.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Purchase</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-undo"></i>
            <p>
              Return Purchases
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pharmacyapp/view/returnPurchase/purchases.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show return purchases</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/returnPurchase/add.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add return purchase</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-truck"></i>
            <p>
              Supplier
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pharmacyapp/view/suppliers/suppliers.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Show suppliers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pharmacyapp/view/suppliers/supplierAccounting.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Suppliers accounting</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-car"></i>
            <p>
            Movement
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/pharmacyapp/view/store/store.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>store movement</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pharmacyapp/view/batches/batches.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>batches movement</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pharmacyapp/view/accounting/accounting.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Accounting movement</p>
          </a>
        </li>
        </ul>
        </li>

        <li class="nav-item">
          <a href="/pharmacyapp/view/expenses/expenses.php" class="nav-link">
            <i class="fas fa-money-bill"></i>
            <p>Expenses</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pharmacyapp/view/settings/details.php" class="nav-link">
            <i class="fas fa-cog"></i>
            <p>App settings</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>