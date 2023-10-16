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

         <form method="post" action="/pharmacyapp/includes/purchaseOpration.php">
           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Pay invoice number</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="invoiceNumber" value="<?php echo $purs['invoiceNumber'] ?>" class="form-control" size="16" type="text" name="invoiceNumber">
                 <input id="purchaseId" value="<?php echo $purchase['purchaseId'] ?>" class="form-control" size="16" type="hidden" name="purchaseId">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label class="form-control-label" for="appendedInput">Suppliers</label>
             <div class="controls">
               <div class="input-group">
                 <select id="supplierId" name="supplierId" class="form-control" size="1" required>
                   <option value="<?php echo $purs['supplierId']; ?>"><?php echo $purs['supplierName'] ?></option>
                   <?php foreach ($sup as $supp) :
                      if ($supp['supplierId'] == $purs['supplierId']) {
                      } else {
                    ?>
                       <option value="<?php echo $supp['supplierId']; ?>"><?php echo $supp['supplierName'] ?></option>
                   <?php }
                    endforeach; ?>
                 </select>
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
