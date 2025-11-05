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
      <?php if($record_list == 0) {?>  
      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal"><span class="fa fa-plus-circle"></span> Add New </button>
      <?php } ?>    
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
                <th>PF Details</th>   
                <th>ESI Details</th>   
                <th colspan="2" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td>
                       Max.Limit: <?php echo $ls['pf_salary_max_limit']?><br />
                       Employer : <?php echo $ls['employer_pf']?>%<br />
                       Employee : <?php echo $ls['employee_pf']?>%<br />
                       Admin :<?php echo $ls['admin_pf']?>%<br />
                       Remarks :<br /><?php echo str_replace("\n","\n<br>", $ls['pf_remarks'])?>
                    </td> 
                    <td>
                       Max.Limit: <?php echo $ls['esi_salary_min_limit']?><br />
                       Employer : <?php echo $ls['employer_esi']?>%<br />
                       Employee : <?php echo $ls['employee_esi']?>%<br />
                       Remarks :<br /><?php echo str_replace("\n","\n<br>", $ls['esi_remarks'])?>
                    </td>   
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['esi_pf_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>     
                    <?php /*                             
                    <td class="text-center">
                        <button value="<?php echo $ls['esi_pf_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>   
                    */ ?>                                   
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
                    <div class="modal-dialog modal-lg" role="document">
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
                                     <div class="form-group col-md-12 text-center">
                                        <label class="text-fuchsia">PF Contribution</label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label>Max. Salary Limit </label>
                                        <input class="form-control" type="number" step="any" name="pf_salary_max_limit" id="pf_salary_max_limit" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-9">
                                        <label>PF Salary Includes </label>
                                        <?php echo form_dropdown('pf_salary_include[]', $salary_breakup_opt,set_value('pf_salary_include') ,' id="pf_salary_include" class="form-control select2" style="width: 100%;"  multiple="multiple" required="true" ');?>                                              
                                     </div>
                                  </div>
                                  <div class="row">   
                                     <div class="form-group col-md-4">
                                        <label>Employer</label>
                                        <input class="form-control" type="number" step="any" name="employer_pf" id="employer_pf" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-4">
                                        <label>Employee </label>
                                        <input class="form-control" type="number" step="any" name="employee_pf" id="employee_pf" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-4">
                                        <label>Admin</label>
                                        <input class="form-control" type="number" step="any" name="admin_pf" id="admin_pf" value="" required="true">                                             
                                     </div> 
                                  </div>
                                  <div class="row">       
                                     <div class="form-group col-md-12 text-center">
                                        <label>PF Calculation Remarks</label>
                                        <textarea class="form-control" name="pf_remarks" id="pf_remarks"></textarea>
                                     </div>
                                  </div>
                                  <div class="row">    
                                     <div class="form-group col-md-12 text-center">
                                        <label class="text-fuchsia">ESI Contribution</label>
                                     </div> 
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-3">
                                        <label>ESI Max.Salary Limit </label>
                                        <input class="form-control" type="number" step="any" name="esi_salary_min_limit" id="esi_salary_min_limit" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-9">
                                        <label>ESI Salary Includes </label>
                                        <?php echo form_dropdown('esi_salary_include[]', $salary_breakup_opt,set_value('esi_salary_include') ,' id="esi_salary_include" class="form-control select2" style="width: 100%;"  multiple="multiple" required="true" ');?>                                              
                                     </div>
                                  </div>
                                  <div class="row">   
                                     <div class="form-group col-md-6">
                                        <label>ESI Employer</label>
                                        <input class="form-control" type="number" step="any" name="employer_esi" id="employer_esi" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>ESI Employee</label>
                                        <input class="form-control" type="number" step="any" name="employee_esi" id="employee_esi" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-12 text-center">
                                        <label>ESI Calculation Remarks</label>
                                        <textarea class="form-control" name="esi_remarks" id="esi_remarks"></textarea>
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
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmedit" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit <?php echo $title; ?> Info</strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="esi_pf_id" id="esi_pf_id" value="" />
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                     <div class="form-group col-md-12 text-center">
                                        <label class="text-fuchsia">PF Contribution</label>
                                     </div>
                                     <div class="form-group col-md-3">
                                        <label>Max. Salary Limit </label>
                                        <input class="form-control" type="number" step="any" name="pf_salary_max_limit" id="pf_salary_max_limit" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-9">
                                        <label>PF Salary Includes </label>
                                        <?php echo form_dropdown('pf_salary_include[]', $salary_breakup_opt,set_value('pf_salary_include') ,' id="pf_salary_include" class="form-control select2" style="width: 100%;"  multiple="multiple" required="true" ');?>                                              
                                     </div>
                                  </div>
                                  <div class="row">   
                                     <div class="form-group col-md-4">
                                        <label>Employer</label>
                                        <input class="form-control" type="number" step="any" name="employer_pf" id="employer_pf" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-4">
                                        <label>Employee </label>
                                        <input class="form-control" type="number" step="any" name="employee_pf" id="employee_pf" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-4">
                                        <label>Admin</label>
                                        <input class="form-control" type="number" step="any" name="admin_pf" id="admin_pf" value="" required="true">                                             
                                     </div> 
                                  </div>
                                  <div class="row">       
                                     <div class="form-group col-md-12 text-center">
                                        <label>PF Calculation Remarks</label>
                                        <textarea class="form-control" name="pf_remarks" id="pf_remarks"></textarea>
                                     </div>
                                  </div>
                                  <div class="row">    
                                     <div class="form-group col-md-12 text-center">
                                        <label class="text-fuchsia">ESI Contribution</label>
                                     </div> 
                                  </div>
                                  <div class="row">
                                     <div class="form-group col-md-3">
                                        <label>ESI Max.Salary Limit </label>
                                        <input class="form-control" type="number" step="any" name="esi_salary_min_limit" id="esi_salary_min_limit" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-9">
                                        <label>ESI Salary Includes </label>
                                        <?php echo form_dropdown('esi_salary_include[]', $salary_breakup_opt,set_value('esi_salary_include') ,' id="esi_salary_include" class="form-control select2" style="width: 100%;"  multiple="multiple" required="true" ');?>                                              
                                     </div>
                                  </div>
                                  <div class="row">   
                                     <div class="form-group col-md-6">
                                        <label>ESI Employer</label>
                                        <input class="form-control" type="number" step="any" name="employer_esi" id="employer_esi" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-6">
                                        <label>ESI Employee</label>
                                        <input class="form-control" type="number" step="any" name="employee_esi" id="employee_esi" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-12 text-center">
                                        <label>ESI Calculation Remarks</label>
                                        <textarea class="form-control" name="esi_remarks" id="esi_remarks"></textarea>
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

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
