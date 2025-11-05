<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
 <section class="content-header">
  <h1>Parcel Booking List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Parcel</a></li> 
    <li class="active">Booking List</li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  <!-- Default box -->
   
  <div class="box box-success">
    <div class="box-header with-border">
       <div class="box box-info"> 
            <div class="box-header with-border">
              <h3 class="box-title text-white">Search Filter</h3>
            </div>
        <div class="box-body">
             <form method="post" action="<?php echo site_url('parcel-booking-list')?>" id="frmsearch">          
             <div class="row">   
                 <div class="form-group col-md-3"> 
                    <label>From Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right datepicker" id="srch_from_date" name="srch_from_date" value="<?php echo set_value('srch_from_date',$srch_from_date);?>">
                    </div>
                    <!-- /.input group -->                                             
                 </div> 
                 <div class="form-group col-md-3"> 
                    <label>To Date</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right datepicker" id="srch_to_date" name="srch_to_date" value="<?php echo set_value('srch_to_date',$srch_to_date);?>">
                    </div>
                    <!-- /.input group -->                                             
                 </div> 
                  
                <div class="form-group col-md-2 text-left">
                    <br />
                    <button class="btn btn-success" name="btn_show" value="Show'"><i class="fa fa-search"></i> Show</button>
                </div>
             </div>  
            </form>
         </div> 
     </div>
    </div>
    <div class="box-body table-responsive"> 
       <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>AWB No & Date</th>  
                <th>Origin</th>  
                <th>Destination</th>  
                <th>Sender</th>  
                <th>Receiver</th>  
                <th>Weight</th>  
                <th class="text-right">Amount</th>  
                <th>Status</th>  
                <th colspan="3" class="text-center">Action</th>  
            </tr>
        </thead>
          <tbody>
               <?php
                   foreach($record_list as $j=> $ls){
                ?> 
                <tr> 
                    <td class="text-center"><?php echo ($j + 1 + $sno);?></td> 
                    <td>
                        <i class="badge"><?php echo $ls['awbno']?></i><br />
                        <?php echo date('d-m-Y', strtotime($ls['booking_date'])); ?><br />
                        <?php
	                       if($ls['to_pay'] == 1)
                            echo '<i class="label bg-blue">To Pay</i><br />';
                            if($ls['is_door_delivery'] == 1)
                            echo '<i class="label bg-green-gradient">Door Delivery</i><br />';
                        ?>
                    </td>   
                    <td>
                        <?php echo $ls['origin_state']?><br />
                        <?php echo $ls['origin_district']?><br />
                        <em><?php echo $ls['origin_branch']?> </em> 
                    </td>  
                    <td>
                        <?php echo $ls['dest_state']?><br />
                        <?php echo $ls['dest_district']?><br />
                        <em><?php echo $ls['dest_branch']?> </em> 
                    </td>   
                    <td>
                        <?php echo $ls['sender_company']?><br />
                        <?php echo $ls['sender_name']?><br />
                        <em><?php echo $ls['sender_mobile']?> </em> 
                    </td> 
                    <td>
                        <?php echo $ls['receiver_company']?><br />
                        <?php echo $ls['receiver_name']?><br />
                        <em><?php echo $ls['receiver_mobile']?> </em> 
                    </td>  
                    <td class="text-right"><?php echo number_format($ls['weight'],3);?></td>   
                    <td class="text-right"><?php echo number_format($ls['total_amount'],2);?></td>   
                    <td><?php echo $ls['status']?></td>   
                      
                    <td class="text-center">
                        <a href="<?php echo site_url('parcel-booking-edit/'). $ls['parcel_booking_id']?>" class="edit_record btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    </td>                                  
                    <td class="text-center">
                        <button value="<?php echo $ls['parcel_booking_id']?>" class="del_record btn btn-danger btn-xs" title="Delete"><i class="fa fa-remove"></i></button>
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

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
