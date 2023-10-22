 <div class="modal fade" id="modal-receive">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Receive from Suppliers</h4>
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
                                 <input class="form-control" readonly id="totalRemainedForReceive" value="<?php echo -$totalPrice ?>" size="16" type="text" name="totalRemainedForReceive" required>
                                 <input class="form-control" readonly id="supplierId" value="<?php echo $sup['supplierId'] ?>" size="16" type="hidden" name="supplierId" required>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="form-control-label" for="prependedInput">Received price</label>
                         <div class="controls">
                             <div class="input-prepend input-group">
                                 <input class="form-control" id="receivedPrice" size="16" type="text" name="receivedPrice" required>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="form-control-label" for="prependedInput">remained</label>
                         <div class="controls">
                             <div class="input-prepend input-group">
                                 <input class="form-control" readonly id="remainedReceive" size="16" type="text" name="remainedReceive" required>
                             </div>
                         </div>
                     </div>
             </div>
             <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="submit" name="ReceiveForSupplier" class="btn btn-primary sm" style=" margin-left: 10px;">Save</button>
                 </form>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>