<div class="modal fade" id="modal-Add" >
<div class="modal-dialog" >
<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title">Add expense</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
  <form method="post" action="../../includes/expenseOpration.php">
  <div class="form-group">
            <label class="form-control-label" for="prependedInput">Note</label>
            <div class="controls">
                <div class="input-prepend input-group">
                    <input class="form-control" size="16" type="text" name="note" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label" for="prependedInput">Price</label>
            <div class="controls">
                <div class="input-prepend input-group">
                    <input class="form-control" size="16" type="number" name="price" required>
                </div>
            </div>
        </div>
  </div>
  <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" name="addSupplier" class="btn btn-primary sm" style=" margin-left: 10px;">Add expense</button>
    </form>
  </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>