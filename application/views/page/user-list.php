<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1>User List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li> 
    <li class="active">User List</li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
   
  <div class="box box-success">
    <div class="box-header with-border">
      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal"><span class="fa fa-plus-circle"></span> Add New </button>
        
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body table-responsive">
       
       <table class="table table-hover table-bordered table-striped table-responsive">
        <thead> 
            <tr>
                <th>#</th>   
                <th>User Name</th>   
                <th>Password</th>   
                <th>Level</th>   
                <th>Edit Flag</th>   
                <th>Status</th>  
                <th colspan="2" class="text-center">Action</th>  
            </tr> 
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 );?></td>   
                    <td><?php echo $ls['user_name']?></td>  
                    <td><?php echo str_repeat('*', strlen($ls['user_pwd'])); ?></td>  
                    <td><?php echo $user_type_opt[$ls['level']];?></td>  
                    <td><?php echo ($ls['edit_flg'] == '0' ? 'No' : 'Yes')?></td>   
                    <td><?php echo $ls['status']?></td>   
                     
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['user_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['user_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>                                      
                </tr>
                <?php
                    }
                ?>                                 
            </tbody>
      </table>
        
        <div class="modal fade" id="add_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form method="post" action="" id="frmadd">
                    <div class="modal-header">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="scrollmodalLabel"><strong>Add User Info</strong></h3>
                        <input type="hidden" name="mode" value="Add" />
                    </div>
                    <div class="modal-body">
                          
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label>User Name</label>
                                <input class="form-control" type="text" name="user_name" id="user_name" value="" placeholder="User Name">                                             
                             </div> 
                             <div class="form-group col-md-6">
                                <label>Password</label>
                                <input class="form-control" type="password" name="user_pwd" id="user_pwd" value="" placeholder="Password">                                             
                             </div>   
                         </div> 
                         <div class="row"> 
                             <div class="form-group col-md-4">
                                <label>User Type</label>
                                <?php echo form_dropdown('level',array('' => 'Select') + $user_type_opt,set_value('level','2') ,' id="level" class="form-control"');?>                                             
                             </div>
                              
                             <div class="form-group col-md-4">
                                <label for="edit_flg">Edit Option</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="edit_flg" value="1" /> Yes 
                                    </label> 
                                </div>
                                <div class="radio">
                                    <label>
                                         <input type="radio" name="edit_flg"  value="0" checked="true"  /> No
                                    </label>
                                </div> 
                                <i class="text-warning text-sm">Not Applicable for Admin User</i>
                             </div>
                             
                             <div class="form-group col-md-4">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status"  value="Active" checked="true" /> Active 
                                    </label> 
                                </div>
                                <div class="radio">
                                    <label>
                                         <input type="radio" name="status"  value="InActive"  /> InActive
                                    </label>
                                </div> 
                             </div>
                         </div>
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                        <input type="submit" name="Save" value="Save"  class="btn btn-primary" />
                    </div> 
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="edit_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <form method="post" action="" id="frmedit">
                    <div class="modal-header">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit User</strong> </h3>
                        <input type="hidden" name="mode" value="Edit" />
                        <input type="hidden" name="user_id" id="user_id" />
                    </div>
                    <div class="modal-body"> 
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label>User Name</label>
                                <input class="form-control" type="text" name="user_name" id="user_name" value="" placeholder="User Name">                                             
                             </div> 
                             <div class="form-group col-md-6">
                                <label>Password</label>
                                <input class="form-control" type="password" name="user_pwd" id="user_pwd" value="" placeholder="Password">                                             
                             </div>   
                         </div> 
                         <div class="row"> 
                             <div class="form-group col-md-4">
                                <label>User Type</label>
                                <?php echo form_dropdown('level',array('' => 'Select') + $user_type_opt,set_value('level') ,' id="level" class="form-control"');?>                                             
                             </div>
                             
                             <div class="form-group col-md-4">
                                <label for="edit_flg">Edit Option</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="edit_flg" value="1" /> Yes 
                                    </label> 
                                </div>
                                <div class="radio">
                                    <label>
                                         <input type="radio" name="edit_flg"  value="0" checked="true"  /> No
                                    </label>
                                </div> 
                                <i class="text-warning text-sm">Not Applicable for Admin User</i>
                             </div>
                              
                             <div class="form-group col-md-4">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status"  value="Active" checked="true" /> Active 
                                    </label> 
                                </div>
                                <div class="radio">
                                    <label>
                                         <input type="radio" name="status"  value="InActive"  /> InActive
                                    </label>
                                </div> 
                             </div>
                         </div>
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                        <input type="submit" name="Save" value="Update"  class="btn btn-primary" />
                    </div> 
                    </form>
                </div>
            </div>
        </div>
        
        
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group col-sm-12">
            <label>Total Records : <?php echo count($record_list);?></label>
        </div>
         
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
