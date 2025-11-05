<?php  include_once(VIEWPATH . '/inc/header.php');
/*echo "<pre>";
print_r($attendance); 
echo "</pre>"; */


 ?>
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
         <form method="post" action="<?php echo site_url('staff-salary') ?>" id="frmsearch">          
         <div class="row">  
             <div class="form-group col-md-3">
                <label>Month</label> 
                <input type="month" name="srch_month" id="srch_month" class="form-control" value="<?php echo set_value('srch_month',$srch_month);?>" />
              </div>
              
             <div class="form-group col-md-3">
                <label>Employee Category</label> 
                <?php echo form_dropdown('srch_emp_category',array('' => 'All') + $emp_category_opt  ,set_value('srch_emp_category',$srch_emp_category) ,' id="srch_emp_category" class="form-control"');?> 
              </div>  
             <div class="form-group col-md-3">
                <label>Department</label> 
                <?php echo form_dropdown('srch_department',array('' => 'All') + $department_opt  ,set_value('srch_department',$srch_department) ,' id="srch_department" class="form-control"');?> 
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
     Staff Salary for <?php echo date('F , Y',strtotime($srch_month));?>
    </div>
    <div class="box-body table-responsive "> 
       <table class="table table-hover table-bordered table-striped text-center">
         <tr>
            <th>S.No</th>
            <th>Staff</th>
            <th>Dept & Designation</th>
            <th>WD</th>
            <th>PD</th>
            <th>CL</th>
            <th>SL</th>
            <th>LOP</th> 
            <th>GS</th> 
            <th>D</th> 
            <th>NS</th> 
            <th>CTC</th> 
            <th colspan="2">Action</th>
         </tr>
         <?php foreach($attendance as $emp_code => $ls) { ?>
            <tr>
                <td>#</td>
                <td><?php echo $ls['emp_name']?><br /><i class="badge"><?php echo $emp_code; ?></i></td>
                <td><?php echo $ls['dept']?><br /><?php echo $ls['design']; ?></td>
                <td><?php echo $ls['no_of_days_working']?></td>
                <td><?php echo $ls['no_of_days_presents']?></td>
                <td><?php echo $ls['cl']?></td>
                <td><?php echo $ls['ml']?></td>
                <td><?php echo $ls['lop']?></td> 
                <td><?php echo $ls['gross_salary']?></td> 
                <td><?php echo $ls['deduction']?></td> 
                <td><?php echo $ls['net_salary']?></td> 
                <td><?php echo $ls['ctc']?></td> 
                <?php if($ls['emp_payslip_id'] ==  0) { ?>
                <td colspan="2" class="text-center"> 
                    <a href="<?php echo site_url('attendance-calender/' .$ls['employee_id'].'/'. $srch_month )?>" target="_blank" class="btn btn-xs btn-info" title="Attendance Calender"><i class="fa fa-calendar-o"></i></a>
                </td>
                <?php } else { ?>
                <td class="text-center"> 
                    <a href="<?php echo site_url('print-payslip/' .$ls['emp_payslip_id'])?>" target="_blank" class="btn btn-xs btn-success" title="<?php echo $ls['emp_name']?> - Pay Slip" ><i class="fa fa-print"></i></a>
                </td>
                <td class="text-center">
                    <button value="<?php echo $ls['emp_payslip_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                </td>     
                <?php } ?>
                
            </tr>
          <?php } ?>
      </table>  
    </div>
    <!-- /.box-body -->
    
  </div>
  <!-- /.box -->
    
    
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
