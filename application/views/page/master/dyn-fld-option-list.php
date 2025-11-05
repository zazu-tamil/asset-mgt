<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1><?php echo $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li> 
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  <!-- Default box -->
   
  <div class="box box-info">
    <div class="box-header with-border">
      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal"><span class="fa fa-plus-circle"></span> Add New </button>
        
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
         
      </div>
    </div>
    <div class="box-body table-responsive"> 
       <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Category</th>   
                <th>Field Name</th>     
                <th>Field Type</th>     
                <th>Field Sort Order</th>     
                <th>Field Option Values</th>     
                <th>Status</th>  
                <th colspan="2" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td><?php echo $ls['dyn_fld_opt_category']?></td>   
                    <td><?php echo $ls['dyn_fld_opt_name']?></td>   
                    <td><?php echo $ls['dyn_fld_opt_type']?></td>   
                    <td><?php echo $ls['fld_s_order']?></td>   
                    <td><?php echo $ls['fld_opt_val_name']?></td>   
                    <td><?php echo $ls['status']?></td>   
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['dyn_fld_opt_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['dyn_fld_opt_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>                                      
                </tr>
                <?php
                    }
                ?>                                 
            </tbody>
      </table> 
        
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group col-sm-6">
            <label>Total Records : <?php echo $total_records;?></label>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $pagination; ?>
        </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

                <div class="modal fade" id="add_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmadd">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Add <?php echo $title; ?></strong></h3>
                                
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body"> 
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Field Category</label>
                                        <?php echo form_dropdown('dyn_fld_opt_category',array('' => 'Select') + $fld_category_opt,set_value('dyn_fld_opt_category') ,' id="dyn_fld_opt_category" class="form-control" required="true"');?>                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>Dynamic Field Name</label>
                                        <input class="form-control" type="text" name="dyn_fld_opt_name" id="dyn_fld_opt_name" value="">                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>Field Type</label>
                                        <?php echo form_dropdown('dyn_fld_opt_type',array('' => 'Select') + $fld_opt_type_opt,set_value('dyn_fld_opt_type') ,' id="dyn_fld_opt_type" class="form-control" required="true"');?>                                             
                                     </div> 
                                     <div class="form-group col-md-3">
                                        <label>Sort Order</label>
                                        <input class="form-control" type="number" name="fld_s_order" id="fld_s_order" value="1">                                             
                                     </div>  
                                     <div class="form-group col-md-3">
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
                                 <hr />
                                 <div class="opt_val_div hide">
                                    <h4 class="box-title">Field Option Value Info</h4><br />
                                 <?php for($i=0;$i<5;$i++) {?>
                                 <div class="row">
                                    <div class="form-group col-md-1">
                                        <label class="label label-warning"># <?php echo ($i+1); ?></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Field Option Value Name</label>
                                        <input class="form-control" type="text" name="dyn_fld_opt_val_name[]" id="dyn_fld_opt_val_name_<?php echo ($i); ?>" value="">                                             
                                     </div> 
                                     <div class="form-group col-md-3">
                                        <label>Sort Order</label>
                                        <input class="form-control" type="number" name="fld_val_s_order[]" id="fld_val_s_order_<?php echo ($i); ?>" value="">                                             
                                     </div> 
                                 </div>
                                 <?php } ?>
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
                            <form method="post" action="" id="frmedit" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit <?php echo $title; ?></strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="dyn_fld_opt_id" id="dyn_fld_opt_id" value="" />
                            </div>
                            <div class="modal-body"> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Field Category</label>
                                        <?php echo form_dropdown('dyn_fld_opt_category',array('' => 'Select') + $fld_category_opt,set_value('dyn_fld_opt_category') ,' id="dyn_fld_opt_category" class="form-control" required="true"');?>                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>Dynamic Field Name</label>
                                        <input class="form-control" type="text" name="dyn_fld_opt_name" id="dyn_fld_opt_name" value="">                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>Field Type</label>
                                        <?php echo form_dropdown('dyn_fld_opt_type',array('' => 'Select') + $fld_opt_type_opt,set_value('dyn_fld_opt_type') ,' id="dyn_fld_opt_type" class="form-control" required="true"');?>                                             
                                     </div> 
                                     <div class="form-group col-md-3">
                                        <label>Sort Order</label>
                                        <input class="form-control" type="number" name="fld_s_order" id="fld_s_order" value="1">                                             
                                     </div>  
                                     <div class="form-group col-md-3">
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
                                 <hr />
                                 <div class="opt_val_div hide">
                                    <h4 class="box-title">Field Option Value Info</h4><br />
                                 <?php for($i=0;$i<5;$i++) {?>
                                 <div class="row">
                                    <div class="form-group col-md-1">
                                        <label class="label label-warning"># <?php echo ($i+1); ?></label>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Field Option Value Name</label>
                                        <input type="hidden" name="dyn_fld_opt_val_id[]" id="dyn_fld_opt_val_id_<?php echo ($i); ?>" value="">                                             
                                        <input class="form-control" type="text" name="dyn_fld_opt_val_name[]" id="dyn_fld_opt_val_name_<?php echo ($i); ?>" value="">                                             
                                     </div> 
                                     <div class="form-group col-md-3">
                                        <label>Sort Order</label>
                                        <input class="form-control" type="number" name="fld_val_s_order[]" id="fld_val_s_order_<?php echo ($i); ?>" value="">                                             
                                     </div> 
                                 </div>
                                 <?php } ?>
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

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
