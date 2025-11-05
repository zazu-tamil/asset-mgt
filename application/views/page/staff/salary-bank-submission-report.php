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
         <form method="post" action="" id="frmsearch">          
         <div class="row">  
             <div class="form-group col-md-3">
                <label>Month</label> 
                <input type="month" name="srch_month" id="srch_month" class="form-control" value="<?php echo set_value('srch_month',$srch_month);?>" />
              </div>
              
             <div class="form-group col-md-3">
                <label>Employee Category</label> 
                <?php echo form_dropdown('srch_emp_category',array('' => 'All') + $emp_category_opt  ,set_value('srch_emp_category',$srch_emp_category) ,' id="srch_emp_category" class="form-control"');?> 
             </div>  
             <?php
	          /* 
             <div class="form-group col-md-3">
                <label>Department</label> 
                <?php echo form_dropdown('srch_department',array('' => 'All') + $department_opt  ,set_value('srch_department',$srch_department) ,' id="srch_department" class="form-control"');?> 
             </div> 
             */ ?>
              <div class="form-group col-md-3 text-right">
                <br />
                <button class="btn btn-success" name="btn_show" value="Show"><i class="fa fa-search"></i> Show</button>
              </div>
         </div>  
        </form>
     </div> 
  </div>   
<?php if(!empty($salary_bank_submit_info)){?>
    <div class="box box-info">
        <div class="box-header with-border">
         <strong class="text-fuchsia">Salary Bank Submission Report [ <?php echo date('F  Y',strtotime($srch_month));?> ] </strong>
        </div>
        <div class="box-body table-responsive "> 
           <table class="table table-hover table-bordered table-striped text-center">
             <tr>
                <th>S.No</th>
                <th>MGT Bank</th>
                <th>Transaction<br />Date</th> 
                <th>Emp.Category</th> 
                <th>No of Employees</th> 
                <th>Remarks</th> 
                <th colspan="2">Action</th>
             </tr>
             <?php 
             foreach($salary_bank_submit_info as $i => $ls) {   $ids = explode(',', $ls['payslip_ids']);
                ?>
                <tr>
                    <td><?php echo ($i + 1); ?></td>
                    <td><?php echo $ls['bank_name']?><br /><i class="badge"><?php echo $ls['account_no']?></i></td>
                    <td><?php echo $ls['transaction_date']?></td> 
                    <td><?php echo ($ls['emp_category'] == '' ? 'All' : $ls['emp_category'])?></td> 
                    <td><?php echo count($ids);?></td> 
                    <td><?php echo $ls['remarks']?></td>  
                    <td class="text-center"> 
                        <a href="<?php echo site_url('print-bank-submission/' .$ls['salary_bank_submit_id'])?>" target="_blank" class="btn btn-xs btn-success" title="Print" ><i class="fa fa-print"></i></a>
                    </td>  
                </tr>
              <?php  } ?>
              
          </table>  
        </div>
        <!-- /.box-body --> 
     </div>
<?php } ?> 
 
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
