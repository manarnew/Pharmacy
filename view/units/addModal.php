<div class="modal fade" id="modal-addUnit" >
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post" action="../../includes/unitOpration.php">
            <div class="form-group">
            <label class="form-control-label" for="prependedInput">parent Name</label>
            <div class="controls">
                <div class="input-prepend input-group">
                <input type="text"  name="unitName"  class="form-control"  placeholder="Unit name">
                </div>
            </div>
           </div>
        <div class="form-group">
            <label class="form-control-label" for="prependedInput">Is master</label>
            <div class="controls">
                <div class="input-prepend input-group">
                <select id="select" name="isMaster" class="form-control" size="1" required>
                  <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="addUnit" class="btn btn-primary sm" style=" margin-left: 10px;">Save</button>
          </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>