<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1><?php echo $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Staff Payroll</a></li> 
    <li><a href="#"><i class="fa fa-cubes"></i> Attendance</a></li> 
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  <!-- Default box -->
  <div class="box box-info no-print"> 
    <div class="box-header with-border">
      <h3 class="box-title text-white">Search Filter</h3>
    </div>
    <div class="box-body">
         <form method="post" action="<?php echo site_url('staff-attendance-list') ?>" id="frmsearch">          
         <div class="row">  
             <div class="form-group col-md-3">
                <label>From Date</label> 
                <input type="date" name="srch_from_date" id="srch_from_date" class="form-control" value="<?php echo set_value('srch_from_date',$srch_from_date);?>" />
              </div>
              <div class="form-group col-md-3">
                <label>To Date</label> 
                <input type="date" name="srch_to_date" id="srch_to_date" class="form-control" value="<?php echo set_value('srch_to_date',$srch_to_date);?>" />
              </div>
             <div class="form-group col-md-3">
                <label>Employee Category</label> 
                <?php echo form_dropdown('srch_emp_category',array('' => 'All') + $emp_category_opt  ,set_value('srch_emp_category',$srch_emp_category) ,' id="srch_emp_category" class="form-control"');?> 
              </div>  
             <div class="form-group col-md-3">
                <label>Department</label> 
                <?php echo form_dropdown('srch_department',array('' => 'All') + $department_opt  ,set_value('srch_department',$srch_department) ,' id="srch_department" class="form-control"');?> 
              </div>
              <div class="form-group col-md-3">
                <label>Name,Code, Mobile</label> 
                <input type="text" name="srch_key" id="srch_key" class="form-control" value="<?php echo set_value('srch_key',$srch_key);?>" />
              </div>
              <div class="form-group col-md-3 text-right">
                <br />
                <button class="btn btn-success" name="btn_show" value="Show"><i class="fa fa-search"></i> Show</button>
              </div>
         </div>  
        </form>
     </div> 
  </div>   
  <div class="box box-info">
    <div class="box-header with-border">
      <?php if($this->session->userdata(SESS_HD . 'user_type') == 'Staff' ) {  ?>
      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal"><span class="fa fa-plus-circle"></span> Add New </button>
      <?php } ?>  
       
    </div>
    <div class="box-body table-responsive"> 
       <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th> 
                <th>Staff</th>  
                <th>In Time</th>   
                <th>Out Time</th>    
                <th colspan="3" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td>   
                        <?php echo $ls['staff']?><br />
                        <label class="label label-info"><?php echo $ls['department']?></label><br />
                        <label class="label label-success"><?php echo $ls['designation']?></label>
                    </td>   
                    <td><?php echo date('d-m-Y ',strtotime($ls['in_time'])) ?><br /><?php echo date('h:i a',strtotime($ls['in_time'])) ?><br /><i class="label label-default"><?php echo date('D',strtotime($ls['in_time'])) ?></i></td>   
                    <td><?php echo date('d-m-Y',strtotime($ls['out_time'])) ?><br /><?php echo date('h:i a',strtotime($ls['out_time'])) ?></td>   
                    <td><?php echo $ls['status']?></td>   
                    <?php if($this->session->userdata(SESS_HD . 'user_type') == 'Admin') {?>
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['emp_attendance_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['emp_attendance_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>  
                    <?php }  ?>   
                                                      
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

                 
                
                <div class="modal fade" id="edit_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmedit" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit <?php echo $title; ?> Info</strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="emp_attendance_id" id="emp_attendance_id" value="" />
                            </div>
                            <div class="modal-body">
                                  <div class="row">
                                     <div class="form-group col-md-6">
                                        <label>Employee Code</label>
                                        <input class="form-control" type="text" name="employee_code" id="employee_code" value="" required="true" readonly="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>In Time</label>
                                        <input class="form-control" type="datetime-local" name="in_time" id="in_time" value="" required="true">                                             
                                     </div> 
                                      <div class="form-group col-md-6">
                                        <label>Out Time</label>
                                        <input class="form-control" type="datetime-local" name="out_time" id="out_time" value="" required="true">                                             
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
