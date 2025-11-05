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
                <th>Emp Category</th>   
                <th>Designation Name</th>   
                <th>Status</th>  
                <th  class="text-center">Salary BreakUp</th>  
                <th colspan="2" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td><?php echo $ls['employee_category']?></td>   
                    <td><?php echo $ls['designation_name']?></td>   
                    <td><?php echo $ls['status']?></td>   
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#salary_brkup_modal" value="<?php echo $ls['designation_id']?>" class="btn_salary_brkup btn btn-success btn-xs" title="Salary BreakUp Allowances"><i class="fa fa-scissors"></i></button>
                    </td> 
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['designation_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                 
                    <td class="text-center">
                        <button value="<?php echo $ls['designation_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
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
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Add Designation</strong></h3>
                                
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                              <div class="row">   
                                 <div class="form-group col-md-12">
                                    <label>Emp Category</label>
                                    <?php echo form_dropdown('employee_category',array('' => 'Select') + $emp_category_opt,set_value('employee_category') ,' id="employee_category" class="form-control"');?>                                             
                                 </div> 
                                 <div class="form-group col-md-12">
                                    <label>Designation Name</label>
                                    <input class="form-control" type="text" name="designation_name" id="designation_name" value="">                                             
                                 </div>  
                                 <div class="form-group col-md-12">
                                    <label>Role</label>
                                    <?php echo form_textarea('roles','','class="form-control" id="roles"'); ?>                                             
                                 </div> 
                                 <div class="form-group col-md-12">
                                    <label>Responsibility</label>
                                    <?php echo form_textarea('responsibility','','class="form-control" id="responsibility"'); ?>                                             
                                 </div> 
                                 
                                 <div class="form-group col-md-12">
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
                            <form method="post" action="" id="frmedit" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit Designation Info</strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="designation_id" id="designation_id" value="" />
                            </div>
                            <div class="modal-body"> 
                              <div class="row">   
                                 <div class="form-group col-md-12">
                                    <label>Emp Category</label>
                                    <?php echo form_dropdown('employee_category',array('' => 'Select') + $emp_category_opt,set_value('employee_category') ,' id="employee_category" class="form-control"');?>                                             
                                 </div> 
                                 <div class="form-group col-md-12">
                                    <label>Designation Name</label>
                                    <input class="form-control" type="text" name="designation_name" id="designation_name" value="">                                             
                                 </div>  
                                 <div class="form-group col-md-12">
                                    <label>Role</label>
                                    <?php echo form_textarea('roles','','class="form-control" id="roles"'); ?>                                             
                                 </div> 
                                 <div class="form-group col-md-12">
                                    <label>Responsibility</label>
                                    <?php echo form_textarea('responsibility','','class="form-control" id="responsibility"'); ?>                                             
                                 </div> 
                                 <div class="form-group col-md-12">
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
                
                <div class="modal fade" id="salary_brkup_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmsalary_brkup" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close btn_cancel" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Designation Based Salary Breakup Info</strong></h3>
                                 
                                <input type="hidden" name="designation_id" id="designation_id" value="" />
                                <input type="hidden" name="desgn_salary_brk_id" id="desgn_salary_brk_id" value="" />
                            </div>
                            <div class="modal-body"> 
                                <div class="row">
                                     <div class="form-group col-md-6">
                                        <label>Mode</label>
                                        <input class="form-control" type="text" name="mode" id="mode" readonly="true" value="Add Salary Breakup">                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>Salary BreakUp Type</label>
                                        <?php echo form_dropdown('salary_breakup_id',array('' => 'Select') + $salary_breakup_opt,set_value('salary_breakup_id') ,' id="salary_breakup_id" class="form-control" required="true"');?>                                             
                                     </div> 
                                </div> 
                                <div class="row">    
                                     <div class="form-group col-md-2">
                                        <label>Percentage</label>
                                        <input class="form-control" type="number" step="any" name="salary_breakup_pct" id="salary_breakup_pct" required="true" value="">                                             
                                     </div> 
                                     <div class="form-group col-md-10">
                                        <label>% of Salary BreakUp Type</label>
                                        <?php echo form_dropdown('pct_of_salary_breakup_id[]',array('1' => 'Gross Salary') + $salary_breakup_opt,set_value('pct_of_salary_breakup_id') ,' id="pct_of_salary_breakup_id" class="form-control select2" style="width: 100%;"  multiple="multiple" required="true" ');?>                                             
                                     </div> 
                                </div> 
                                <div class="row">      
                                     <!--<div class="form-group col-md-4">
                                        <label>As On Date</label>
                                        <input class="form-control" type="month" name="as_on_date" id="as_on_date" value="" required="true">                                             
                                     </div>-->
                                     <div class="form-group col-md-4">
                                        <label>Sort Order</label>
                                        <input class="form-control" type="number" step="1" min="0" name="sort_order" id="sort_order" value="1" required="true">                                             
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
                                     <div class="form-group col-md-4">
                                        <a href="<?php echo base_url('asset/images/gross-pay-calc-eg.jpg');?>" target="_blank"><img src="<?php echo base_url('asset/images/gross-pay-calc-eg.jpg');?>" class="img-thumbnail" width="80%" /></a>
                                     </div>
                                 </div>  
                                 <hr />
                                 <div class="brekup_list">
                                    
                                 </div>   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn_cancel" data-dismiss="modal">Cancel</button> 
                                 <input type="submit" name="btn_action" id="btn_action" value="Save"  class="btn btn-primary" />
                            </div> 
                            </form>
                        </div>
                    </div>
                </div>

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
