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
            <label class="form-control-label" for="prependedInput">parent Name</label>
            <div class="controls">
                <div class="input-prepend input-group">
                <input type="text" value=" <?php echo $un['parentName'] ;?>" name="parentName"  class="form-control"  placeholder="Category name">
                <input type="hidden" value=" <?php echo $un['unitId'] ;?>" name="unitId"  class="form-control"  placeholder="Category name">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-control-label" for="prependedInput">child Name</label>
            <div class="controls">
                <div class="input-prepend input-group">
                <input type="text" value=" <?php echo $un['childName'] ;?>" name="childName"  class="form-control"  placeholder="Category name">
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