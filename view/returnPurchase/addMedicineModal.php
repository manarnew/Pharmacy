 <!-- Select2 -->

 <div class="modal fade " id="modal-info<?php $purchase['purchaseId'] ?>">

   <?php $product = $pur->goeOnePurchasedetails($purchase['invoiceNumber']); ?>
   <div class="modal-dialog modal-lg">
     <div class="modal-content bg-info">
       <div class="modal-header">
         <h4 class="modal-title">Info Modal</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body" style="background-color:white; color:black">
         <form  id="returnInvoiceForm" >
           <div class="row">
             <div class="col-lg-8">
               <input id="invoiceNumber" value="<?php echo $purchase['invoiceNumber'] ?>" type="hidden" name="invoiceNumber">
               <input id="purchaseId" value="<?php echo $purchase['purchaseId'] ?>" type="hidden" name="purchaseId">
               <label class="form-control-label" for="prependedInput">Medicine name</label>
               <select class="form-control select2" name="productId" onchange="fetch(this.value);" id="selectProductName" style="width: 100;">
                 <option></option>
                 <?php 
                 foreach ($product as $product) : 
                  if($product['hasChildUnit']===1){
                    $qty = $product['qty']/$product['WholesaleQty'];
                  }else{
                    $qty = $product['qty'];
                  }
                  ?>
                   <option value="<?php echo $product['productId'] ?>">Medicine name: <?php echo $product['productName'] ?>&nbsp; &nbsp;&nbsp;  Quantity: <?php echo $qty; ?></option>
                 <?php endforeach; ?>
               </select>
             </div>
             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <div class="form-group">
                 <label class="form-control-label" for="appendedInput">Wholesale unit Name</label>
                 <div class="controls">
                   <div class="input-group">
                     <input type="text" readonly style="color:black;" class="form-control" name="wholesaleUnitName" id="wholesaleUnitName">
                     <input type="hidden"    name="batchNumber" id="batchNumber">
                     <input type="hidden"    name="RetailQty" id="RetailQty">
                     <input type="hidden"    name="hasChildUnit" id="hasChildUnit">
                     <input type="hidden" name="wholesaleUnitId" id="wholesaleUnitId">
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <div class="form-group">
                 <label class="form-control-label" for="prependedInput">Quantity for return</label>
                 <div class="controls">
                   <div class="input-prepend input-group">
                     <input id="WholesaleQty" class="form-control" size="16" type="number" name="WholesaleQty" >
                   </div>
                 </div>
               </div>
             </div>

             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <label class="form-control-label" for="appendedInput">Wholesale Pay price</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">$</span>
                 </div>
                 <input type="text" readonly name="WholesalePayPrice" id="WholesalePayPrice" class="form-control">
                 <div class="input-group-append">
                   <span class="input-group-text">.00</span>
                 </div>
               </div>
             </div>
           </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" id="returnInvoiceDetailAdd" name="returnInvoiceDetailAdd" class="btn btn-outline-light">Save changes</button>
          </form>
       </div>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>

 <script type="text/javascript">
   function fetch(val) {
     if (val != "") {
      let invoiceNumber = $('#invoiceNumber').val();
       $.ajax({
         type: 'post',
         url: '/pharmacyapp/includes/returnPurchaseOpration.php',
         dataType: 'json',
         data: {
           query: val,
           invoiceNumber:invoiceNumber
          },
          success: function(data) {
           if (data[0].productId > 0) {
             $('.showAllMedicineDetails').show();
             document.getElementById('batchNumber').value = data[0].batchNumber;
             document.getElementById('hasChildUnit').value = data[0].hasChildUnit;
             document.getElementById('RetailQty').value = data[0].RetailQty;
             document.getElementById('WholesalePayPrice').value = data[0].WholesalePayPrice;
             document.getElementById('wholesaleUnitName').value = data[0].wholesaleUnitName;
             document.getElementById('wholesaleUnitId').value = data[0].wholesaleUnitId;
             document.getElementById('hasChildUnit').value = data[0].hasChildUnit;


           } else {
             $('.showAllMedicineDetails').hide();
             $('.showAllMedicineDetails').hide();
           }

          }
       });
     } 
   }
 </script>

 