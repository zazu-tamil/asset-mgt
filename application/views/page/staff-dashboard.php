<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
<!--
<?php  //print_r($emp_info); ?>
<?php // print_r($leave_available); ?>
<?php // print_r($attendance); ?>
-->
 
<!-- Main content -->
    <section class="content">
       <div class="row"> 
        <div class="col-lg-12">
            <div class="page-header">
                <div class="label label-info">Welcome <?php echo $emp_info['employee_name'] . " [ " . $emp_info['designation'] . ' - ' .$emp_info['department']. ' ]';?></div>
                <div class="pull-right label label-success"><?php echo date('h:i a',strtotime($emp_info['in_time'])) . " - " . date('h:i a',strtotime($emp_info['out_time']));?></div>
            </div>
        </div> 
       </div> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-ticket"></i></span> 
            <div class="info-box-content text-center">
              <span class="info-box-text">Helpdesk</span>
              <span class="info-box-number "><a href="<?php echo site_url('ticket-list') ?>" target="_blank"><?php echo number_format($ticket,0); ?></a></span> 
              <strong class="text-fuchsia">Support Ticket</strong> 
            </div> 
          </div> 
        </div> 
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-flag-checkered"></i></span> 
            <div class="info-box-content text-center">
              <span class="info-box-text">Casual Leave</span>
              <span class="info-box-number "><?php echo ($emp_info['casual_leave'] - ( isset($staff_leave_taken['Casual Leave']) ? $staff_leave_taken['Casual Leave'] : 0 )); ?> Days</span> 
              <strong class="text-fuchsia"> Available</strong> 
            </div> 
          </div> 
        </div> 
        
        
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-flag-checkered"></i></span> 
            <div class="info-box-content text-center">
              <span class="info-box-text">Sick Leave</span>
              <span class="info-box-number "><?php echo ($emp_info['medical_leave'] - ( isset($staff_leave_taken['Medical Leave']) ? $staff_leave_taken['Medical Leave'] : 0 )); ?> Days</span> 
              <strong class="text-fuchsia">Available</strong> 
            </div> 
          </div> 
        </div> 
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-hand-paper-o"></i></span> 
            <div class="info-box-content text-center">
              <span class="info-box-text">Attendance</span>
              <span class="info-box-number "><?php echo ( isset($staff_leave_taken['LOP']) ? $staff_leave_taken['LOP'] : 0 ); ?> Days</span> 
              <strong class="text-fuchsia"> Present</strong> 
            </div> 
          </div> 
        </div> 
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-rupee"></i></span> 
            <div class="info-box-content text-center">
              <span class="info-box-text">Salary</span>
              <span class="info-box-number "><?php echo number_format((isset($emp_info['no_of_days_present']) ? $emp_info['pay'] : 0 ), 2); ?></span> 
              <strong class="text-fuchsia"> At Present</strong> 
            </div> 
          </div> 
        </div> 
        <?php if($emp_info['outstanding'] > 0 ) { ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green-gradient"><i class="fa fa-rupee"></i></span> 
            <div class="info-box-content text-center">
              <span class="info-box-text">Loan </span>
              <span class="info-box-number "><?php echo number_format($emp_info['outstanding'], 2); ?></span> 
              <strong class="text-fuchsia"> Outstanding</strong> 
            </div> 
          </div> 
        </div> 
        <?php } ?> 
        
      </div>
      <!-- /.row -->
      <div class="row"> 
        <div class="col-md-4">
             <div class="box box-primary ">
                <div class="box-header">
                  <h3 class="box-title text-maroon">Notice Board  </h3> 
                   <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-red txt_cnt" data-original-title="0 Notice Messages">0</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div> 
                <div class="box-body"> 
                  <marquee width="100%" scrollamount="3" direction="up" height="250px" loop="-1" onMouseOver="this.stop()" onMouseOut="this.start()">
                    <div id="notice"> 
                    </div>
                  </marquee>  
                </div>  
              </div>  
        </div>
         <div class="col-md-4">
            <div class="box box-primary ">
                <div class="box-header">
                  <h3 class="box-title">-</h3> 
                </div> 
                <div class="box-body sts"> 
                  
                </div>  
              </div> 
        </div>
         <div class="col-md-4">
            <div class="box box-primary ">
                <div class="box-header ">
                  <h3 class="box-title">-</h3> 
                </div> 
                <div class="box-body"> 
                  
                </div>  
              </div> 
        </div>
      </div>
      <div class="row"> 
        <?php if(!empty($emp_loan_request)) {?>  
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Loan Requests</h3> 
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>#</th> 
                        <th>Req.Date</th> 
                        <th>Loan %</th> 
                        <th>Tenure</th> 
                        <th>Loan Amount</th> 
                        <th>EMI</th> 
                        <th>Outstanding</th> 
                        <th>Remarks</th> 
                        <th>Status</th> 
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($emp_loan_request as $k =>$info) {?>
                      <tr>
                        <td><?php echo ($k + 1);?></td>
                        <td class="text-center"><?php echo date('d-m-Y',strtotime($info['loan_required_date']))?></td>  
                        <td><?php echo $info['loan_pct']?></td>  
                        <td><?php echo $info['loan_tenure']?></td>  
                        <td><?php echo $info['loan_amount']?></td>  
                        <td><?php echo $info['loan_emi']?></td>  
                        <td><?php //echo $info['loan_emi']?></td>  
                        <td><?php echo $info['remarks']?></td>  
                        <td><?php echo $info['status']?></td>  
                      </tr>
                      <?php } ?>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body --> 
              </div>
        </div>
        <?php } ?>  
       <?php if(!empty($emp_adv_request)) {?>  
       <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Salary Advance Requests</h3> 
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>#</th> 
                        <th>Req.Date</th> 
                        <th>Amount</th> 
                        <th>Status</th> 
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($emp_adv_request as $k =>$info) {?>
                      <tr>
                        <td><?php echo ($k + 1);?></td>
                        <td class="text-center"><?php echo date('d-m-Y',strtotime($info['adv_required_date']))?></td>  
                        <td><?php echo $info['adv_amount']?></td>  
                        <td><?php echo $info['status']?></td>  
                      </tr>
                      <?php } ?>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body --> 
              </div>
        </div>  
         <?php } ?> 
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Leave Requests</h3> 
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>#</th> 
                        <th>Req.Date</th>
                        <th>Leave Date</th>
                        <th>Type</th>
                        <th>Reason</th> 
                        <th>Comments</th> 
                        <th>Status</th> 
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($emp_leave_request as $k =>$info) {?>
                      <tr>
                        <td><?php echo ($k + 1);?></td>
                        <td><?php echo date('d-m-Y',strtotime($info['req_date'])) ?><br /><?php echo date('h:i a',strtotime($info['req_date'])) ?></td>
                        <td class="text-center"><?php echo date('d-m-Y',strtotime($info['leave_date']))?></td> 
                        <td><?php echo $info['leave_type']?></td> 
                        <td><?php echo $info['reason']?></td> 
                        <td><?php echo $info['comments']?></td> 
                        <td><?php echo $info['status']?></td>  
                      </tr>
                      <?php } ?>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body --> 
              </div>
        </div>
        
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Attendance</h3> 
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>#</th> 
                        <th>Date</th>
                        <th>In</th>
                        <th>Out</th>
                        <th>Late Hr</th> 
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($attendance as $k =>$info) {?>
                      <tr>
                        <td><?php echo ($k + 1);?></td>
                        <td><?php echo date('d-m-Y [D]',strtotime($info['in_time'])) ?></td>
                        <td class="text-center"><?php echo date('h:i a',strtotime($info['in_time']))?></td> 
                        <td class="text-center"><?php echo date('h:i a',strtotime($info['out_time']))?></td> 
                        <td><?php if($info['late_sec'] > 0 ) echo date('H:i',strtotime($info['late_time'])); else echo '-'; ?></td>  
                      </tr>
                      <?php } ?>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body --> 
              </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Last 6 Month Salary</h3> 
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> 
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                      <tr>
                        <th>#</th> 
                        <th>Month</th>
                        <th>WD</th>
                        <th>PD</th>
                        <th>CL</th>
                        <th>ML</th>
                        <th>LOP</th>
                        <th>Salary</th> 
                        <th>Print</th> 
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($payslip as $k =>$info) {?>
                      <tr>
                        <td><?php echo ($k + 1);?></td>
                        <td><?php echo date('M Y',strtotime($info['payslip_month'].'-01')) ?></td>  
                        <td><?php echo $info['working_days']?></td>  
                        <td><?php echo $info['days_presents']?></td>  
                        <td><?php echo $info['cl']?></td>  
                        <td><?php echo $info['ml']?></td>  
                        <td><?php echo $info['lop_day']?></td>  
                        <td class="text-right"><?php echo number_format($info['net_salary'],2)?></td>  
                        <td class="text-center"> 
                            <a href="<?php echo site_url('print-payslip/' .$info['emp_payslip_id'])?>" target="_blank" class="btn btn-xs btn-success" ><i class="fa fa-print"></i></a>
                        </td> 
                      </tr>
                      <?php } ?>
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.box-body --> 
              </div>
        </div>  
      </div>
    </section>
    <!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
