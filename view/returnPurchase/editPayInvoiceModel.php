 <!-- Select2 -->

 <div class="modal fade " id="modal-edit<?php $purchase['purchaseId'] ?>">

   <?php
    $purs = $pur->getPurchaseForEdit($purchase['purchaseId']);
    $sup = $pur->getSuppliers();
    ?>
   <div class="modal-dialog modal-lg">
     <div class="modal-content bg-info">
       <div class="modal-header">
         <h4 class="modal-title">Info Modal</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body" >

         <form method="post" action="/pharmacyapp/includes/returnPurchaseOpration.php">
           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Pay invoice number</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="invoiceNumber" readonly value="<?php echo $purs['invoiceNumber'] ?>" class="form-control" size="16" type="text" name="invoiceNumber">
                 <input id="purchaseId" value="<?php echo $purchase['purchaseId'] ?>" class="form-control" size="16" type="hidden" name="purchaseId">
               </div>
             </div>
           </div>
           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Paid</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="paid" value="<?php echo $purchase['paid'] ?>"  class="form-control" size="16" type="number" name="paid">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Remained</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="Remained" readonly  value="<?php echo $purchase['Remained'] ?>"  class="form-control" size="16" type="number" name="Remained">
                 <input id="forCulc1" value="<?php echo $totalPrice ?>" class="form-control" size="16" type="number" name="forCulc">
                </div>
             </div>
           </div>

           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Details</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <textarea class="form-control" id="details" name="details" rows="3" placeholder="Enter ..."><?php echo $purs['details']; ?></textarea>
               </div>
             </div>
           </div>

           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
             <button type="submit" id="payInvoiceDetails" name="updateInvoice" class="btn btn-outline-light">Save changes</button>
           </div>
         </form>
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
