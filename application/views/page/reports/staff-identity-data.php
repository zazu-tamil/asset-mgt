<?php  include_once(VIEWPATH . '/inc/header.php'); 
/*echo "<pre>";
print_r($emp_list); 
print_r($dyn_fld); 
print_r($identity); 
echo "</pre>"; */
//exit();
?>
 <section class="content-header">
  <h1><?php echo $title; ?></h1>
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
         <?php if(($submit_flg)) {   ?>         
         <div class="box box-success"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white"><?php echo $title; ?> </h3> 
            </div>
            <div class="box-body table-responsive">  
                <?php  if(!empty($emp_list)) { ?>    
                <table class="table table-bordered table-striped" id="content-table">
                    <thead>
                    <tr>
                        <th>SNo</th>
                        <th>Staff Name</th> 
                        <th>Department</th> 
                        <th>UAN[PF]</th> 
                        <th>ESI</th>  
                        <?php foreach($dyn_fld as $fld => $val) {   ?> 
                        <th><?php echo $fld; ?></th> 
                        <?php } ?>
                    </tr> 
                     
                    </thead>
                    <tbody>
                        <?php foreach($emp_list as $cat => $det) {   ?> 
                            <tr>
                                <th colspan="<?php echo (count($dyn_fld) + 5); ?>"><?php echo $cat; ?></th>
                            </tr>
                            <?php $k=0; foreach($det as $id => $ls) { $k++;  ?> 
                            <tr>
                                <td><?php echo $k; ?></td>
                                <td><?php echo $ls['employee_name']; ?></td>
                                <td><?php echo $ls['dept']; ?></td>
                                <td><?php echo $ls['uan_no']; ?></td>
                                <td><?php echo $ls['esi_no']; ?></td>
                                <?php foreach($dyn_fld as $fld => $val) {   ?> 
                                <td><?php if(isset($identity[$id][$fld])) echo $identity[$id][$fld]; ?></td> 
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                     
                </table>  
            </div>
            <div class="box-footer with-border no-print ">
                
                <div class="form-group col-sm-6 text-right"> 
                    <button type="button" name="btn_print" class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                </div>
                <div class="form-group col-sm-6 text-right"> 
                    <a class="btn btn-success dl-xls" data="Satff Leave Summary Report" title="Download as Excel File">Download as <i class="fa fa-file-excel-o "></i></a>
                </div>
            </div>
            </div> 
            <?php } ?> 
            <?php } ?> 
        
            
           
         
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
