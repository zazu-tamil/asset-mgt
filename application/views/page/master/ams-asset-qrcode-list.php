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
                <th>Asset Category</th>   
                <th>Asset Item</th>   
                <th>Asset Location</th>   
                <th>Qty</th>   
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
                    <td><?php echo $ls['asset_category_name']?><br /><i class="badge bg-success"><?php echo $ls['asset_category_code']?></i></td>   
                    <td><?php echo $ls['asset_item_name']?><br /><i class="badge bg-success"><?php echo $ls['asset_item_code']?></i></td>   
                    <td><?php echo $ls['asset_location_name']?><br /><i class="badge bg-success"><?php echo $ls['asset_location_code']?></i></td>   
                      <td><?php echo $ls['asset_item_qty']?></td>   
                    <td><?php echo $ls['status']?></td>   
                    <td class="text-center">
                        <a href="<?php echo site_url('print-asset-qrcode-v2/' . $ls['asset_item_qrcode_gen_id'])?>" target="_blank" class="btn btn-warning btn-xs" title="Print"><i class="fa fa-print"></i></a>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['asset_item_qrcode_gen_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
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
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Add <?php echo $title; ?></strong></h3>
                                
                                <input type="hidden" name="mode" value="Add" />
                            </div>
                            <div class="modal-body">
                                <div class="row"> 
                                     <div class="form-group col-md-9">
                                        <label>Asset Location</label>
                                        <select name="asset_location_id" id="asset_location_id" class="form-control" required="true" >
                                            <option value="">Select</option>
                                        <?php foreach($asset_location_opt as $i =>$ls) {?>
                                            <option value="<?php echo $ls['asset_location_id'] ?>" data-code="<?php echo $ls['asset_location_code'] ?>"><?php echo $ls['asset_location_name'] ?></option> 
                                        <?php } ?>
                                         </select>
                                     </div> 
                                     <div class="form-group col-md-3">
                                        <label>Code</label>
                                        <input type="text" class="form-control" name="location_code" id="location_code" value="" readonly="true" required="true"/>
                                     </div> 
                                     <div class="form-group col-md-9">
                                        <label>Asset Category</label>
                                        <select name="asset_category_id" id="asset_category_id" class="form-control" required="true" >
                                            <option value="">Select</option>
                                        <?php foreach($asset_category_opt as $i =>$ls) {?>
                                            <option value="<?php echo $ls['asset_category_id'] ?>" data-code="<?php echo $ls['asset_category_code'] ?>"><?php echo $ls['asset_category_name'] ?></option> 
                                        <?php } ?>
                                         </select>
                                     </div>  
                                     <div class="form-group col-md-3">
                                        <label>Code</label>
                                        <input type="text" class="form-control" name="category_code" id="category_code" value="" readonly="true" required="true" />
                                     </div>
                                     <div class="form-group col-md-9">
                                        <label>Asset Item</label>
                                        <select name="asset_item_id" id="asset_item_id" class="form-control" required="true">
                                            <option value="">Select</option>
                                         </select>
                                     </div> 
                                     <div class="form-group col-md-3">
                                        <label>Code</label>
                                        <input type="text" class="form-control" name="item_code" id="item_code" value=""  readonly="true" required="true"/>
                                     </div> 
                                     
                                     <div class="form-group col-md-4">
                                        <label>Asset Item Qty</label>
                                        <input class="form-control" type="number" step="any" name="asset_item_qty" id="asset_item_qty" value="" max="50" required="true">                                             
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
                                <h3 class="modal-title" id="scrollmodalLabel"><strong>Edit <?php echo $title; ?></strong></h3>
                                <input type="hidden" name="mode" value="Edit" />
                                <input type="hidden" name="asset_item_id" id="asset_item_id" value="" />
                            </div>
                            <div class="modal-body"> 
                                     <div class="form-group">
                                        <label>Asset Category</label>
                                        <?php echo form_dropdown('asset_category_id',array('' => 'Select') + $asset_category_opt ,set_value('asset_category_id') ,' id="asset_category_id" class="form-control" required="true"');?>
                                     </div>   
                                     <div class="form-group">
                                        <label>Asset Item Name</label>
                                        <input class="form-control" type="text" name="asset_item_name" id="asset_item_name" value="" required="true">                                             
                                     </div>  
                                     <div class="form-group">
                                        <label>Asset Item Code</label>
                                        <input class="form-control" type="text" name="asset_item_code" id="asset_item_code" value="" required="true">                                             
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

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
