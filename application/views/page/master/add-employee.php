<?php  include_once(VIEWPATH . '/inc/header.php'); 
/*echo "<pre>";
print_r($dyn_fld_opt);
print_r($dyn_fld_val_opt);
echo "</pre>";*/
?>
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
  <form method="post" action="" id="frm_add_emp" enctype="multipart/form-data" class="was-validated">
  <input type="hidden" name="mode" value="Add" />
  <div class="box box-success">
    <div class="box-header with-border">
      <a href="<?php echo site_url('employee-list') ?>" class="btn btn-warning pull-right">Back to Employee List</a>
       
    </div>
    <div class="box-body table-responsive">  
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="emp-tab" >
              <li class="active"><a href="#tab1" data-toggle="tab">Basic Details</a></li>
              <li><a href="#tab2" data-toggle="tab">Contact Details</a></li>
              <li><a href="#tab3" data-toggle="tab">Family Details</a></li>
              <li><a href="#tab4" data-toggle="tab">Social Identity</a></li>
              <li><a href="#tab5" data-toggle="tab">Qualification</a></li>
              <li><a href="#tab8" data-toggle="tab">Bank [ Personal ]</a></li>
              <li><a href="#tab12" data-toggle="tab">Bank [ Salary ]</a></li>
              <li><a href="#tab7" data-toggle="tab">Medical Issue</a></li>
              <li><a href="#tab9" data-toggle="tab">Leave Policy</a></li> 
              <li><a href="#tab10" data-toggle="tab">Salary Data</a></li> 
              <!--<li><a href="#tab11" data-toggle="tab">PF Salary</a></li>--> 
              <li><a href="#tab6" data-toggle="tab">Rolls & Responsibility</a></li> 
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1"> 
                   <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Employee Basic Infomation</h3>
                        </div> 
                        <div class="box-body"> 
                               <div class="row"> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employee Name <span class="text-red">*</span></label>
                                            <input class="form-control " type="text" name="employee_name" id="employee_name" value="" required="true">                                             
                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employee Code <span class="text-red">*</span></label>
                                            <input class="form-control" type="number" name="employee_code" id="employee_code" value="" required="true">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Birth <span class="text-red">*</span></label>
                                            <input class="form-control" type="date" name="dob" id="dob" value="" required="true">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender"  value="Male" checked="true" /> Male 
                                                </label> 
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <label>
                                                     <input type="radio" name="gender"  value="Female"  /> Female
                                                </label>
                                            </div> 
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Emp Category</label>
                                            <?php echo form_dropdown('employee_category',array('' => 'Select') + $emp_category_opt,set_value('employee_category') ,' id="employee_category" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <?php echo form_dropdown('department_id',array('' => 'Select') + $department_opt ,set_value('department_id') ,' id="department_id" class="form-control" required="true"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation <span class="text-red">*</span></label>
                                            <?php echo form_dropdown('designation_id',array('' => 'Select') ,set_value('designation_id') ,' id="designation_id" class="form-control" required="true"');?>                                            
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Joining <span class="text-red">*</span></label>
                                            <input class="form-control" type="date" name="hire_date" id="hire_date" value="" required="true">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input class="form-control" type="file" name="photo_img" id="photo_img" value="" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Marital Status <span class="text-red">*</span></label>
                                            <?php echo form_dropdown('marital_status',array('' => 'Select') + $marital_status_opt ,set_value('marital_status') ,' id="marital_status" class="form-control" required="true"');?>
                                         </div> 
                                    </div>
                                    
                               </div> 
                         </div>      
                    </div>      
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab2">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Employee Contact Infomation</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Permanent Address</label>
                                            <?php echo form_textarea('permanent_address','','id="permanent_address" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Temporary Address</label>
                                            <?php echo form_textarea('temporary_address','','id="temporary_address" class="form-control"');?>                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile <span class="text-red">*</span></label>
                                            <input class="form-control" type="text" name="mobile" id="mobile" value="" required="true">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alternate Mobile</label>
                                            <input class="form-control" type="text" name="alt_mobile" id="alt_mobile" value="" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" id="email" value="" >                                             
                                         </div> 
                                    </div>
                                     
                               </div> 
                         </div>      
                    </div>     
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab3">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Family Infomation</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Family Details'])){
                                    foreach($dyn_fld_opt['Family Details'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,set_value('dyn_fld_opt_val_id') ,'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key ,set_value('dyn_fld_opt_val_id') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',set_value('dyn_fld_opt_val_id'),' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,set_value('dyn_fld_opt_val_id') ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
              
              <div class="tab-pane" id="tab4">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Social Identity</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Social Identity'])){
                                    foreach($dyn_fld_opt['Social Identity'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,set_value('dyn_fld_opt_val_id') ,'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key ,set_value('dyn_fld_opt_val_id') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',set_value('dyn_fld_opt_val_id'),' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,set_value('dyn_fld_opt_val_id') ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
              
              <div class="tab-pane" id="tab5">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Education Details</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Education Details'])){
                                    foreach($dyn_fld_opt['Education Details'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,set_value('dyn_fld_opt_val_id') ,'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key ,set_value('dyn_fld_opt_val_id') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',set_value('dyn_fld_opt_val_id'),' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,set_value('dyn_fld_opt_val_id') ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
              
              <div class="tab-pane" id="tab7">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Medical Issue</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Medical Issue Details'])){
                                    foreach($dyn_fld_opt['Medical Issue Details'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,set_value('dyn_fld_opt_val_id') ,'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key ,set_value('dyn_fld_opt_val_id') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',set_value('dyn_fld_opt_val_id'),' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,set_value('dyn_fld_opt_val_id') ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
              
              
              <div class="tab-pane" id="tab8">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Bank [ Personal Account ]</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Bank - Personal'])){
                                    foreach($dyn_fld_opt['Bank - Personal'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,set_value('dyn_fld_opt_val_id') ,'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key ,set_value('dyn_fld_opt_val_id') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',set_value('dyn_fld_opt_val_id'),' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,set_value('dyn_fld_opt_val_id') ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
              
              
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab6">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Roles & Responsibility</h3>
                        </div> 
                        <div class="box-body">
                             <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Roles</label>
                                            <?php echo form_textarea('roles','','id="roles" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                             </div>
                             <div class="row">       
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Responsibility</label>
                                            <?php echo form_textarea('responsibility','','id="responsibility" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                              </div>  
                        </div>
                 </div>
              </div>  
              
              <div class="tab-pane" id="tab9"> 
                   <div class="box box-solid box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">Leave Policy Infomation</h3>
                        </div> 
                        <div class="box-body"> 
                               <div class="row"> 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Casual Leave</label>
                                            <input class="form-control" type="number" name="casual_leave" id="casual_leave" value="0">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Sick Leave</label>
                                            <input class="form-control" type="number" step="any" name="medical_leave" id="medical_leave" value="0" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Entry Date</label>
                                            <input class="form-control" type="date" name="ason_date_leave_entry" id="ason_date_leave_entry" value="" >                                             
                                         </div> 
                                    </div>  
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>In-Time</label>
                                            <input class="form-control" type="time" name="in_time" id="in_time" value="">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Out-Time</label>
                                            <input class="form-control" type="time" name="out_time" id="out_time" value="">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Permission [Hour]</label>
                                            <input class="form-control" type="number" step="any" name="permission" id="permission" value="0">                                             
                                         </div> 
                                    </div> 
                               </div> 
                         </div>      
                    </div>      
              </div>
              
              <div class="tab-pane" id="tab10"> 
                   <div class="box box-solid box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">Salary Infomation</h3>
                        </div> 
                        <div class="box-body"> 
                               <div class="row"> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fixed Salary</label>
                                            <input class="form-control" type="number" step="any" name="fixed_salary" id="fixed_salary" value="0">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group"> 
                                            <label for="is_esi_pf_req">ESI & PF Required </label> <br />
                                            <input type="checkbox"  name="is_esi_pf_req" id="is_esi_pf_req" value="1" >                                             
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>ESI No</label>
                                            <input class="form-control" type="text" name="esi_no" id="esi_no" value="0">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UAN No [ PF ]</label>
                                            <input class="form-control" type="text" name="uan_no" id="uan_no" value="0">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary Default A/c <span class="text-red">*</span></label>
                                            <?php echo form_dropdown('emp_bank_def_ac',array('' => 'Select Bank A/c') + $emp_bank_def_ac_opt ,set_value('emp_bank_def_ac') ,' id="emp_bank_def_ac" class="form-control" required="true"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group"> 
                                            <label for="enable_loan">Enable Loan Request</label> <br />
                                            <input type="checkbox"  name="enable_loan" id="enable_loan" value="1"  >                                             
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group"> 
                                            <label for="enable_advance">Enable Salary Advance</label> <br />
                                            <input type="checkbox"  name="enable_advance" id="enable_advance" value="1"  >                                             
                                        </div>
                                    </div>
                                   <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Increment</label>
                                            <input class="form-control" type="number" step="any" name="increment_amt" id="increment_amt" value="0" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Increment Date</label>
                                            <input class="form-control" type="date"  name="increment_date" id="increment_date" value="">                                             
                                         </div> 
                                    </div> -->
                               </div> 
                         </div>      
                    </div>      
              </div>
              
              <div class="tab-pane" id="tab11"> 
                   <div class="box box-solid box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title">PF Salary Infomation</h3>
                        </div> 
                        <div class="box-body"> 
                               <div class="row"> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Basic Pay</label>
                                            <input class="form-control" type="number" name="basic_pay" id="basic_pay" value="" />                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DA</label>
                                            <input class="form-control" type="number" step="1" name="da" id="da" value="" />                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>HRA</label>
                                            <input class="form-control" type="number" step="1" name="hra" id="hra" value="" />                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>TA</label>
                                            <input class="form-control" type="number" step="1" name="ta" id="ta" value=""/>                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ESI</label>
                                            <input class="form-control" type="number" step="1" name="esi" id="esi" value=""/>                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>TDS IT</label>
                                            <input class="form-control" type="number" step="1" name="tds_it" id="tds_it" value="" />                                             
                                         </div> 
                                    </div>
                               </div> 
                         </div>      
                    </div>      
              </div>
              
              <div class="tab-pane" id="tab12">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Bank [ Salary Account ]</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Bank - Salary'])){
                                    foreach($dyn_fld_opt['Bank - Salary'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,set_value('dyn_fld_opt_val_id') ,'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key ,set_value('dyn_fld_opt_val_id') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo ($info['dyn_fld_opt_id']);?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',set_value('dyn_fld_opt_val_id'),' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,set_value('dyn_fld_opt_val_id') ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
                     
            </div>
            <!-- /.tab-content -->
          </div>
            <span class="text-red">* Required Feild</span>
    </div> 
    <div class="box-footer text-right">
        <div class="pull-left">
         <a href="<?php echo site_url('employee-list') ?>" class="btn btn-warning">Back to Employee List</a>
        </div>
        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
    </div> 
  </div> 
  </form>  
</section> 
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
