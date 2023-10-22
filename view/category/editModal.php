<div class="modal fade" id="modal-default<?php echo $row['categoryId'] ;?>" >
     <?php
     $cats = new Category;
     $cat =$cats->getOneCat($row['categoryId']);
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
            <form method="post" action="../../includes/categoryOpration.php">
             <div class="d-flex justify-content-center mb-4">
               <div class="form-outline me-3" style="width: 14rem">
                    <input type="text" value=" <?php echo $cat['categoryName'] ;?>" name="category"  class="form-control" required  placeholder="Category name">
                    <input type="hidden" value=" <?php echo $cat['categoryId'] ;?>" name="categoryId"  class="form-control"  placeholder="Category name">
               </div>
                  <button type="submit" name="updateCat" class="btn btn-primary sm" style=" margin-left: 10px;">Save</button>
              </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>