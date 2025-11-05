<?php  include_once(VIEWPATH . '/inc/header.php'); 
/* echo "<pre>";
print_r($emp_list);
print_r($leave_list);
echo "</pre>"; */
?>
 <section class="content-header">
  <h1>Staff Leave Summary Report </h1>
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
                 <?php /*
	               <div class="form-group col-md-3"> 
                    <label>From Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control" id="srch_from_date" name="srch_from_date" value="<?php echo set_value('srch_from_date',$srch_from_date);?>">
                    </div>
                    <!-- /.input group -->                                             
                 </div> 
                 <div class="form-group col-md-3"> 
                    <label>To Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control" id="srch_to_date" name="srch_to_date" value="<?php echo set_value('srch_to_date',$srch_to_date);?>">
                    </div>
                    <!-- /.input group -->                                             
                 </div>
                   */ ?> 
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
         <?php if(($submit_flg)) {  
            $start = '-' . date('m', strtotime(ACADEMIC_YEAR_START));
            $end = date('m', strtotime(ACADEMIC_YEAR_END)); 
            ?>         
         <div class="box box-success"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white">Staff Leave Summary Report [ ACADEMIC YEAR : <?php echo date('Y', strtotime(ACADEMIC_YEAR_START)); ?> - <?php echo date('Y', strtotime(ACADEMIC_YEAR_END)); ?>] </h3> 
            </div>
            <div class="box-body table-responsive">  
                <?php  if(!empty($emp_list)) { ?>    
                <table class="table table-bordered table-striped" id="content-table">
                    <thead>
                    <tr>
                        <th rowspan="2">SNo</th>
                        <th rowspan="2">Staff Name</th> 
                        <th colspan="2">Opening</th> 
                        <?php  
                        for($i=$start; $i<=$end;$i++) {  
                          echo "<th colspan='2'>" . date('M-y', strtotime("$i months")) . "</th>";
                        }
                        ?>  
                        <th colspan="2">Closing</th> 
                    </tr> 
                    <tr> 
                        <?php  
                          echo "<th>CL</th>";
                          echo "<th>SL</th>";      
                        for($i=$start; $i<=$end;$i++) {  
                          echo "<th>CL</th>";
                          echo "<th>SL</th>";
                        }
                          echo "<th>CL</th>";
                          echo "<th>SL</th>";   
                        ?>   
                    </tr> 
                    </thead>
                    <tbody>
                        <?php foreach($emp_list as $cat => $rec) {   ?>
                        <tr>
                            <th colspan="32">Category : <?php echo $cat ;?></th>
                        </tr>
                        <?php foreach($rec as $dept => $rec1) {   ?>
                        <tr>
                            <th colspan="32">Dept : <?php echo $dept ;?></th>
                        </tr> 
                        
                        <?php foreach($rec1 as $h => $emp) {   ?>
                        <tr>
                            <td><?php echo ($h+1) ;?></td>
                            <td><?php echo $emp['employee_name'] ;?><br /><i class="badge"><?php echo $emp['employee_code'] ;?></i></td>
                            <td><?php echo $emp['casual_leave'] ;?></td>
                            <td><?php echo $emp['medical_leave'] ;?></td>
                            <?php  $cl = $ml= 0;
                            for($i=$start; $i<=$end;$i++) {  $k = date('Ym', strtotime("$i months"));
                                if(isset($leave_list[$emp['employee_id']][$k])) {
                                  echo "<td>" . $leave_list[$emp['employee_id']][$k]['casual_leave_taken'] . "</td>"; 
                                  echo "<td>" . $leave_list[$emp['employee_id']][$k]['medical_leave_taken'] . "</td>"; 
                                   $cl += $leave_list[$emp['employee_id']][$k]['casual_leave_taken'];
                                   $ml += $leave_list[$emp['employee_id']][$k]['medical_leave_taken'];
                                } else {
                                   echo "<td>-</td>";  
                                   echo "<td>-</td>";  
                                }
                            }
                            ?>  
                             <td><?php echo (($emp['casual_leave'] == '' ? 0 : ($emp['casual_leave'])) - $cl) ;?></td>
                             <td><?php echo (($emp['medical_leave'] == '' ? 0 : ($emp['medical_leave'])) - $ml) ;?></td>
                        </tr> 
                        <?php } // EMP ?> 
                        
                        <?php } // Dep ?>  
                        
                        <?php } // Cat ?>  
                        
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
        
            
           
         
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
