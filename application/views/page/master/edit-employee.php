<?php  include_once(VIEWPATH . '/inc/header.php'); 
//  echo "<pre>";
//print_r($record_list);
//print_r($dyn_list);
//print_r($dyn_fld_opt);
//print_r($dyn_fld_val_opt);
//echo "</pre>"; 
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
  <form method="post" action="" id="frm_add_emp" enctype="multipart/form-data">
  <input type="hidden" name="mode" value="Edit" />
  <div class="box box-success">
    <div class="box-header with-border">
        <strong class="text-fuchsia">Employee : <?php echo $record_list['employee_name'] . ' [ ' . $record_list['employee_category'] . ' - ' . $designation_opt[$record_list['designation_id']]. ' ]'; ?></strong>
      <a href="<?php echo site_url('employee-list') ?>" class="btn btn-warning pull-right">Back to Employee List</a>
       
    </div>
    <div class="box-body table-responsive">  
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
              <!--<li><a href="#tab11" data-toggle="tab">PF Salary</a></li> -->
              <li><a href="#tab6" data-toggle="tab">Rolls & Responsibility</a></li> 
              <li><a href="#tab-doc" data-toggle="tab">Documents Upload</a></li> 
              
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
                                            <input class="form-control" type="text" name="employee_name" id="employee_name" value="<?php echo $record_list['employee_name']?>" required="true">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Employee Code <span class="text-red">*</span></label>
                                            <input class="form-control" type="number" name="employee_code" id="employee_code" value="<?php echo $record_list['employee_code']?>" required="true">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Birth <span class="text-red">*</span></label>
                                            <input class="form-control" type="date" name="dob" id="dob" value="<?php echo $record_list['dob']?>" required="true">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender"  value="Male" <?php echo ($record_list['gender'] == 'Male' ? 'checked="true"': '')?>  /> Male 
                                                </label> 
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <label>
                                                     <input type="radio" name="gender"  value="Female"  <?php echo ($record_list['gender'] == 'Female' ? 'checked="true"': '')?>  /> Female
                                                </label>
                                            </div> 
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Emp Category</label>
                                            <?php echo form_dropdown('employee_category',array('' => 'Select') + $emp_category_opt,set_value('employee_category',$record_list['employee_category']) ,' id="employee_category" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Department <span class="text-red">*</span></label>
                                            <?php echo form_dropdown('department_id',array('' => 'Select') + $department_opt ,set_value('department_id',$record_list['department_id']) ,' id="department_id" class="form-control" required="true"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation <span class="text-red">*</span></label>
                                            <?php echo form_dropdown('designation_id',array('' => 'Select')+ $designation_opt ,set_value('designation_id',$record_list['designation_id']) ,' id="designation_id" class="form-control" required="true"');?>                                            
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Joining <span class="text-red">*</span></label>
                                            <input class="form-control" type="date" name="hire_date" id="hire_date" value="<?php echo $record_list['hire_date']?>" required="true">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input class="form-control" type="file" name="photo_img" id="photo_img" >                                             
                                            <input type="hidden" name="photo_img_path" id="photo_img_path" value="<?php echo $record_list['photo_img']?>" />
                                            <div class="img_preview">
                                                <?php if($record_list['photo_img'] != '') {?>
                                                <img src="<?php echo base_url($record_list['photo_img']);?>" alt="" class="img-thumbnail" width="100" />
                                                <?php } else { ?>
                                                   <img src="<?php echo base_url('emp_photo/user.jpg');?>" alt="" class="img-thumbnail" width="100" /> 
                                                <?php } ?>
                                            </div>
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Marital Status <span class="text-red">*</span></label>
                                            <?php echo form_dropdown('marital_status',array('' => 'Select') + $marital_status_opt ,set_value('marital_status',$record_list['marital_status']) ,' id="marital_status" class="form-control" required="true"');?>
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Emp Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status"  value="Active"  <?php echo ($record_list['status'] == 'Active' ? 'checked="true"': '')?> /> Active 
                                                </label> 
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <label>
                                                     <input type="radio" name="status"  value="Releaved"  <?php echo ($record_list['status'] == 'Releaved' ? 'checked="true"': '')?> /> Releaved
                                                </label>
                                            </div> 
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
                                            <?php echo form_textarea('permanent_address',set_value('permanent_address',$record_list['permanent_address']),'id="permanent_address" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Temporary Address</label>
                                            <?php echo form_textarea('temporary_address',set_value('temporary_address',$record_list['temporary_address']),'id="temporary_address" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile <span class="text-red">*</span></label>
                                            <input class="form-control" type="text" name="mobile" id="mobile" value="<?php echo $record_list['mobile']?>" required="true">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alternate Mobile</label>
                                            <input class="form-control" type="text" name="alt_mobile" id="alt_mobile" value="<?php echo $record_list['alt_mobile']?>" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" id="email" value="<?php echo $record_list['email']?>" >                                             
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
                                            <input type="hidden" name="employee_fld_opt_id[<?php echo $info['dyn_fld_opt_id'];?>]"   class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id'])) echo $dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id']; ?>" />
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                             
                                        
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'])) echo $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) { ?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,(in_array($key, explode(',',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']))),'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'],' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ,'  class="form-control"');?>
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
                                            <input type="hidden" name="employee_fld_opt_id[<?php echo $info['dyn_fld_opt_id'];?>]"   class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id'])) echo $dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id']; ?>" />
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                             
                                        
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'])) echo $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,(in_array($key, explode(',',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']))),'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'],' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ,'  class="form-control"');?>
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
                                            <input type="hidden" name="employee_fld_opt_id[<?php echo $info['dyn_fld_opt_id'];?>]"   class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id'])) echo $dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id']; ?>" />
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                             
                                        
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'])) echo $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,(in_array($key, explode(',',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']))),'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'],' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ,'  class="form-control"');?>
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
                                            <input type="hidden" name="employee_fld_opt_id[<?php echo $info['dyn_fld_opt_id'];?>]"   class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id'])) echo $dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id']; ?>" />
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                             
                                        
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'])) echo $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) { ?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key ,(in_array($key, explode(',',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']))),'');?>
                                            <?php echo $value;?>
                                              </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'],' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ,'  class="form-control"');?>
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
                                            <input type="hidden" name="employee_fld_opt_id[<?php echo $info['dyn_fld_opt_id'];?>]"   class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id'])) echo $dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id']; ?>" />
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                             
                                        
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']))  echo $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False'),'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'],' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ,'  class="form-control"');?>
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
              
              <div class="tab-pane" id="tab12">
                <div class="box box-solid box-info">
                        <div class="box-header with-border">
                          <h3 class="box-title">Bank [ Salary Account]</h3>
                        </div> 
                        <div class="box-body">
                               <div class="row"> 
                                    <?php 
                                    if(isset($dyn_fld_opt['Bank - Salary'])){
                                    foreach($dyn_fld_opt['Bank - Salary'] as $k => $info){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="employee_fld_opt_id[<?php echo $info['dyn_fld_opt_id'];?>]"   class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id'])) echo $dyn_list[$info['dyn_fld_opt_id']]['employee_fld_opt_id']; ?>" />
                                            <input type="hidden" name="dyn_fld_opt_id[]" id="dyn_fld_opt_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php echo $info['dyn_fld_opt_id']; ?>" />
                                             
                                        
                                            <?php if($info['dyn_fld_opt_type'] == 'text' || $info['dyn_fld_opt_type'] == 'date') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <input type="<?php echo $info['dyn_fld_opt_type'];?>" name="dyn_fld_opt_val_id[<?php echo $info['dyn_fld_opt_id'];?>]" id="dyn_fld_opt_val_id_<?php echo $info['dyn_fld_opt_id'];?>" class="form-control" value="<?php if(isset($dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values']))  echo $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'];  ?>" >
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'checkbox' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="checkbox">
                                            <label>
                                            <?php echo form_checkbox('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']['. $key .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False'),'');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'radio' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php foreach($dyn_fld_val_opt[$info['dyn_fld_opt_id']] as $key => $value){?> 
                                            <div class="radio">
                                            <label>
                                            <?php echo form_radio('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $key , ($key == $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ? 'True' : 'False') ,' ');?>
                                            <?php echo $value;?>
                                            </label>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($info['dyn_fld_opt_type'] == 'textarea') {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_textarea('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']', $dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'],' id="dyn_fld_opt_val_id_'. $info['dyn_fld_opt_id'].'" class="form-control"');?>
                                            <?php } ?>
                                            <?php if($info['dyn_fld_opt_type'] == 'Dropdown' && (isset($dyn_fld_val_opt[$info['dyn_fld_opt_id']]))) {?>
                                            <label><?php echo $info['dyn_fld_opt_name']; ?></label>
                                            <?php echo form_dropdown('dyn_fld_opt_val_id['. $info['dyn_fld_opt_id'] .']',array('' => 'Select') + $dyn_fld_val_opt[$info['dyn_fld_opt_id']] ,$dyn_list[$info['dyn_fld_opt_id']]['dyn_fld_opt_values'] ,'  class="form-control"');?>
                                            <?php } ?>
                                             
                                         </div> 
                                    </div>
                                    <?php } ?>
                                    <?php } ?> 
                               </div> 
                         </div>      
                    </div> 
              </div>
              
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
                                            <?php echo form_textarea('roles',$record_list['responsibility'],'id="roles" class="form-control"');?>                                             
                                         </div> 
                                    </div>
                             </div>
                             <div class="row">       
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Responsibility</label>
                                            <?php echo form_textarea('responsibility',$record_list['responsibility'],'id="responsibility" class="form-control"');?>                                          
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
                                            <input class="form-control" type="number" name="casual_leave" id="casual_leave" value="<?php echo $record_list['casual_leave']?>">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Sick Leave</label>
                                            <input class="form-control" type="number" step="any" name="medical_leave" id="medical_leave" value="<?php echo $record_list['medical_leave']?>" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Entry Date</label>
                                            <input class="form-control" type="date" name="ason_date_leave_entry" id="ason_date_leave_entry" value="<?php echo $record_list['ason_date_leave_entry']?>" >                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>In-Time</label>
                                            <input class="form-control" type="time" name="in_time" id="in_time" value="<?php echo $record_list['in_time']?>">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Out-Time</label>
                                            <input class="form-control" type="time" name="out_time" id="out_time" value="<?php echo $record_list['out_time']?>">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Permission [Hour]</label>
                                            <input class="form-control" type="number" step="any" name="permission" id="permission" value="<?php echo $record_list['permission']?>">                                             
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
                                            <input class="form-control" type="number" name="fixed_salary" id="fixed_salary" value="<?php echo $record_list['fixed_salary']?>" >                                             
                                         </div> 
                                    </div>
                                    
                                    <div class="col-md-3 text-center">
                                        <div class="form-group"> 
                                            <label for="is_esi_pf_req">ESI & PF Required</label> <br />
                                            <input type="checkbox"  name="is_esi_pf_req" id="is_esi_pf_req" value="1" <?php if($record_list['is_esi_pf_req'] == '1') echo "checked='true'"; ?> >                                             
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>ESI No</label>
                                            <input class="form-control" type="text" name="esi_no" id="esi_no" value="<?php echo $record_list['esi_no']?>">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>UAN No [ PF ]</label>
                                            <input class="form-control" type="text" name="uan_no" id="uan_no" value="<?php echo $record_list['uan_no']?>">                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Salary Default A/c </label>
                                            <?php echo form_dropdown('emp_bank_def_ac',array('' => 'Select Bank A/c') + $emp_bank_def_ac_opt ,set_value('emp_bank_def_ac',$record_list['emp_bank_def_ac']) ,' id="emp_bank_def_ac" class="form-control" ');?>                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group"> 
                                            <label for="enable_loan">Enable Loan Request</label> <br />
                                            <input type="checkbox"  name="enable_loan" id="enable_loan" value="1" <?php if($record_list['enable_loan'] == '1') echo "checked='true'"; ?> >                                             
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group"> 
                                            <label for="enable_advance">Enable Salary Advance</label> <br />
                                            <input type="checkbox"  name="enable_advance" id="enable_advance" value="1" <?php if($record_list['enable_advance'] == '1') echo "checked='true'"; ?> >                                             
                                        </div>
                                    </div>
                                   <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Increment</label>
                                            <input class="form-control" type="number" step="any" name="increment_amt" id="increment_amt" value="<?php echo $record_list['increment_amt']?>" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Increment Date</label>
                                            <input class="form-control" type="date"  name="increment_date" id="increment_date" value="<?php echo $record_list['increment_date']?>" >                                             
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
                                            <input class="form-control" type="number" name="basic_pay" id="basic_pay" value="<?php echo $record_list['basic_pay']?>" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>DA</label>
                                            <input class="form-control" type="number" step="1" name="da" id="da" value="<?php echo $record_list['da']?>" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>HRA</label>
                                            <input class="form-control" type="number" step="1" name="hra" id="hra" value="<?php echo $record_list['hra']?>" >                                             
                                         </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>TA</label>
                                            <input class="form-control" type="number" step="1" name="ta" id="ta" value="<?php echo $record_list['ta']?>">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ESI</label>
                                            <input class="form-control" type="number" step="1" name="esi" id="esi" value="<?php echo $record_list['esi']?>">                                             
                                         </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>TDS IT</label>
                                            <input class="form-control" type="number" step="1" name="tds_it" id="tds_it" value="<?php echo $record_list['tds_it']?>">                                             
                                         </div> 
                                    </div>
                               </div> 
                         </div>      
                    </div>      
              </div>
              
               
              <div class="tab-pane" id="tab-doc">
                 <div class="box box-solid box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Document Upload</h3>
                      <div class="pull-right">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_doc_modal" ><i class="fa fa-plus-circle"></i> Add New</button>
                      </div>
                    </div> 
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>#</th>
                                <th>Doc Category</th>
                                <th>Remarks</th>
                                <th>View</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        
                         <?php 
                            if(isset($emp_doc_list)){
                            foreach($emp_doc_list as $k => $doc){
                         ?>
                            <tr>
                                <td><?php echo ($k+1);?></td>
                                <td><?php echo $doc['doc_upload_type_name'];?></td>
                                <td><?php echo $doc['remarks'];?></td>
                                <td><a href="<?php echo base_url($doc['doc_path']);?>" target="_blank"  class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                                <td class="text-center">
                                    <button type="button" data-toggle="modal" data-target="#edit_doc_modal" value="<?php echo $doc['emp_doc_upload_id']?>" class="edit_doc_emp btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                                </td>                                  
                                <td class="text-center">
                                    <button value="<?php echo $doc['emp_doc_upload_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                                </td>
                            </tr>
                         <?php
	                       }
	                       }
                        ?>
                        </table>
                    </div>
                 </div> 
              </div>        
            </div>
            <!-- /.tab-content -->
          </div>
        <span class="text-red">* Required  Feild</span>
    </div> 
    <div class="box-footer text-right">
        <div class="pull-left">
         <a href="<?php echo site_url('employee-list') ?>" class="btn btn-warning">Back to Employee List</a>
        </div>
        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Update</button>
    </div> 
  </div> 
  </form>  
    <div class="modal fade" id="add_doc_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form method="post" action="" id="frmadd" enctype="multipart/form-data">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="scrollmodalLabel">Add Emploayee Doc Upload</h3>
                    <input type="hidden" name="mode" value="Add Doc" />
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>"  />
                    <input type="hidden" name="employee_code" id="employee_code" value="<?php echo $record_list['employee_code']?>">  
                </div>
                <div class="modal-body">
                     <div class="form-group ">
                        <label>Doc Category <span class="text-red">*</span></label>
                         <?php echo form_dropdown('doc_upload_type_id', array('' => 'Select') + $doc_category_opt, set_value('doc_upload_type_id'),'class="form-control" id="doc_upload_type_id" required="true"') ?>                                            
                     </div>  
                     <div class="form-group ">
                        <label>Upload Doc <span class="text-red">*</span></label>
                        <input type="file" name="doc_file" id="doc_file" class="form-control" required="true" /> 
                                                                   
                        <input type="hidden" name="emp_doc_path" id="emp_doc_path" class="form-control" />                                            
                     </div>
                     <div class="form-group ">
                        <label>Remarks</label>
                        <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>                                           
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
    
    <div class="modal fade" id="edit_doc_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form method="post" action="" id="frmadd" enctype="multipart/form-data">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="scrollmodalLabel">Add Emploayee Doc Upload</h3>
                    <input type="hidden" name="mode" value="Edit Doc" />
                    <input type="hidden" name="emp_doc_upload_id" id="emp_doc_upload_id" />
                    <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>"  />
                    <input type="hidden" name="employee_code" id="employee_code" value="<?php echo $record_list['employee_code']?>">  
                </div>
                <div class="modal-body">
                     <div class="form-group ">
                        <label>Doc Category <span class="text-red">*</span></label>
                         <?php echo form_dropdown('doc_upload_type_id', array('' => 'Select') + $doc_category_opt, set_value('doc_upload_type_id'),'class="form-control" id="doc_upload_type_id" required="true"') ?>                                            
                     </div>  
                     <div class="form-group ">
                        <label>Upload Doc <span class="text-red">*</span></label>
                        <input type="file" name="doc_file" id="doc_file" class="form-control" required="true" />                                            
                     </div>
                     <div class="form-group ">
                        <label>Remarks</label>
                        <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>                                           
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
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
