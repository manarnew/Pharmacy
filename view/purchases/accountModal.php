 <!-- Select2 -->

 <div class="modal fade " id="modal-account<?php $purchase['purchaseId'] ?>">
   <div class="modal-dialog modal-lg">
     <div class="modal-content bg-info">
       <div class="modal-header">
         <h4 class="modal-title">Info Modal</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">

         <form method="post" action="/pharmacyapp/includes/purchaseOpration.php">

           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Tax</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="tax" class="form-control" size="16" type="number" name="tax">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Paid</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="paid1" class="form-control" size="16" type="number" name="paid">
                 <input id="purchaseId" value="<?php echo $purchase['purchaseId']?>"  class="form-control" size="16" type="hidden" name="purchaseId">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Remained</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="Remained1" readonly value="0"  class="form-control" size="16" type="number" name="Remained">
                 <input id="forCulc1" value="<?php echo $totalPrice ?>" class="form-control" size="16" type="hidden" name="forCulc">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label class="form-control-label" for="prependedInput">Cost on purchase</label>
             <div class="controls">
               <div class="input-prepend input-group">
                 <input id="costOnPay" class="form-control" size="16" type="number" name="costOnPay">
               </div>
             </div>
           </div>
           <div class="modal-footer justify-content-between">
             <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
             <button type="submit" id="payInvoiceDetails" name="addAccounting" class="btn btn-outline-light">Save changes</button>
           </div>
         </form>
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
