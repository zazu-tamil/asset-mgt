<?php  include_once(VIEWPATH . '/inc/header.php'); 

//print_r($esi_pf_info); 
//print_r($attendance); //is_esi_pf_req

//echo "<pre>"; 
//print_r($attendance);
//print_r($salary_breakup); 
//echo "</pre>"; 
?>
<section class="content-header">
  <h1>
    Calendar : 
    <small class="label label-info"><?php echo $attendance['emp_name']; ?></small>
    <small class="label label-default"><?php echo $attendance['dept']; ?></small>
    <small class="label label-success"><?php echo $attendance['design']; ?></small>
    <i class="label label-info"></i>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Calendar</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-4">
      <form method="post" action="">  
      <div class="box box-info collapsed-box"">
        <div class="box-header with-border">
          <h4 class="box-title">Staff Salary Detail</h4>
             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body "> 
            <?php
               
              // $per_day = round((($attendance['fixed_salary'] * 12) / 365 ),2);
               $per_day = round(($attendance['fixed_salary'] / DEF_WDS_MONTH ),2);
               $lop = ($attendance['no_of_days_working'] - ($attendance['no_of_days_presents'] + $attendance['cl'] + $attendance['ml']));
               //$gp = ($attendance['fixed_salary'] - ($lop * $per_day)); 
               $gp = ( ($attendance['no_of_days_presents'] + $attendance['cl'] + $attendance['ml']) * $per_day); 
               if($attendance['emp_photo'] != '')
                 $emp_photo = base_url($attendance['emp_photo']);
               else 
                 $emp_photo = base_url('asset/images/user1.jpg');
                 
               
            ?>
            <table class="table table-bordered table-condensed table-striped">
                <tr>
                    <th colspan="2" class="text-center">
                        <img src="<?php echo $emp_photo; ?>" class="img-circle img-thumbnail" alt="<?php echo $attendance['emp_name']; ?> " title="<?php echo $attendance['emp_name']; ?>" width="150"  /> 
                    </th>
                </tr>
                <tr>
                    <th>Employee Code :</th>
                    <td>
                        <?php echo $attendance['employee_code']; ?>
                        <input type="hidden" name="mode" id="mode" value="Add Employee Pay Slip" />
                        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $attendance['employee_id']; ?>" />
                        <input type="hidden" name="employee_code" id="employee_code" value="<?php echo $attendance['employee_code']; ?>" />
                        <input type="hidden" name="payslip_month" id="payslip_month" value="<?php echo $c_mon; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Name :</th>
                    <td>
                        <?php echo $attendance['emp_name']; ?> 
                    </td>
                </tr>
                <tr>
                    <th>Department :</th>
                    <td>
                        <?php echo $attendance['dept']; ?>
                        <input type="hidden" name="department" id="department" value="<?php echo $attendance['dept']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Designation :</th>
                    <td>
                        <?php echo $attendance['design']; ?>
                        <input type="hidden" name="designation" id="designation" value="<?php echo $attendance['design']; ?>" />
                    </td>
                </tr>
                <?php if($attendance['is_esi_pf_req'] == '1') { ?>
                <tr>
                    <th>ESI No :</th>
                    <td>
                        
                        <?php echo $attendance['esi_no']; ?> 
                        <input type="hidden" name="esi_no" id="esi_no" value="<?php echo $attendance['esi_no']; ?>" /> 
                    </td>
                </tr>
                <tr>
                    <th>PF No :</th>
                    <td>
                        <?php echo $attendance['pf_no']; ?> 
                        <input type="hidden" name="pf_no" id="pf_no" value="<?php echo $attendance['pf_no']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>UAN No :</th>
                    <td>
                        <?php echo $attendance['uan_no']; ?> 
                        <input type="hidden" name="uan_no" id="uan_no" value="<?php echo $attendance['uan_no']; ?>" />
                    </td>
                </tr>
                
                <?php } ?>
                <tr>
                    <th>Salary :</th>
                    <td>
                        <?php echo $attendance['fixed_salary']; ?>
                        <input type="hidden" name="fixed_salary" id="fixed_salary" value="<?php echo $attendance['fixed_salary']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Working Days [AVG] :</th>
                    <td>
                        <?php echo $attendance['no_of_days_working']; ?>
                        <input type="hidden" name="working_days" id="working_days" value="<?php echo $attendance['no_of_days_working']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Days Present:</th>
                    <td>
                        <?php echo $attendance['no_of_days_presents']; ?>
                        <input type="hidden" name="days_presents" id="days_presents" value="<?php echo $attendance['no_of_days_presents']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Casual Leave Taken :</th>
                    <td>
                        <?php echo $attendance['cl']; ?>
                        <input type="hidden" name="cl" id="cl" value="<?php echo $attendance['cl']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Sick Leave Taken :</th>
                    <td>
                        <?php echo $attendance['ml']; ?>
                        <input type="hidden" name="ml" id="ml" value="<?php echo $attendance['ml']; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>LOP Request :</th>
                    <td>
                        <?php echo $attendance['lop']; ?>
                    </td>
                </tr>
                <tr>
                    <th>LOP Days :</th>
                    <td>
                        <?php echo $lop; ?>
                        
                        <input type="hidden" name="lop_day" id="lop_day" value="<?php echo $lop; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Salary Per Day :</th>
                    <td>
                        <?php echo $per_day; ?>
                        <input type="hidden" name="per_day_salary" id="per_day_salary" value="<?php echo $per_day; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Gross Salary :</th>
                    <td class="text-right">
                        <?php echo number_format($gp,2); ?>
                        <input type="hidden" name="gross_salary" id="gross_salary" value="<?php echo $gp; ?>" /> 
                    </td>
                </tr> 
            </table>
           
        </div>
      </div>  
      
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Salary BreakUp</h4> 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body "> 
            <table class="table table-bordered table-condensed table-striped">
                <?php $breakup['1'] = $gp; $tot = 0;
                foreach($salary_breakup as $salary_breakup_id => $ls){ 
                  $breakup[$ls['salary_breakup_id']] = round(($breakup[$ls['pct_of_salary_breakup_id']] * $ls['salary_breakup_pct'] / 100),2);
                   $tot += $breakup[$ls['salary_breakup_id']]; 
                ?>
                <tr>
                    <th><?php echo $ls['salary_breakup_name']?> :</th>
                    <td><i class="fa fa-info-circle bg-info" data-toggle="tooltip" data-placement="top" title="<?php echo $ls['details']; ?>"></i></td>
                    <td class="text-right">
                        <?php echo number_format($breakup[$ls['salary_breakup_id']],2); ?>
                        <input type="hidden" name="salary_breakup_id[]" value="<?php echo $salary_breakup_id; ?>" />
                        <input type="hidden" name="salary_breakup_amt[]" value="<?php echo $breakup[$ls['salary_breakup_id']]; ?>" />
                        <input type="hidden" name="breakup_name[]" value="<?php echo $ls['salary_breakup_name']; ?>" />
                        <input type="hidden" name="breakup_calc[]" value="<?php echo $ls['details']; ?>" />
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <th colspan="2">Gross Salary</th>
                    <th class="text-right"><?php echo number_format($tot,2); ?></th>
                </tr>
            </table>
        </div> 
      </div>
      
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Salary Deduction</h4> 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body "> 
            <?php 
            
            if($attendance['is_esi_pf_req'] == '1') { 
            
            // PF Calculation 
            $pf_salary_include = explode(',', $esi_pf_info['pf_salary_include']);
            $pf_wages = 0;
            foreach($pf_salary_include as $sbrk){
              if(isset($breakup[$sbrk]))  
                $pf_wages += $breakup[$sbrk];
            }
            $empee_pf = 0;
            $emper_pf = 0;
            $admin_pf = 0;
            $empee_pf_det = '';
            $emper_pf_det = '';
            $admin_pf_det = '';
            if($pf_wages <= $esi_pf_info['pf_salary_max_limit']) {
                $empee_pf = ($pf_wages * $esi_pf_info['employee_pf'] / 100);
                $empee_pf_det = $esi_pf_info['employee_pf'] . "% of " . $pf_wages ;
                $emper_pf = ($pf_wages * $esi_pf_info['employer_pf'] / 100);
                $emper_pf_det = $esi_pf_info['employer_pf'] . "% of " . $pf_wages ;
                $admin_pf = ($pf_wages * $esi_pf_info['admin_pf'] / 100);
                $admin_pf_det = $esi_pf_info['admin_pf'] . "% of " . $pf_wages ;
            } else {
                $empee_pf = ($esi_pf_info['pf_salary_max_limit'] * $esi_pf_info['employee_pf'] / 100);
                $empee_pf_det = $esi_pf_info['employee_pf'] . "% of " . $esi_pf_info['pf_salary_max_limit'] ;
                $emper_pf = ($esi_pf_info['pf_salary_max_limit'] * $esi_pf_info['employee_pf'] / 100);
                $emper_pf_det = $esi_pf_info['employer_pf'] . "% of " . $esi_pf_info['pf_salary_max_limit'] ;
                $admin_pf = ($esi_pf_info['pf_salary_max_limit'] * $esi_pf_info['admin_pf'] / 100);
                $admin_pf_det = $esi_pf_info['admin_pf'] . "% of " . $esi_pf_info['pf_salary_max_limit'] ;
            }
            
            
            // ESI Calculation
            
            $esi_salary_include = explode(',', $esi_pf_info['esi_salary_include']);
            $esi_wages = 0;
            foreach($esi_salary_include as $sbrk){
              if(isset($breakup[$sbrk]))  
                $esi_wages += $breakup[$sbrk];
            }
            $empee_esi = 0;
            $empee_esi_det = $emper_esi_det = '';
            $emper_esi = 0;
            if($esi_wages <= $esi_pf_info['pf_salary_max_limit']) {
                $empee_esi = ($esi_wages * $esi_pf_info['employee_esi'] / 100);
                $empee_esi_det = $esi_pf_info['employee_esi'] . "% of ". $esi_wages; 
                $emper_esi = ($esi_wages * $esi_pf_info['employer_esi'] / 100);
                $emper_esi_det = $esi_pf_info['employer_esi'] . "% of ". $esi_wages; 
            } else {
                $empee_esi = 0;
                $emper_esi_det = $empee_esi_det = "ESI Not Applicable";
                $emper_esi = 0;
            }
            
            $ctc = ($tot + $emper_pf + $admin_pf + $empee_pf  + $emper_esi + $empee_esi); 
            } else {
                $empee_pf = $empee_esi = 0;
                $emper_pf = $emper_esi = 0;
                $admin_pf = 0;
                $ctc = ($tot + $emper_pf + $admin_pf + $empee_pf  + $emper_esi + $empee_esi); 
            }
            
            $salary_adv =  $attendance['salary_adv'];  
            $pay_emi =  $attendance['pay_emi'];  
            
            $deduction = $empee_pf + $empee_esi + $salary_adv + $pay_emi;
            ?>
            <table class="table table-bordered table-condensed table-striped">
                <tr>
                    <th>Gross Salary</th>
                    <th class="text-right"><?php echo number_format($tot,2); ?></th>
                </tr> 
                <?php
                   if($attendance['is_esi_pf_req'] == '1') {
                ?>
                <tr>
                    <th>Employee PF  [ <?php echo $esi_pf_info['employee_pf'];?>% ] : </th>
                    <th class="text-right">
                        <?php echo number_format($empee_pf,2); ?>
                        <input type="hidden" name="emp_loan_id[]" value="" />
                        <input type="hidden" name="deduction_name[]" value="Employee PF" />
                        <input type="hidden" name="deduction_amt[]" value="<?php echo $empee_pf; ?>" />
                        <input type="hidden" name="deduction_details[]" value="<?php echo $empee_pf_det; ?>" />
                    </th> 
                </tr>
                <tr>
                    <th>ESI [ <?php echo $esi_pf_info['employee_esi'];?>% ] : </th>
                    <th class="text-right">
                        <?php echo number_format($empee_esi,2); ?>
                        <input type="hidden" name="emp_loan_id[]" value="" />
                        <input type="hidden" name="deduction_name[]" value="ESI" />
                        <input type="hidden" name="deduction_amt[]" value="<?php echo $empee_esi; ?>" />
                        <input type="hidden" name="deduction_details[]" value="<?php echo $empee_esi_det; ?>" />
                    </th>  
                </tr>
                <?php } ?>
                <?php if($salary_adv > 0 ) { ?>
                <tr>
                    <th>Salary Advance : </th>
                    <th class="text-right">
                        <?php echo number_format($salary_adv,2); ?>
                        <input type="hidden" name="emp_loan_id[]" value="" />
                        <input type="hidden" name="deduction_name[]" value="Salary Advance" />
                        <input type="hidden" name="deduction_amt[]" value="<?php echo $salary_adv; ?>" />
                        <input type="hidden" name="deduction_details[]" value="<?php echo $salary_adv; ?>" />
                    </th>  
                </tr>
                 <?php } ?>
                 <?php if($pay_emi > 0 ) { ?>
                <tr>
                    <th>Loan EMI : </th>
                    <th class="text-right">
                        <?php echo number_format($pay_emi,2); ?>
                        <input type="hidden" name="emp_loan_id[]" value="<?php echo $attendance['emp_loan_id']; ?>" />
                        <input type="hidden" name="deduction_name[]" value="Loan" />
                        <input type="hidden" name="deduction_amt[]" value="<?php echo $pay_emi; ?>" />
                        <input type="hidden" name="deduction_details[]" value="EMI : <?php echo $attendance['pay_emi']; ?>\n Loan Amount: <?php echo $attendance['loan_amount']; ?>\n Loan Paid: <?php echo $attendance['loan_paid']; ?>\n Loan Outstanding: <?php echo $attendance['outstanding']; ?>" />
                    </th>  
                </tr>
                 <?php } ?>
                <tr>
                    <th class="text-green">Net Salary</th>
                    <th class="text-right text-green">
                        <?php echo number_format(($tot - ($deduction)),2); ?>
                        <input type="hidden" name="deduction" id="deduction" value="<?php echo $deduction; ?>" /> 
                        <input type="hidden" name="net_salary" id="net_salary" value="<?php echo ($tot - $deduction); ?>" /> 
                     </th>
                </tr> 
            </table> 
        </div>  
      </div>
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Employee Bank Account</h4> 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body">  
             <table class="table table-bordered table-condensed table-striped"> 
                <?php
	            foreach($emp_bank_account as $l => $det){ 
                ?>
                <tr>
                    <th>
                        <?php echo $det['dyn_fld_opt_name']; ?>
                        <input type="hidden" name="fld_name[]" value="<?php echo $det['dyn_fld_opt_name']; ?>" /> 
                    </th> 
                    <td>
                        <?php echo $det['fld_value']; ?>
                        <input type="hidden" name="fld_value[]" value="<?php echo $det['fld_value']; ?>" /> 
                    </td> 
                </tr>
                <?php } ?>
             </table>   
        </div>
      </div>  
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Cost To Company [ CTC ]</h4> 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <div class="box-body">  
            <table class="table table-bordered table-condensed table-striped">
                <tr>
                    <th>Gross Salary</th>
                    <th class="text-right"><?php echo number_format($tot,2); ?></th>
                </tr>
                <?php
                   if($attendance['is_esi_pf_req'] == '1') {
                ?>
                <tr>
                    <th>Employer PF  [ <?php echo $esi_pf_info['employer_pf'];?>% ] : </th>
                    <th class="text-right">
                        <?php echo number_format($emper_pf,2); ?>
                        <input type="hidden" name="ctc_name[]" value="Employer PF" />
                        <input type="hidden" name="ctc_amt[]" value="<?php echo $emper_pf; ?>" />
                        <input type="hidden" name="ctc_details[]" value="<?php echo $emper_pf_det; ?>" />
                    </th> 
                </tr>
                <tr>
                    <th>Admin [ <?php echo $esi_pf_info['admin_pf'];?>% ] : </th>
                    <th class="text-right">
                        <?php echo number_format($admin_pf,2); ?>
                        <input type="hidden" name="ctc_name[]" value="Admin" />
                        <input type="hidden" name="ctc_amt[]" value="<?php echo $admin_pf; ?>" />
                        <input type="hidden" name="ctc_details[]" value="<?php echo $admin_pf_det; ?>" />
                    </th> 
                </tr>
                <tr>
                    <th>ESI [ <?php echo $esi_pf_info['employer_esi'];?>% ] : </th>
                    <th class="text-right">
                        <?php echo number_format($emper_esi,2); ?>
                        <input type="hidden" name="ctc_name[]" value="ESI" />
                        <input type="hidden" name="ctc_amt[]" value="<?php echo $emper_esi; ?>" />
                        <input type="hidden" name="ctc_details[]" value="<?php echo $emper_esi_det; ?>" />
                    </th> 
                </tr>
                <tr>
                    <th>Employee ESI & PF</th> 
                    <th class="text-right">
                        <?php echo number_format(($empee_pf + $empee_esi),2); ?>
                        <input type="hidden" name="ctc_name[]" value="Employee ESI & PF" />
                        <input type="hidden" name="ctc_amt[]" value="<?php echo ($empee_pf + $empee_esi); ?>" />
                        <input type="hidden" name="ctc_details[]" value="<?php echo ($empee_pf  . ' + ' . $empee_esi); ?>" />    
                    </th> 
                    
                </tr>
                <?php
                  }
                ?>
                <tr>
                    <th class="text-fuchsia">Cost To Company</th>
                    <th class="text-right text-fuchsia">
                    <?php echo number_format($ctc,2); ?>
                    <input type="hidden" name="ctc" id="ctc" value="<?php echo $ctc; ?>" />
                    </th>
                </tr>
            </table> 
        </div> 
         <div class="box-footer text-center">
         <button type="sumbit" class="btn btn-success" name="btnsave" value=""><i class="fa fa-save"> </i> Generate Payslip</button>
        </div>
      </div> 
      
      </form>
    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>  
         
        </div>
        <!-- /.box-body -->
      </div>
       
      <form method="post" action="">
      <div class="box box-info collapsed-box"">
        <div class="box-header with-border">
          <h4 class="box-title">Add Staff Attendance</h4>
             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body "> 
            <div class="row"> 
                 <div class="form-group col-md-6">
                    <label>In Time</label>
                    <input class="form-control" type="datetime-local" name="in_time" id="in_time" min="<?php echo $c_mon."-01T00:00:00"; ?>" max="<?php echo date("Y-m-t", strtotime($c_mon.'-01'))."T23:59:00"; ?>"   value="" required="true">                                             
                 </div> 
                  <div class="form-group col-md-6">
                    <label>Out Time</label>
                    <input class="form-control" type="datetime-local" name="out_time" id="out_time" min="<?php echo $c_mon."-01T12:00:00"; ?>" max="<?php echo date("Y-m-t", strtotime($c_mon.'-01'))."T23:59:00"; ?>"  value="" required="true">                                             
                 </div> 
                 
             </div>  
        </div> 
        <div class="box-footer text-right"> 
             <input type="hidden" name="mode" id="mode" value="Add Attendance"  class="form-control"  />
             <input type="hidden" name="employee_code" id="employee_code" value="<?php echo $attendance['employee_code']; ?>"  class="form-control"  />
             <input type="submit" name="Save" value="Save"  class="btn btn-primary" />
        </div>
      </div>
      </form> 
      
      <div class="modal fade" id="A_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="" id="frmedit" class="form-material">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit Attendance Info</strong></h3>
                    <input type="hidden" name="mode" value="Edit Attendance" />
                    <input type="hidden" name="emp_attendance_id" id="emp_attendance_id" value="" />
                    <input type="hidden" name="employee_code" id="employee_code" value="" />
                </div>
                <div class="modal-body">
                      <div class="row"> 
                         <div class="form-group col-md-12">
                            <label>In Time</label>
                            <input class="form-control" type="datetime-local" name="in_time" id="in_time" min="<?php echo $c_mon."-01T00:00:00"; ?>" max="<?php echo date("Y-m-t", strtotime($c_mon.'-01'))."T23:59:00"; ?>" value="" required="true">                                             
                         </div> 
                          <div class="form-group col-md-12">
                            <label>Out Time</label>
                            <input class="form-control" type="datetime-local" name="out_time" id="out_time" min="<?php echo $c_mon."-01T00:00:00"; ?>" max="<?php echo date("Y-m-t", strtotime($c_mon.'-01'))."T23:59:00"; ?>" value="" required="true">                                             
                         </div> 
                     </div> 
                     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                    <input type="submit" name="Save" value="Update"  class="btn btn-primary" />
                </div> 
                </form>
            </div>
        </div>
    </div>
      
      <div class="modal fade" id="L_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form method="post" action="" id="frmedit" class="form-material">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit Leave Request Info</strong></h3>
                    <input type="hidden" name="mode" value="Edit Leave Request" />
                    <input type="hidden" name="leave_request_id" id="leave_request_id" value="" />
                </div>
                <div class="modal-body"> 
                   <div class="row">   
                      <div class="form-group col-md-6">
                        <label>Leave Date</label>
                        <input class="form-control" type="date" name="leave_date" id="leave_date" min="<?php echo date('Y-m-d');?>" value="" required="true"> 
                      </div> 
                      <div class="form-group col-md-6">
                        <label>Leave Type</label>
                        <?php $av = 0; foreach($leave_type_opt as $i =>$leav_typ ) { 
                            if($leav_typ == 'Casual Leave'){ 
                                $av = $leave_available['casual_leave'];
                                $d_flg = ($leave_available['casual_leave'] <= 0 ? 'disabled="true"' : ''); 
                            } elseif($leav_typ == 'Medical Leave') {
                                $av = $leave_available['medical_leave'];
                                 $d_flg = ($leave_available['medical_leave'] <= 0 ? 'disabled="true"' : '');
                            } elseif($leav_typ == 'Loss Of Pay') {
                                $av = $leave_available['lop'];
                                $d_flg = "";
                            }
                        ?>   
                        <div class="radio">
                            <label>
                              <input type="radio" name="leave_type" id="leave_type_<?php echo $i; ?>" value="<?php echo $leav_typ; ?>" <?php echo $d_flg; ?> >
                              <?php echo $leav_typ; ?> - <i class="label label-primary"><?php echo $av; ?></i>
                            </label>
                        </div>   
                        <?php } ?>                                      
                      </div> 
                     <div class="form-group col-md-6">
                        <label>Reason</label>
                         <textarea rows="5" class="form-control" name="reason" id="reason" required="true"></textarea>  
                     </div> 
                     <div class="form-group col-md-6">
                        <label>Comments</label>
                         <textarea rows="5" class="form-control" name="comments" id="comments" required="true"></textarea> 
                     </div> 
                     <div class="form-group col-md-6">
                        <label>Status</label>
                        <div class="radio">
                            <label>
                              <input type="radio" name="status" value="Pending">
                              Pending 
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp; 
                            <label>
                             <input type="radio" name="status" value="Cancel">
                              Cancel 
                            </label>
                        </div>    
                     </div> 
                  </div>         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                    <input type="submit" name="Save" value="Update"  class="btn btn-primary" />
                </div> 
                </form>
            </div>
        </div>
    </div>
      
      <div class="modal fade" id="H_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" action="" id="frmedit" class="form-material">
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit Holidays Info</strong></h3>
                    <input type="hidden" name="mode" value="Edit Holidays" />
                    <input type="hidden" name="holiday_id" id="holiday_id" value="" />
                </div>
                <div class="modal-body"> 
                         <div class="form-group">
                            <label>Holiday Date</label>
                            <input class="form-control" type="date" name="holiday_date" id="holiday_date" value="" required="true">                                             
                         </div>  
                         <div class="form-group">
                            <label>Holiday Name</label>
                            <input class="form-control" type="text" name="holiday_det" id="holiday_det" value="" required="true">                                             
                         </div>  
                         <div class="form-group">
                            <label>Status</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status"  value="Active" checked="true" /> Active 
                                </label> 
                            </div>
                            <div class="radio">
                                <label>
                                     <input type="radio" name="status"  value="InActive"  /> InActive
                                </label>
                            </div> 
                         </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                    <input type="submit" name="Save" value="Update"  class="btn btn-primary" />
                </div> 
                </form>
            </div>
        </div>
    </div>
      
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

 
  
  <?php  include_once(VIEWPATH . 'inc/footer.php'); ?>