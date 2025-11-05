<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1>Booking Entry</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-book"></i> Booking</a></li> 
    <li class="active">Booking Entry</li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
<form method="post" action="" id="frm">
  <!-- Default box -->
    
        <div class="box box-info">
        <div class="box-body">
        <?php if(!empty($booked_success)) {?>
        <div class="alert alert-success text-center" role="alert" > 
           <b><?php echo $booked_success; ?></b> 
        </div>   
        <?php } ?> 
        <div class="row">   
             <div class="form-group col-md-3">
                <input type="hidden" name="mode" value="Add" />
                <label>Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="booking_date" name="booking_date" value="<?php echo date('Y-m-d');?>" required="true">
                </div>
                <!-- /.input group -->                                             
             </div> 
             <div class="form-group col-md-2">
                <label>Time</label>
                 <div class="input-group">
                    <input type="time" class="form-control" name="booking_time" id="booking_time" required="true" value="<?php echo date('H:i');?>" readonly="true">
 
                  </div>
                  <!-- /.input group -->                                           
             </div> 
             <div class="form-group col-md-3">
                <label>AWB No</label>
                <input class="form-control" type="text" name="awbno" id="awbno" value="" placeholder="AWB No" required="true"> 
             </div> 
         </div> 
         </div> 
         </div>  
        <div class="row">
            <div class="col-md-6">
               <div class="box box-info">
                    <div class="box-header with-border text-center"><b class="text-blue">Origin Details</b></div>
                    <div class="box-body">
                         <div class="row">  
                            <div class="form-group col-md-12"> 
                                <label>Origin State</label>
                                <?php echo form_dropdown('origin_state',array('' => 'Select') + $state_opt ,set_value('origin_state',($this->session->userdata('cr_user_type') != 'Driver' ? $this->session->userdata('cr_br_state') : '')) ,' id="origin_state" class="form-control" '.($this->session->userdata('cr_user_type') == 'Branch' ? "readonly='true'": ""). '  required="true"');?>                                             
                            </div>
                            <div class="form-group col-md-12">  
                                <label>Origin District</label>
                                <?php echo form_dropdown('origin_district',array('' => 'Select') + $origin_city_opt ,set_value('origin_district',($this->session->userdata('cr_user_type') != 'Driver' ? $this->session->userdata('cr_br_district') : '')) ,' id="origin_district" class="form-control" '.($this->session->userdata('cr_user_type') == 'Branch' ? "readonly='true'": ""). ' required="true"');?>                                          
                            </div>
                            <div class="form-group col-md-12">  
                                <label>Origin Branch</label>
                                <?php echo form_dropdown('origin_branch',array('' => 'Select') + $origin_branch_opt ,set_value('origin_branch',($this->session->userdata('cr_user_type') != 'Driver' ? $this->session->userdata('cr_branch') : '')) ,' id="origin_branch" class="form-control" '.($this->session->userdata('cr_user_type') == 'Branch' ? "readonly='true'": ""). ' required="true"');?>                                          
                            </div>
                         </div>
                     </div>
               </div> 
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                  <div class="box-header with-border text-center"><b class="text-blue">Destination Details</b></div>
                  <div class="box-body">
                      <div class="row">  
                            <div class="form-group col-md-12"> 
                                <label>Destination  State</label>
                                <?php echo form_dropdown('dest_state',array('' => 'Select') + $state_opt ,set_value('dest_state','') ,' id="dest_state" class="form-control"  required="true"');?>                                             
                            </div>
                            <div class="form-group col-md-12">  
                                <label>Destination  District</label>
                                <?php echo form_dropdown('dest_district',array('' => 'Select') ,set_value('dest_district','') ,' id="dest_district" class="form-control"   required="true"');?>                                          
                            </div>
                            <div class="form-group col-md-12">  
                                <label>Destination Branch</label>
                                <?php echo form_dropdown('dest_branch',array('' => 'Select') ,set_value('dest_branch','') ,' id="dest_branch" class="form-control calc" required="true"');?>                                          
                            </div>
                         </div>
                  </div>
                 </div>
            </div>
         </div> 
          <div class="row"> 
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border text-center"><b class="text-blue">Package Details</b></div> 
                    <div class="box-body">   
                        <div class="form-group col-md-6">
                            <label>No Of Pieces </label>
                            <input class="form-control text-right" type="text" name="no_of_pieces" id="no_of_pieces" value="" placeholder="No of Pieces" required="true">                                             
                         </div>
                         <div class="form-group col-md-6">
                            <label>Weight <i class="text-red" style="font-size: 10px;"> Chargable Min.Weight : 5Kgs</i></label>
                            <div class="input-group"> 
                            <input class="form-control text-right calc"  type="text" name="weight" id="weight" step="any" min="0" value="5" placeholder="Weight" required="true">
                            <div class="input-group-addon bg-aqua"> In Kgs </div>  
                            </div>                                           
                         </div> 
                         <div class="form-group col-md-12">
                            <label>Description Of Goods</label>
                            <textarea class="form-control" name="description_of_goods" id="description_of_goods" placeholder="Description Of Goods" required="true"></textarea>                                             
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <button type="button" class="btn btn-success" id="btn_chrges">Get Charges</button>
                        </div> 
                        <div class="form-group col-md-6">  
                            <label>Payment By [ <i>To Pay</i> ]</label>
                            <?php echo form_dropdown('to_pay',array('0' => 'Sender','1' => 'Receiver') ,set_value('to_pay','0') ,' id="to_pay" class="form-control"');?>                                          
                        </div>
                        <div class="form-group col-md-6 checkbox text-center">  
                            <label class="form-check-label">
                            <input type="checkbox" name="is_door_delivery" value="1" class="is_door_delivery form-check"> 
                             Is Door Delivery</label>                                         
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                 <div class="box-header with-border text-center"><b class="text-blue">Charges Details</b></div>   
                 <div class="box-body"> 
                 <div class="row"> 
                    
                     <div class="form-group col-md-6">
                        <label>Freight Charges</label>
                        <input class="form-control text-right " type="number" name="freight_charges" id="freight_charges" value="0" placeholder="Freight Charges" readonly="true">                                             
                     </div>
                     <div class="form-group col-md-6">
                        <label>AWB Charges</label>
                        <input class="form-control text-right " type="text" name="awb_charges" id="awb_charges" value="0" placeholder="AWB Charges" readonly="true">                                             
                     </div> 
                     <div class="form-group col-md-6">
                        <label>Loading Charges</label>
                        <input class="form-control text-right " type="text" name="loading_charges" id="loading_charges" value="0" placeholder="Loading Charges" readonly="true">                                             
                     </div> 
                     
                     <div class="form-group col-md-6">
                        <label>Other Charges</label>
                        <input class="form-control text-right calc" type="text" name="other_charges" id="other_charges" value="0" placeholder="Other Charges">                                             
                     </div>  
                 </div>
                 <div class="row">
                     <div class="form-group col-md-4">
                        <label>Sub Total</label>
                        <input class="form-control text-right" type="text" name="sub_total" id="sub_total" value="0" placeholder="Sub Total" readonly="true">                                             
                     </div> 
                     <div class="form-group col-md-4">
                        <label>GST %</label>
                        <select class="form-control" name="gst_pert" id="gst_pert" readonly="true" >
                            <option value="0.00">NO GST</option>
                            <option value="5.00">GST 5%</option>
                        </select>                                            
                     </div>
                     <div class="form-group col-md-4">
                        <label>GST Amount</label>
                        <input class="form-control text-right" type="text" name="gst_amt" id="gst_amt" value="0" readonly="true" placeholder="GST Amount">                                             
                     </div>
                     <div class="form-group col-md-12">
                        <label>Net Total</label>
                        <input class="form-control text-right" type="text" name="total_amount" id="total_amount" value="0" readonly="true" placeholder="Grand Total">                                             
                     </div>
                 </div> 
                 </div>
                 </div>
            </div>
         </div>
         <div class="row"> 
             <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border text-center"><b class="text-blue">Sender Details</b></div>
                 <div class="box-body"> 
                    <div class="row"> 
                         <div class="form-group col-md-12">
                            <label>Company</label>
                            <input class="form-control" type="text" name="sender_company" id="sender_company" value="" placeholder="Company Name">                                             
                         </div> 
                         <div class="form-group col-md-12">
                            <label>Sender Name</label>
                            <input class="form-control" type="text" name="sender_name" id="sender_name" value="" placeholder="Sender Name" required="true">                                             
                         </div> 
                         <div class="form-group col-md-12">
                            <label>Mobile</label>
                            <input class="form-control" type="text" name="sender_mobile" id="sender_mobile" value="" placeholder="Mobile" maxlength="15" required="true">                                             
                         </div>
                         <div class="form-group col-md-12">
                            <label>Full Address</label>
                            <textarea class="form-control" name="sender_address" placeholder="Address" id="sender_address" required="true"></textarea>                                             
                         </div>  
                         <div class="form-group col-md-12">
                            <label>GST NO</label>
                            <input class="form-control" type="text" name="sender_gst" id="sender_gst" value="" placeholder="Sender GST"  >                                             
                         </div> 
                    </div>
                 </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border text-center"><b class="text-blue">Receiver Details</b></div>
                 <div class="box-body">  
                    <div class="row"> 
                        <div class="form-group col-md-12">
                            <label>Company</label>
                            <input class="form-control" type="text" name="receiver_company" id="receiver_company" value="" placeholder="Company Name">                                             
                         </div> 
                         <div class="form-group col-md-12">
                            <label>Receiver Name</label>
                            <input class="form-control" type="text" name="receiver_name" id="receiver_name" value="" placeholder="Receiver Name" required="true">                                             
                         </div> 
                         <div class="form-group col-md-12">
                            <label>Mobile</label>
                            <input class="form-control" type="text" name="receiver_mobile" id="receiver_mobile" value="" placeholder="Mobile" required="true">                                             
                         </div> 
                         <div class="form-group col-md-12">
                            <label>Full Address</label>
                            <textarea class="form-control" name="receiver_address" placeholder="Address" id="receiver_address" required="true"></textarea>                                             
                         </div> 
                         <div class="form-group col-md-12">
                            <label>GST NO</label>
                            <input class="form-control" type="text" name="receiver_gst" id="receiver_gst" value="" placeholder="Receiver GST"  >                                             
                         </div>   
                    </div> 
                 </div>
                </div> 
        </div>
         </div>
         
        
         <div class="box box-info">
          <div class="box-body text-center"> 
            <div class="row">
                <div class="col-md-6">
                 <a href="<?php echo site_url('parcel-booking-list') ?>" class="btn btn-info btn-mini"><i class="fa fa-angle-double-left"></i>  Back To Booking List</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-success btn-mini" id="btn_save"><i class="fa fa-save"></i>  Save</button>
                </div>
            </div>
          </div>
         </div> 
        
    <!--</div>
    <!- - /.box-body - - >
    <div class="box-footer">
        
    </div>
    <!- - /.box-footer- ->
  </div> -->
  <!-- /.box -->
  </form> 
        <?php if(!empty($booked_success)) {?>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $booked_success; ?></h4>
              </div>
              <div class="modal-body"> 
                 <b><?php echo $booked_lrno; ?></b> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> 
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal --> 
         
        <?php } ?>
        
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
