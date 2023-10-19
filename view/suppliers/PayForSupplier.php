 <?php
    $totalPrice = 0;
    foreach ($derail as $row) :
        $totalPrice = $row['remainedBefor'];
    endforeach;
    ?>

 <div class="modal fade" id="modal-pay">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Pay Suppliers</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="post" action="../../includes/supplierOpration.php">
                     <div class="form-group">
                         <label class="form-control-label" for="prependedInput">Total remained price</label>
                         <div class="controls">
                             <div class="input-prepend input-group">
                                 <input class="form-control" readonly id="totalRemained" value="<?php echo $totalPrice ?>" size="16" type="text" name="totalRemained" required>
                                 <input class="form-control" readonly id="supplierId" value="<?php echo $sup['supplierId'] ?>" size="16" type="hidden" name="supplierId" required>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="form-control-label" for="prependedInput">Pay price</label>
                         <div class="controls">
                             <div class="input-prepend input-group">
                                 <input class="form-control" id="payPrice" size="16" type="text" name="payPrice" required>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="form-control-label" for="prependedInput">remained</label>
                         <div class="controls">
                             <div class="input-prepend input-group">
                                 <input class="form-control" readonly id="remained" size="16" type="text" name="remained" required>
                             </div>
                         </div>
                     </div>
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" name="PayForSupplier" class="btn btn-primary sm" style=" margin-left: 10px;">Save</button>
                 </form>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>