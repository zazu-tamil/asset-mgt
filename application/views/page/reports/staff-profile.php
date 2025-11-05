<?php  include_once(VIEWPATH . '/inc/header.php'); 
/*echo "<pre>";
print_r($emp_list); 
echo "</pre>"; */
?>
 <section class="content-header">
  <h1>Staff Profile Report </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-book"></i> Report</a></li>  
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  
        <div class="box box-info no-print"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white">Search Filter</h3>
            </div>
        <div class="box-body">
             <form method="post" action="" id="frmsearch">          
             <div class="row">  
                  <div class="form-group col-md-3">
                    <label>Employee Category</label> 
                    <?php echo form_dropdown('srch_emp_category',array('' => 'All') + $emp_category_opt  ,set_value('srch_emp_category',$srch_emp_category) ,' id="srch_emp_category" class="form-control"');?> 
                  </div>  
                  <div class="form-group col-md-3">
                    <label>Department</label> 
                    <?php echo form_dropdown('srch_department',array('' => 'All') + $department_opt  ,set_value('srch_department',$srch_department) ,' id="srch_department" class="form-control"');?> 
                  </div>
                  <div class="form-group col-md-4"> 
                    <label>Keyword [Name, Mobile, Emp Code]</label> 
                      <input type="text" class="form-control" id="srch_keyword" name="srch_keyword" value="<?php echo set_value('srch_keyword',$srch_keyword);?>">
                   </div> 
                <div class="form-group col-md-2 text-left">
                    <br />
                    <button class="btn btn-success" name="btn_show" value="Show Reports'"><i class="fa fa-search"></i> Show Reports</button>
                </div>
             </div>  
            </form>
         </div> 
         </div> 
         <?php if(($submit_flg)) { ?>     
         <?php  if(!empty($emp_list)) { ?>    
         <?php foreach($emp_list as $cat => $rec) {   ?>  
         <div class="box box-success"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white"><?php echo $cat; ?> </h3> 
            </div>
            <div class="box-body table-responsive">  
                    <div class="row">
                        <?php foreach($rec as $i => $info) {   ?>  
                        <div class="col-md-4"> 
                              <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile">
                                  <img class="profile-user-img img-responsive img-rounded" src="<?php if(!empty($info['emp_photo'])) echo base_url($info['emp_photo']); else echo base_url('asset/images/user.jpg');?>" alt="User profile picture">
                    
                                  <h4 class="profile-username text-center"><?php echo $info['employee_name'];?></h4>
                    
                                  <p class="text-muted text-center"><?php echo $info['designation'];?> <br /><i><?php echo $info['dept'];?></i></p>
                    
                                  <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                      <b>Code</b> <a class="pull-right"><?php echo $info['employee_code']  ?></a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>DOB</b> <a class="pull-right"><?php echo date('M,d Y', strtotime($info['dob']))  ?></a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>DOJ</b> <a class="pull-right"><?php echo date('M,d Y', strtotime($info['hire_date']))  ?></a>
                                    </li>
                                  </ul>
                                  <div class="noprint">  
                                    <a href="<?php echo site_url('staff-information/'.$info['employee_id']);?>" target="_blank" class="btn btn-primary btn-block"><b>View Profile</b></a>
                                  </div>  
                                </div> 
                              </div>  
                        </div> 
                    <?php } ?> 
                </div> 
            </div> 
         </div> 
         <?php } ?> 
        <?php } ?> 
        <?php } ?> 
            
           
         
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
