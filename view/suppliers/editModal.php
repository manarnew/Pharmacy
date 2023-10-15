<div class="modal fade" id="modal-Edit<?php echo $row['supplierId'] ;?>" >
     <?php
     $supplier = new Supplier;
     $sup =$supplier->getOneSup($row['supplierId']);
     ?>
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit suppliers</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post" action="../../includes/supplierOpration.php">
  <div class="form-group">
            <label class="form-control-label" for="prependedInput">Name</label>
            <div class="controls">
                <div class="input-prepend input-group">
                    <input class="form-control" value="<?php echo $sup['supplierName']?>" size="16" type="text" name="name" required>
                    <input  value="<?php echo $sup['supplierId']?>" size="16" type="hidden" name="supplierId" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="prependedInput">Phone</label>
            <div class="controls">
                <div class="input-prepend input-group">
                    <input class="form-control"value="<?php echo $sup['phone']?>" size="16" type="text" name="phone" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="prependedInput">Address</label>
            <div class="controls">
                <div class="input-prepend input-group">
                    <input class="form-control" value="<?php echo $sup['address']?>" size="16" type="text" name="address" required>
                </div>
            </div>
        </div>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" name="updateSup" class="btn btn-primary sm" style=" margin-left: 10px;">Add category</button>
    </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>