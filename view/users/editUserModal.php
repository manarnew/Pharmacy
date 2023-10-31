<div class="modal fade" id="modal-default<?php echo $row['userId'] ;?>" >
     <?php
     $user = new User();
     $info = $user->getUser($row['userId']);
     ?>
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" method="post" action="../../includes/userOpeation.php">
                                <div class="form-group">
                                    <label class="form-control-label" for="prependedInput">Name</label>
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <input value="<?php echo $info['userName'];?>" class="form-control" size="16" type="text" name="name" required>
                                            <input value="<?php echo $info['userId'];?>" class="form-control" size="16" type="hidden" name="id">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="prependedInput">Email</label>
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <input value="<?php echo $info['email'];?>" class="form-control" size="16" type="email" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="form-control-label" for="appendedInput">User Type </label>
                                        <div class="controls">
                                            <div class="input-group">
                                            <select id="select" name="type" class="form-control" size="1" >
                                                  <option value="<?php $info['userType'];?>"><?php ($info['userType']==1) ? print"Admin" : print"User"; ?></option>
                                                  <option value="<?php ($info['userType']==1)?print 2: print 1;?>"><?php ($info['userType']==1) ? print"User" :print"Admin" ; ?></option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="prependedInput">Password</label>
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <input value="<?php echo $info['password'];?>" class="form-control" size="16" type="password" name="password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="update_user" class="btn btn-primary">Update</button>
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