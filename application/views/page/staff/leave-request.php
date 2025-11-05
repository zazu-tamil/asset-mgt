<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
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
   
  <div class="box box-info">
    <div class="box-header with-border">
      <?php /*if($this->session->userdata(SESS_HD . 'user_type') == 'Staff' ) {  ?>
      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal"><span class="fa fa-plus-circle"></span> Add New </button>
      <?php } */ ?>  
       
    </div>
    <div class="box-body table-responsive"> 
       <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Req.Date</th>   
                <th>Staff</th>   
                <th class="text-center">Leave Date</th>   
                <th>Type</th>   
                <th>Reason</th>   
                <th>Status</th>  
                <th>Comments</th>  
                <th colspan="3" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td><?php echo date('d-m-Y',strtotime($ls['req_date'])) ?><br /><?php echo date('h:i a',strtotime($ls['req_date'])) ?></td>   
                    <td>   
                        <?php echo $ls['staff']?><br />
                        <label class="label label-info"><?php echo $ls['department']?></label><br />
                        <label class="label label-success"><?php echo $ls['designation']?></label>
                    </td>   
                    <td class="text-center"><?php echo date('d-m-Y',strtotime($ls['leave_date']))?></i></td>   
                    <td><?php echo $ls['leave_type']?></td>   
                    <td><?php echo $ls['reason']?></td>   
                    <td><?php echo $ls['status']?></td>   
                    <td><?php echo $ls['comments']?></td>   
                    <?php if(($ls['status'] == 'Pending' || $ls['status'] == 'Revise'  ) && $this->session->userdata(SESS_HD . 'user_type') == 'Staff') {?>
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['leave_request_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['leave_request_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>  
                    <?php } elseif($this->session->userdata(SESS_HD . 'user_type') == 'Admin') {?>
                    <td class="text-center">
                        <?php if($this->session->userdata(SESS_HD . 'user_type') == 'Admin' && ($ls['status'] != 'Approved')) {?>
                        <button value="<?php echo $ls['leave_request_id']?>" class="approval_record btn btn-success btn-xs" title="Approval"><i class="fa fa-legal"></i></button>
                        <?php }  ?>
                    </td>
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['leave_request_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['leave_request_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>                                  
                     <?php } else { echo "<td colspan='3'></td>";}  ?>                                   
                </tr>
                <?php
                    }
                ?>                                 
            </tbody>
      </table> 
        
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group col-sm-6">
            <label>Total Records : <?php echo $total_records;?></label>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $pagination; ?>
        </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

                <div class="modal fade" id="add_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmadd">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Add <?php echo $title; ?></strong></h3>
                                 <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                 <div class="row"> 
                                     <div class="form-group col-md-12">
                                       <label>Leave Date</label>
                                       <input class="form-control" type="date" name="leave_date" id="leave_date" min="<?php echo date('Y-m-d');?>" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-12">
                                        <label>Leave Type</label>
                                        <?php foreach($leave_type_opt as $i =>$leav_typ ) {?>   
                                        <div class="radio">
                                            <label>
                                              <input type="radio" name="leave_type" id="leave_type_<?php echo $i; ?>" value="<?php echo $leav_typ; ?>">
                                              <?php echo $leav_typ; ?>
                                            </label>
                                        </div>   
                                        <?php } ?>                                      
                                     </div> 
                                     <div class="form-group col-md-12">
                                        <label>Reason</label>
                                        <?php echo form_textarea('reason', '',' id="reason" class="form-control"') ?>  
                                     </div> 
                                 </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> 
                                <input type="submit" name="Save" value="Save"  class="btn btn-primary" />
                            </div> 
                            </form>
                        </div>
                    </div>
                </div> 
                
                <div class="modal fade" id="edit_modal" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmedit" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit <?php echo $title; ?> Info</strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="leave_request_id" id="leave_request_id" value="" />
                            </div>
                            <div class="modal-body">
                                  <div class="row">
                                     <div class="form-group col-md-12">
                                       <label>Leave Date</label>
                                       <input class="form-control" type="date" name="leave_date" id="leave_date" min="<?php echo date('Y-m-d');?>" value="" required="true">                                             
                                     </div> 
                                     <div class="form-group col-md-12">
                                        <label>Leave Type</label>
                                        <?php foreach($leave_type_opt as $i =>$leav_typ ) {?>   
                                        <div class="radio">
                                            <label>
                                              <input type="radio" name="leave_type" id="leave_type_<?php echo $i; ?>" value="<?php echo $leav_typ; ?>">
                                              <?php echo $leav_typ; ?>
                                            </label>
                                        </div>   
                                        <?php } ?>                                      
                                     </div> 
                                     <div class="form-group col-md-12">
                                        <label>Reason</label>
                                        <?php echo form_textarea('reason', '',' id="reason" class="form-control"') ?>  
                                     </div> 
                                     <div class="form-group col-md-12">
                                        <label>Leave Status</label>
                                        <?php echo form_dropdown('status', array('' => 'Select') + $leave_status_opt,'',' id="status" class="form-control" required="true"') ?>                                            
                                     </div> 
                                      <div class="form-group col-md-12">
                                        <label>Comment</label>
                                        <?php echo form_textarea('comments', '',' id="comments" class="form-control"') ?>  
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

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
