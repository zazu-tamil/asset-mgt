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
<?php if(!empty($payslip)){?>
  <form method="post" action="" id="frmbank">             
  <div class="box box-info">
    <div class="box-header with-border">
     <strong class="text-fuchsia"><?php echo date('F  Y',strtotime($srch_month));?> Month Salary Details</strong>
    </div>
    <div class="box-body table-responsive "> 
       <table class="table table-hover table-bordered table-striped text-center">
         <tr>
            <th>S.No</th>
            <th>Staff</th>
            <th>Dept & Designation</th> 
            <th>GS</th> 
            <th>D</th> 
            <th>NS</th> 
            <th>CTC</th> 
            <th colspan="2">Action</th>
         </tr>
         <?php $k =1; 
            $tot['gs'] = $tot['ded'] = $tot['ns'] = $tot['ctc'] = 0;
         foreach($payslip as $payslip_id => $ls) { 
            $tot['gs'] += $ls['gross_salary'];
            $tot['ded'] += $ls['deduction'];
            $tot['ns'] += $ls['net_salary'];
            $tot['ctc'] += $ls['ctc'];
            ?>
            <tr>
                <td><?php echo $k; ?></td>
                <td><?php echo $ls['emp_name']?><br /><i class="badge"><?php echo $ls['employee_code']?></i></td>
                <td><?php echo $ls['dept']?><br /><?php echo $ls['design']; ?></td> 
                <td><?php echo number_format($ls['gross_salary'],2)?></td> 
                <td><?php echo number_format($ls['deduction'],2)?></td> 
                <td><?php echo number_format($ls['net_salary'],2)?></td> 
                <td><?php echo number_format($ls['ctc'],2)?></td>  
               <?php
                /*
                <!--<td class="text-center"> 
                    <a href="<?php echo site_url('print-payslip/' .$ls['emp_payslip_id'])?>" target="_blank" class="btn btn-xs btn-success" title="<?php echo $ls['emp_name']?> - Pay Slip" ><i class="fa fa-print"></i></a>
                </td>-->
                */
                ?>
                <td class="text-center">
                    <?php if($ls['salary_bank_submit_id'] == '0') {?>
                     <input type="checkbox" class="payslip_ids" name="payslip_ids[]" value="<?php echo $payslip_id; ?>" />
                    <?php } else { ?>
                        <i class="text-red">Already<br />Generated</i>
                    <?php }  ?>
                </td>    
            </tr>
          <?php $k++; } ?>
          <tr>
            <th colspan="3">Total</th>
            <th class="text-center"><?php echo number_format($tot['gs'],2);?></th> 
            <th class="text-center"><?php echo number_format($tot['ded'],2);?></th> 
            <th class="text-center"><?php echo number_format($tot['ns'],2);?></th> 
            <th class="text-center"><?php echo number_format($tot['ctc'],2);?></th> 
            <th class="text-center">
                <input type="checkbox" name="selectall" id="selectall" value="1" />
                <br />
                <label for="selectall" class="text-info">Select All</label>
            </th> 

          </tr>
      </table>  
    </div>
    <!-- /.box-body --> 
 </div>
<!-- /.box -->
 <div class="box box-info">
    <div class="box-header with-border">
      <strong class="text-fuchsia"> Salary Bank Submission Generate</strong>
    </div>
    <div class="box-body "> 
        <div class="row">
            <div class="form-group col-md-3">
                <label>Transaction Date</label>
                <input type="date" class="form-control" name="transaction_date" id="transaction_date" value="" required="true" /> 
            </div>
            <div class="form-group col-md-4">
                <label>MGT Bank A/c</label>
                <?php echo form_dropdown('mgt_bank_id',array('' => 'Select Bank A/c') + $mgt_bank_opt  ,set_value('mgt_bank_id') ,' id="mgt_bank_id" class="form-control" required="true"');?>
            </div>
            <div class="form-group col-md-5">
                <label>Remarks</label>
                <textarea class="form-control" name="remarks" id="remarks"></textarea> 
            </div>
            <div class="form-group col-md-12 text-center">
                <input type="hidden" name="mode" value="Add Bank Submission" />
                <input type="hidden" name="payslip_month" value="<?php echo $srch_month; ?>" />
                <input type="hidden" name="emp_category" value="<?php echo $srch_emp_category; ?>" />
                <!--<input type="hidden" name="department" value="<?php echo $srch_department;?>" />-->
                <button type="submit" name="btn_save" class="btn btn-success"><i class="fa fa-save"></i> Generate</button>
            </div>
        </div>
    </div>
    <!-- /.box-body --> 
 </div>  
 </form> 
 <?php } ?>   
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
