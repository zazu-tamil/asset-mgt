<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1><?php echo $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Master</a></li> 
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  <!-- Default box -->
   
  <div class="box box-info">
    <div class="box-header with-border">
      <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#add_modal"><span class="fa fa-plus-circle"></span> Add New </button>
        
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
         
      </div>
    </div>
    <div class="box-body table-responsive"> 
       <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Bank Name</th>   
                <th>Account No</th>   
                <th>Account Holder</th>   
                <th>Branch</th>   
                <th>IFSC</th>   
                <th>Remarks</th>   
                <th>Status</th>  
                <th colspan="2" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td><?php echo $ls['bank_name']?></td>   
                    <td><?php echo $ls['account_no']?></td>   
                    <td><?php echo $ls['account_holder_name']?></td>   
                    <td><?php echo $ls['branch']?></td>   
                    <td><?php echo $ls['ifsc']?></td>   
                    <td><?php echo $ls['remarks']?></td>   
                    <td><?php echo $ls['status']?></td>   
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#edit_modal" value="<?php echo $ls['mgt_bank_id']?>" class="edit_record btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['mgt_bank_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
                    </td>                                      
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
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmadd">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Add <?php echo $title ; ?></strong></h3>
                                
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                 <div class="row">
                                     <div class="form-group col-md-6">
                                        <label>Bank Name</label>
                                        <input class="form-control" type="text" name="bank_name" id="bank_name" value="" required="true">                                             
                                     </div>  
                                     <div class="form-group col-md-6">
                                        <label>Account No</label>
                                        <input class="form-control" type="text" name="account_no" id="account_no" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>Account Holder Name</label>
                                        <input class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>Branch</label>
                                        <input class="form-control" type="text" name="branch" id="branch" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>IFSC</label>
                                        <input class="form-control" type="text" name="ifsc" id="ifsc" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
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
                                     <div class="form-group col-md-12">
                                        <label>Remarks</label>
                                        <textarea class="form-control"  name="remarks" id="remarks"></textarea>                                             
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
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <form method="post" action="" id="frmedit" class="form-material">
                            <div class="modal-header">
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit <?php echo $title ; ?></strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="mgt_bank_id" id="mgt_bank_id" value="" />
                            </div>
                            <div class="modal-body">
                                 <div class="row">
                                     <div class="form-group col-md-6">
                                        <label>Bank Name</label>
                                        <input class="form-control" type="text" name="bank_name" id="bank_name" value="" required="true">                                             
                                     </div>  
                                     <div class="form-group col-md-6">
                                        <label>Account No</label>
                                        <input class="form-control" type="text" name="account_no" id="account_no" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>Account Holder Name</label>
                                        <input class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>Branch</label>
                                        <input class="form-control" type="text" name="branch" id="branch" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
                                        <label>IFSC</label>
                                        <input class="form-control" type="text" name="ifsc" id="ifsc" value="" required="true">                                             
                                     </div>
                                     <div class="form-group col-md-6">
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
                                     <div class="form-group col-md-12">
                                        <label>Remarks</label>
                                        <textarea class="form-control"  name="remarks" id="remarks"></textarea>                                             
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
