 <!-- Select2 -->

 <div class="modal fade " id="modal-info<?php $purchase['purchaseId'] ?>">

   <?php $product = $pur->goeOneProduct(); ?>
   <div class="modal-dialog modal-lg">
     <div class="modal-content bg-info">
       <div class="modal-header">
         <h4 class="modal-title">Add medicine</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body" style="background-color:white; color:black">
         <form  id="payInvoiceForm" enctype="multipart/form-data">
           <div class="row">
             <div class="col-lg-4">
               <input id="purchaseId" value="<?php echo $purchase['purchaseId'] ?>" type="hidden" name="purchaseId">
               <label class="form-control-label" for="prependedInput">Medicine name</label>
               <select class="form-control select2" name="productId" onchange="fetch(this.value);" id="selectProductName" style="width: 100;">
                 <option></option>
                 <?php foreach ($product as $product) : ?>
                   <option value="<?php echo $product['productId'] ?>"><?php echo $product['productName'] ?></option>
                 <?php endforeach; ?>
               </select>
             </div>

             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <div class="form-group">
                 <label class="form-control-label" for="prependedInput">Batch Number</label>
                 <div class="controls">
                   <div class="input-prepend input-group">
                     <input id="batchNumber" class="form-control" size="16" type="text" name="batchNumber">
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <label class="form-control-label" for="appendedInput">Expiration Date</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">
                     <i class="far fa-calendar-alt"></i>
                   </span>
                 </div>
                 <input type="date" name="endDate" class="form-control float-right" id="endDate">
               </div>
             </div>

             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <label class="form-control-label" for="appendedInput">Made Date</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">
                     <i class="far fa-calendar-alt"></i>
                   </span>
                 </div>
                 <input type="date" name="madeAt" class="form-control float-right" id="madeAt">
               </div>
             </div>

             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <div class="form-group">
                 <label class="form-control-label" for="appendedInput">Wholesale unit Name</label>
                 <div class="controls">
                   <div class="input-group">
                     <input type="text" readonly style="color:black;" class="form-control" name="wholesaleUnitName" id="wholesaleUnitName">
                     <input type="hidden" name="wholesaleUnitId" id="wholesaleUnitId">
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <div class="form-group">
                 <label class="form-control-label" for="prependedInput">Wholesale Quantity</label>
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
                 <input type="text" name="WholesalePayPrice" id="WholesalePayPrice" class="form-control">
                 <div class="input-group-append">
                   <span class="input-group-text">.00</span>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 showAllMedicineDetails" style="display: none;">
               <label class="form-control-label" for="appendedInput">Wholesale Sale price</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">$</span>
                 </div>
                 <input type="text" readonly name="WholesaleSalePrice" id="WholesaleSalePrice" class="form-control">
                 <div class="input-group-append">
                   <span class="input-group-text">.00</span>
                 </div>
               </div>
             </div>
             <div class="col-lg-4 showChidRetail" style="display: none;">
               <label class="form-control-label" for="appendedInput">Retail unit name</label>
               <div class="input-group">
                 <input id="RetailUnitName" readonly class="form-control" size="16" type="text" name="RetailUnitName">
                 <input id="hasChildUnit" class="form-control" size="16" type="hidden" name="hasChildUnit">
                 <input id="RetailUnitId" class="form-control" size="16" type="hidden" name="RetailUnitId">
               </div>
             </div>

             <div class="col-lg-4 showChidRetail" style="display: none;">
               <label class="form-control-label" for="appendedInput">Retail Sale unit price</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">$</span>
                 </div>
                 <input type="text" name="RetailSalePrice" id="RetailSalePrice" class="form-control">
                 <div class="input-group-append">
                   <span class="input-group-text">.00</span>
                 </div>
               </div>
             </div>

             <div class="col-lg-4 showChidRetail" style="display: none;">
               <label class="form-control-label" for="appendedInput">Retail pay unit price</label>
               <div class="input-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text">$</span>
                 </div>
                 <input type="text" readonly name="RetailPayPrice" id="RetailPayPrice" class="form-control">
                 <div class="input-group-append">
                   <span class="input-group-text">.00</span>
                 </div>
               </div>
             </div>

             <div class="col-lg-4 showChidRetail" style="display: none;">
               <div class="form-group showUnit">
                 <label class="form-control-label" for="prependedInput">Retail unit Quantity</label>
                 <div class="controls">
                   <div class="input-prepend input-group">
                     <input id="RetailQty" class="form-control" size="16" type="number" name="RetailQty">
                     <input id="TotalRetailQty" class="form-control" size="16" type="hidden" name="TotalRetailQty">
                   </div>
                 </div>
               </div>
             </div>
          
           </div>
           
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" id="payInvoiceDetailAdd" name="payInvoiceDetailAdd" class="btn btn-outline-light">Save changes</button>
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
       $.ajax({
         type: 'post',
         url: '/pharmacyapp/includes/purchaseOpration.php',
         dataType: 'json',
         data: {
           query: val
         },
         success: function(data) {
           if (data[0].productId > 0) {
             $('.showAllMedicineDetails').show();
             document.getElementById('wholesaleUnitName').value = data[0].wholesaleUnitName;
             document.getElementById('wholesaleUnitId').value = data[0].wholesaleUnitId;
             document.getElementById('hasChildUnit').value = data[0].hasChildUnit;


           } else {
             $('.showAllMedicineDetails').hide();
             $('.showAllMedicineDetails').hide();
           }

           if (data[0].hasChildUnit == 1) {
             $('.showChidRetail').show();
             document.getElementById('WholesaleSalePrice').value = '';
             document.getElementById('WholesaleSalePrice').readOnly = true;
             document.getElementById('hasChildUnit').value = data[0].hasChildUnit;
             document.getElementById('RetailUnitId').value = data[0].RetailUnitId;
             document.getElementById('RetailUnitName').value = data[0].RetailUnitName;
             $(document).on('input', '#RetailSalePrice,#RetailQty,#WholesaleQty', function() {
               // calculate the Wholesale Sale Price
               let WholesaleQty = document.getElementById('WholesaleQty').value;
               let RetailQty = document.getElementById('RetailQty').value;
               let RetailSalePrice = document.getElementById('RetailSalePrice').value;
               let TotalRetailQty = (WholesaleQty * RetailQty);
               let WholesaleSalePrice = (RetailSalePrice * TotalRetailQty) / WholesaleQty;
               if(WholesaleSalePrice == ''||WholesaleQty == ''||WholesaleQty == 0){
                WholesaleSalePrice = 0;
               }
               document.getElementById('WholesaleSalePrice').value = WholesaleSalePrice;
               if(TotalRetailQty == ''){
                TotalRetailQty = 0;
               }
               document.getElementById('TotalRetailQty').value = TotalRetailQty;
               // calculate the Retail Pay Price
              
               let WholesalePayPrice = document.getElementById('WholesalePayPrice').value;
               if(WholesalePayPrice == ''){
                WholesalePayPrice = 0;
               }

              
               let RetailPayPrice = (WholesalePayPrice / RetailQty).toFixed(2);
               if(RetailQty == ''){
                RetailPayPrice = '';
               }
               document.getElementById('RetailPayPrice').value = RetailPayPrice
              
             })

           } else {
             $('.showChidRetail').hide();
             document.getElementById('WholesaleSalePrice').value = null;
             document.getElementById('TotalRetailQty').value = null;
             let WholesaleQty = document.getElementById('WholesaleQty').value = null;
             let RetailQty = document.getElementById('RetailQty').value = null;
             let RetailSalePrice = document.getElementById('RetailSalePrice').value = null;
             document.getElementById('WholesaleSalePrice').readOnly = false;
           }

         }
       });
     } else {}
   }
 </script>

 