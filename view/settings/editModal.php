<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit settings</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../includes/settingsOpration.php" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">App Name</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input type="text" value="<?php echo $app['appName'] ?>" name="appName" class="form-control" placeholder="App Name" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">notify date for the expiration</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input type="text" value="<?php echo $app['notifyDate'] ?>" name="notifyDate" class="form-control" placeholder="notify date for the expiration" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">notify for quantity end</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input type="text" value="<?php echo $app['qtyNumber'] ?>" name="qtyNumber" class="form-control" placeholder="notify for quantity end" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">Address</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input type="text" value="<?php echo $app['address'] ?>" name="address" class="form-control" placeholder="Address ...." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">Phone</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input type="text" value="<?php echo $app['phone'] ?>" name="phone" class="form-control" placeholder="phone ..." required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-control-label" for="prependedInput">Email</label>
            <div class="controls">
              <div class="input-prepend input-group">
                <input type="text" value="<?php echo $app['email'] ?>" name="email" class="form-control" placeholder="Email ..." required>
              </div>
            </div>
          </div>
          <div class="form-group">
                  <h4><img src="../include/images/<?php echo $app['logo'] ?>" width="200" alt="logo"></h4>
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="customFile">
                    <input type="hidden" name="oldImage" value="<?php echo $app['logo'] ?>">
                    <label class="custom-file-label" for="customFile">Choose image</label>
                  </div>
                </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="updateSetting" class="btn btn-primary sm" style=" margin-left: 10px;">Save</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>