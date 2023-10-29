<div class="modal fade" id="modal-Edit">
  <?php
  $supplier = new Expenses;
  $sup = $supplier->getOneExpe($row['expenseId']);
  ?>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit suppliers</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../includes/expenseOpration.php">
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">Name</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input class="form-control" value="<?php echo $sup['expenseNote'] ?>" size="16" type="text" name="note" required>
                <input value="<?php echo $sup['expenseId'] ?>" size="16" type="hidden" name="expenseId" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">Price</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input class="form-control" value="<?php echo $sup['expensePrice'] ?>" size="16" type="text" name="price" required>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="updateSup" class="btn btn-primary sm" style=" margin-left: 10px;">Update expense</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>