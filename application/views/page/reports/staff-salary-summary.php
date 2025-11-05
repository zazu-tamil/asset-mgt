<?php  include_once(VIEWPATH . '/inc/header.php'); 
//echo "<pre>";
//print_r($emp_list); 
//echo "</pre>"; 
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
                 <div class="form-group col-md-3">
                    <label>Month</label> 
                    <input type="month" name="srch_month" id="srch_month" class="form-control" value="<?php echo set_value('srch_month',$srch_month);?>" />
                  </div> 
                  <div class="form-group col-md-4">
                    <label>Employee Category</label> 
                    <?php echo form_dropdown('srch_emp_category',array('' => 'All') + $emp_category_opt  ,set_value('srch_emp_category',$srch_emp_category) ,' id="srch_emp_category" class="form-control"');?> 
                  </div>  
                  <div class="form-group col-md-4">
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
         <?php if(($submit_flg)) {  ?>         
         <div class="box box-success"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white">Staff Salary Summary Report [ <?php echo date('F Y', strtotime($srch_month.'-01')); ?>] </h3> 
            </div>
            <div class="box-body table-responsive">  
                <?php  if(!empty($emp_list)) { ?>    
                <table class="table table-bordered table-striped" id="content-table">
                    <thead>
                    <tr>
                        <th>SNo</th>
                        <th>Staff Name</th> 
                        <th class="text-right">Salary</th> 
                        <th class="text-right">LOP</th> 
                        <th class="text-right">Gross Salary</th> 
                        <th class="text-right">Deduction</th> 
                        <th class="text-right">Net Salary</th> 
                        <th class="text-right">CTC</th> 
                        
                    </tr> 
                    <tr> 
                        
                    </tr> 
                    </thead>
                    <tbody>
                        <?php foreach($emp_list as $cat => $rec) {   ?>
                        <tr>
                            <th colspan="8">Category : <?php echo $cat ;?></th>
                        </tr>
                        <?php 
                        $tot_2['net_salary'] = $tot_2['ctc'] = 0;
                        foreach($rec as $dept => $rec1) {   ?>
                        <tr>
                            <th colspan="8">Dept : <?php echo $dept ;?></th>
                        </tr> 
                        
                        <?php 
                          $tot_1['net_salary'] = $tot_1['ctc'] = 0;
                        foreach($rec1 as $h => $emp) {  
                            $tot_1['net_salary'] += $emp['net_salary'];
                            $tot_1['ctc'] += $emp['ctc'];
                        ?>
                        <tr>
                            <td><?php echo ($h+1) ;?></td>
                            <td><?php echo $emp['employee_name'] ;?><br /><i class="badge"><?php echo $emp['employee_code'] ;?></i></td>
                            <td class="text-right"><?php echo number_format($emp['fixed_salary'],2) ;?></td>
                            <td class="text-right"><?php echo number_format($emp['lop_amt'],2) ;?></td>  
                            <td class="text-right"><?php echo number_format($emp['gross_salary'],2) ;?></td>  
                            <td class="text-right"><?php echo number_format($emp['deduction'],2) ;?></td>  
                            <td class="text-right"><?php echo number_format($emp['net_salary'],2) ;?></td>  
                            <td class="text-right"><?php echo number_format($emp['ctc'],2) ;?></td>  
                        </tr> 
                        <?php } // EMP ?> 
                        <tr>
                            <th colspan="6" class="text-right">Total : [ <?php echo $dept ;?> ]</th>
                            <td class="text-right"><?php echo number_format($tot_1['net_salary'],2) ;?></th> 
                            <td class="text-right"><?php echo number_format($tot_1['ctc'],2) ;?></th> 
                        </tr>
                        <?php 
                            $tot_2['net_salary'] += $tot_1['net_salary'];
                            $tot_2['ctc'] += $tot_1['ctc'];
                        } // Dep ?>  
                        <tr>
                            <th colspan="6" class="text-right">Total : [ <?php echo $cat ;?> ]</th>
                            <td class="text-right"><?php echo number_format($tot_2['net_salary'],2) ;?></th> 
                            <td class="text-right"><?php echo number_format($tot_2['ctc'],2) ;?></th> 
                        </tr>
                        
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
                    <a class="btn btn-success dl-xls" data="Staff Salary Summary Report [ <?php echo date('F Y', strtotime($srch_month.'-01')); ?>]" title="Download as Excel File">Download as <i class="fa fa-file-excel-o "></i></a>
                </div>
            </div>
            </div> 
            <?php } ?> 
        
            
           
         
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
