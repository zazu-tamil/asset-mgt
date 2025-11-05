<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
 
<script>
jQuery(function($) { 
   
      
    $('.datepicker').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd' 
    });  
    
    /*$('.timepicker').timepicker({
      showInputs: false
    });*/
   
     
    
     
        
     $('#origin_state').change(function() {  
        $("#origin_district > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-district', id: $(this).val() },
                success: function(d) {   
                    
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select District');
                    $('#origin_district').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.district);
	                    opt1.text(info.district);
	                    $('#origin_district').append(opt1); 
	                });
                }
         });  
     });
     
     $('#origin_district').change(function() {  
        $("#origin_branch > option").remove();   
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-agent-branch', id: $(this).val() },
                success: function(d) {  
                   var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select Branch');
                    $('#origin_branch').append(opt1);
			
    				 $.each(d,function(key,info) 
    	                {
    	                    var opt1 = $('<option />'); 
    	                    opt1.val(info.branch);
    	                    opt1.text(info.branch + '[ ' + info.agent_type  + ' ]');
    	                    $('#origin_branch').append(opt1); 
                            
    	                }); 
                }
         });
          
     });
     
   
     
     
     $('#dest_state').change(function() {  
        $("#dest_district > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-district', id: $(this).val() },
                success: function(d) {   
                    
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select');
                    $('#dest_district').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.district);
	                    opt1.text(info.district);
	                    $('#dest_district').append(opt1); 
	                });
                }
         });
         
         $('.calc').keyup();  
     });
     
     $('#dest_district').change(function() {  
        $("#dest_branch > option").remove();   
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-agent-branch', id: $(this).val() },
                success: function(d) {  
                   var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select Branch Code');
                    $('#dest_branch').append(opt1);
			
    				 $.each(d,function(key,info) 
    	                {
    	                    var opt1 = $('<option />'); 
    	                    opt1.val(info.branch);
    	                    opt1.text(info.branch + '[ ' + info.agent_type  + ' ]');
    	                    $('#dest_branch').append(opt1); 
                            
    	                }); 
                }
         });
          
     });
     
     
     $('#btn_chrges').click(function() {   
      //var tot = gst_amt = 0;
      if($('#origin_branch').val()!= '' && $('#dest_branch').val()!= '') {
            $.ajax({
                    url: "<?php echo site_url('get-data');?>",
                    type: "post",
                    data: { 
                            tbl : 'get-parcel-charges',
                            origin_branch : $('#origin_branch').val() , 
                            dest_branch : $('#dest_branch').val() , 
                            weight: $('#weight').val() 
                          },
                    success: function(info) {  
                       //alert(info.sub_total);
                       $('#freight_charges').val(info.fr_chrges) ;
                       $('#awb_charges').val(info.awb_charges) ;
                       $('#loading_charges').val(info.loading_charges) ;
                       $('#unloading_charges').val(info.unloading_charges) ;
                      // $('#sub_total').val(info.sub_total) ;
                       
                     //  $('#description_of_goods').val(info.sql) ;
                       
                       
                      var subtot = parseFloat($('#freight_charges').val()) + parseFloat($('#awb_charges').val())  + parseFloat($('#loading_charges').val()) + parseFloat($('#unloading_charges').val())+ parseFloat($('#other_charges').val());
                      //tot = parseFloat($('#charges').val())  ;
                      $('#sub_total').val(subtot) ;
                      if(subtot >= info.gst_limit)
                      {
                        $('#gst_pert').val(info.gst_pert) ;
                      } else {
                        $('#gst_pert').val('0.00');
                      }
                      gst_amt = parseFloat(subtot) * parseFloat($('#gst_pert').val()/100) ; 
                      //$('#total_amount').val(parseFloat(tot).toFixed(2)); 
                      $('#gst_amt').val(parseFloat(gst_amt).toFixed(2)); 
                      $('#total_amount').val((parseFloat(subtot) + parseFloat(gst_amt)).toFixed(2));
                        
                    }
            });
      }  
      
      
     }); 
     
    $('.calc').change(function() { //alert('change');
    
       $('#btn_chrges').click();
      
    });  
     
     
    $('.calc').keyup(function() { //alert('key');
    
       $('#btn_chrges').click();
      
    });
        
     
    
       
    
      $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'booking', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     }); 
     
     $(".alert").fadeOut(4000);
     
    <?php if(!empty($booked_success)) {?>  
    $('#modal-default').modal('show'); 
    <?php } ?>
     
});
</script> 