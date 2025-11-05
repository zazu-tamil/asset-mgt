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
   
  <div class="box box-info no-print"> 
    <div class="box-header with-border">
      <h3 class="box-title text-white">Search Filter</h3>
    </div>
    <div class="box-body">
         <form method="post" action="<?php echo site_url('employee-list') ?>" id="frmsearch">          
         <div class="row">  
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
  <?php
       if( $this->session->userdata('alert_success_msg') !='') {
    	echo '
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert! : '. $this->session->userdata('alert_success_msg') .'</h4>
                
       </div>';
       //$this->session->set_userdata('alert_success_msg', "");
       $this->session->unset_userdata('alert_success_msg');
       }
    ?>
   
  <div class="box box-success">
    <div class="box-header with-border">
      <a href="<?php echo site_url('create-employee')?>" class="btn btn-success mb-1" ><span class="fa fa-user-plus"> </span> Add Employee </a>
      
    </div>
    <div class="box-body table-responsive">
       
       <table class="table table-hover table-bordered table-striped table-responsive">
        <thead> 
            <tr>
                <th>#</th> 
                <th>Category</th>
                <th>Name & <br /> DOB</th>    
                <th>Designation & <br />Department</th>  
                <th>Mobile & <br />Email</th>  
                <th>Status</th>  
                <th colspan="4" class="text-center">Action</th>  
            </tr> 
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td><?php echo $ls['employee_category']?><br /><strong class="badge"><?php echo $ls['employee_code']?></strong></td>  
                    <td><?php echo $ls['employee_name']?><br /><?php echo date('d-m-Y', strtotime($ls['dob'])); ?></td>  
                    <td><?php echo $ls['designation']?><br /><?php echo $ls['department']?></td>  
                    <td><?php echo $ls['mobile']?><?php if(!empty($ls['alt_mobile'])) echo "<br />".$ls['alt_mobile']?><br /><?php echo $ls['email']?></td> 
                    <td><?php echo $ls['status']?></td>   
                    <td class="text-center">
                        <button class="btn btn-info btn-xs btn_add_login" data-toggle="modal" data-target="#login_modal" value="<?php echo $ls['employee_id']?>"><i class="fa fa-key"></i></button>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo site_url('staff-information/'. $ls['employee_id'])?>" class="btn btn-success btn-xs" title="Print" target="_blank"><i class="fa fa-print"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="<?php echo site_url('edit-employee/'. $ls['employee_id'])?>" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['employee_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
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
<div class="modal fade" id="login_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="" id="frmadd">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="scrollmodalLabel"><strong>Employee Login Credentials</strong></h4>
                
                <input type="hidden" name="mode" value="Login Credentials" />
                <input type="hidden" name="user_id" id="user_id" value="" />
                <input type="hidden" name="employee_id" id="employee_id" value="" />
            </div>
            <div class="modal-body">
                 <div class="form-group">
                    <label>User Name</label>
                    <input class="form-control" type="text" name="user_name" id="user_name" value="">                                             
                 </div>  
                 <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="user_pwd" id="user_pwd" value="">                                             
                 </div> 
                 <div class="form-group">
                    <label>Status</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status"  value="Active" checked="true" /> Enable 
                        </label> 
                    </div>
                    <div class="radio">
                        <label>
                             <input type="radio" name="status"  value="InActive"  /> Disable
                        </label>
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

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
