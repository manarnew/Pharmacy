<?php
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/view/users/session.php';
include '../include/dashboard/header.php';
include $_SERVER['DOCUMENT_ROOT'] .'/pharmacyapp/model/supplier.php';
$supplier = new Supplier;
$sup =$supplier->getOneSup($_GET['supplierId']);
$derail =$supplier->supplierDetail($_GET['supplierId']);
include 'PayForSupplier.php';
include 'ReceiveForSupplier.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Supplier details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Supplier</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="background-color:darkblue;">
              <h3 class="card-title" style=" color: white;">Supplier information </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <?php if (!empty($_SESSION["flush"])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-session">
              <?php print_r($_SESSION["flush"]);
              unset($_SESSION["flush"]); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>
              <table id="detailTable" class="table table-bordered table-hover">
              <tr>
                  <td class="width30">Supplier Name</td>
                  <td class="width30"><?php echo $sup['supplierName'] ?> </td>
                </tr> 
              <tr>
                  <td class="width30">Address</td>
                  <td class="width30"><?php echo $sup['address'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Phone</td>
                  <td class="width30"><?php echo $sup['phone'] ?> </td>
                </tr>
                <tr>
                  <td class="width30">Total price remained from purchase</td>
                  <td class="width30"><?php  ($totalPrice<0)?print(0):print($totalPrice) ?> </td>
                </tr>
                <tr>
                  <td class="width30">Total price remained from returned purchase</td>
                  <td class="width30"><?php  ($totalPrice<0)?print(-$totalPrice):print(0) ?> </td>
                </tr>
                <tr>
                  <td class="width30">Pay for supplier</td>
                  <td class="width30">
                  <?php if($totalPrice>0):?>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-pay">
                  Pay
                  </button>
                  <?php endif;?>
                  </td>
                </tr>
                <tr>
                <?php if($totalPrice<0):?>
                  <td class="width30">Receive form supplier</td>
                  <td class="width30">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-receive">
                  Receive
                  </button>
                  </td>
                  <?php endif;?>
                </tr>
              </table>
              <br>
              <div class=" text-center" style="font-size:25px;background-color:azure;">Purchases sDetails</div>
              <br>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                      <th>Invoice number</th>
                      <th>Paid</th>
                      <th>Remained</th>
                      <th>Total remained</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($derail as $row): 
                    if($row['paid']==0)continue;
                    ?>
                    <tr>
                      <td>
                        <?php  ($row['invoiceNumber']!=null)?print $row['invoiceNumber']: print'<h5 style="color:red;">Pay for old invoice<h5>' ;?>
                      </td>
                      <td><?php echo $row['paid'] ;?></td>
                      <td><?php echo $row['remained'] ;?></td>
                      <td><?php echo $row['remainedBefor'] ;?></td>
                      <td><?php echo $row['date'] ;?></td>
                    </tr>
                    <?php  endforeach; ?>
                  </tbody>
                </table>
              </div>
              <br>
              <div class=" text-center" style="font-size:25px;background-color:red;">Return Purchases Details</div>
              <br>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                      <th>Invoice number</th>
                      <th>Received for return</th>
                      <th>Remained for return</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($derail as $row):  
                     if($row['ReceivedForReturn']==0)continue;
                    ?>
                    <tr>
                      <td>
                        <?php  ($row['invoiceNumber']!=null)?print $row['invoiceNumber']: print'<h5 style="color:red;">Received fro return purchase<h5>' ;?>
                      </td>
                      <td><?php echo $row['ReceivedForReturn'] ;?></td>
                      <td><?php echo $row['remainedForReturn'] ;?></td>
                      <td><?php echo $row['date'] ;?></td>
                    </tr>
                    <?php  endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <button class="btn btn-info noPrint" id="print">Print</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>
<?php

include '../include/dashboard/footer.php';
?>

<script>
  // for calculate the remained price for modal pay for suppliers
    $(document).on('input', '#payPrice', function() {
    let payPrice = document.getElementById('payPrice').value;
    let totalRemained = document.getElementById('totalRemained').value;
    if((totalRemained-payPrice)<0){
      toastr.warning("Paid price can not be bigger than the total price");
      $('#payPrice').focus();
      return false;
    }
    document.getElementById('remained').value =  totalRemained - payPrice ;
    });

     // for calculate the remained price for modal receive form suppliers
     $(document).on('input', '#receivedPrice', function() {
    let receivedPrice = document.getElementById('receivedPrice').value;
    let totalRemainedForReceive = document.getElementById('totalRemainedForReceive').value;
    if((totalRemainedForReceive-receivedPrice)<0){
      toastr.warning("Received price can not be bigger than the total price");
      $('#receivedPrice').focus();
      return false;
    }
    document.getElementById('remainedReceive').value =  totalRemainedForReceive - receivedPrice ;
    });
 </script>
 <script>
  // print
  $(document).on('click', '#print', function() {
    print();
  });
</script>