<?php  include_once(VIEWPATH . '/inc/header.php'); 
//print_r($leave_available);
?>
<section class="content-header">
  <h1>
    Calendar
    <small class="label label-success">Staff Attendance</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Calendar</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!--<div class="box box-info">
        <div class="box-header with-border">
          <h4 class="box-title">Events</h4>
        </div>
        <div class="box-body"> 
             
        </div>
      </div>  -->
      <form method="post" action="" id="frmadd">
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Leave Request</h4>
          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <input type="hidden" name="mode" value="Add Leave Request" />
          </div>     
        </div>
        <div class="box-body"> 
          <div class="form-group">
            <label>Leave Date</label>
            <input class="form-control" type="date" name="leave_date" id="leave_date" min="<?php echo date('Y-m-d');?>" value="" required="true"> 
          </div> 
          <div class="form-group">
            <label>Leave Type</label>
            <?php $av = 0;  foreach($leave_type_opt as $i =>$leav_typ ) {
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
                  <input type="radio" name="leave_type" id="leave_type_<?php echo $i; ?>" value="<?php echo $leav_typ; ?>" <?php echo $d_flg; ?>>
                  <?php echo $leav_typ; ?> - <i class="label label-primary"><?php echo $av; ?></i>
                </label>
            </div>   
            <?php } ?>                                      
         </div> 
         <div class="form-group">
            <label>Reason</label>
            <textarea rows="5" class="form-control" name="reason" id="reason"></textarea> 
         </div> 
         <div class="form-group text-center">
             <button id="btn_leave_request" type="submit" name="btn_leave_request" value="Leave Request" class="btn btn-primary">Send Request</button>
          </div>
        </div>
      </div>    
      </form>   
      <?php if(ENB_ADVANCE == 1) {?>
      <form method="post" action="" id="frmadd_adv">
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Salary Advance Request</h4>
          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <input type="hidden" name="mode" value="Add Salary Advance Request" />
          </div>     
        </div>
        <div class="box-body"> 
          <div class="form-group">
            <label>Required Date</label>
            <input class="form-control" type="date" name="adv_required_date" id="adv_required_date" min="<?php echo date('Y-m-d');?>" value="" required="true"> 
          </div>  
          <div class="form-group">
            <label>Amount</label>
            <input class="form-control" type="number" step="any" name="adv_amount" id="adv_amount" value="" required="true"> 
          </div> 
          <div class="form-group">
            <label>Remarks</label>
            <textarea rows="5" class="form-control" name="remarks" id="remarks"></textarea> 
          </div> 
         <div class="form-group text-center">
             <button id="btn_adv_request" type="submit" name="btn_adv_request" value="Advance Request" class="btn btn-primary">Advance Request</button>
          </div>
        </div>
      </div>    
      </form>  
      <?php } ?> 
      <?php if(ENB_LOAN == 1) {?> 
      <form method="post" action="" id="frmadd_loan">
      <div class="box box-info collapsed-box">
        <div class="box-header with-border">
          <h4 class="box-title">Loan Request</h4>
          <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <input type="hidden" name="mode" value="Add Loan Request" />
          </div>     
        </div>
        <div class="box-body"> 
          <div class="form-group">
            <label>Required Date</label>
            <input class="form-control" type="date" name="loan_required_date" id="loan_required_date" min="<?php echo date('Y-m-d');?>" value="" required="true"> 
          </div>  
          <div class="form-group">
            <label>Loan Tenure [<i class="text-sm">Months</i>]</label>
            <input class="form-control" type="number" step="any" name="loan_tenure" id="loan_tenure" value="" required="true"> 
          </div> 
          <div class="form-group">
            <label>Amount</label>
            <input class="form-control" type="number" step="any" name="loan_amount" id="loan_amount" value="" required="true"> 
          </div> 
          <div class="form-group">
            <label>Remarks</label>
            <textarea rows="5" class="form-control" name="remarks" id="remarks"></textarea> 
          </div> 
         <div class="form-group text-center">
             <button id="btn_loan_request" type="submit" name="btn_loan_request" value="Loan Request" class="btn btn-primary">Loan Request</button>
          </div>
        </div>
      </div>    
      </form>   
      <?php } ?>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-info">
        <div class="box-body no-padding">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
      
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