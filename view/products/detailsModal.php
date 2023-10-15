<div class="modal fade" id="modal-details<?php echo $row['productId'] ;?>" >
     <?php
     $pro = new Product;
     $product =$pro->details($row['productId']);
     ?>
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">
          <?php echo $product['productName'] ?>
        </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="callout callout-info">
          <h5>Category name</h5>

          <h4><?php echo $product['categoryName'] ?></h4>
        </div>
        <div class="callout callout-info">
          <h5>Barcode</h5>

          <h4><?php echo $product['barcode'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>Quantity</h5>
        <h4><?php echo $product['qty'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>Sale price</h5>
        <h4><?php echo $product['salePrice'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>Pay price</h5>
        <h4><?php echo $product['payPrice'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>Added date</h5>
        <h4><?php echo $product['addedDate'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>expiration date</h5>
        <h4><?php echo $product['endDate'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>Supplier name</h5>
        <h4><?php echo $product['supplierName'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5>User name</h5>
        <h4><?php echo $product['userName'] ?></h4>
        </div>
        <div class="callout callout-success">
        <h5> Details</h5>
        <h4><?php echo $product['details'] ?></h4>
        </div>
        <div class="callout callout-success text-center">
        <h5> image</h5>
        <h4><img src="../include/images/<?php echo $product['image'] ?>" width="200" alt="product image"></h4>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- END ALERTS AND CALLOUTS -->


<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>