<div class="modal fade" id="modal-default<?php echo $row['unitId'] ;?>" >
     <?php
     $unit = new Unit();
     $un =$unit->getOneUnit($row['unitId']);
     ?>
        
       getOneCat($id)
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post" action="../../includes/unitOpration.php">
            <div class="form-group">
            <label class="form-control-label" for="prependedInput">Uint Name</label>
            <div class="controls">
                <div class="input-prepend input-group">
                <input type="text" value="<?php echo $un['unitName'] ;?>" name="unitName"  class="form-control"  placeholder="Unit name" required>
                <input type="hidden" value="<?php echo $un['unitId'] ;?>" name="unitId"  class="form-control" >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label" for="prependedInput">Is master</label>
            <div class="controls">
                <div class="input-prepend input-group">
                <select id="select" name="isMaster" class="form-control" size="1" required>
                      <option value="<?php ($un['isMaster']==0)?print'0':print'1' ;?>"><?php  ($un['isMaster']==0)?print'No':print'Yes'; ?></option>
                      <option value="<?php  ($un['isMaster']==0)?print'1':print'0'  ;?>"><?php  ($un['isMaster']==0)?print'Yes':print'No';?></option>
                   </select>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="updateUnit" class="btn btn-primary sm" style=" margin-left: 10px;">Save</button>
          </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>