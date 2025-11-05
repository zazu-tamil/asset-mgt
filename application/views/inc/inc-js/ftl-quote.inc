<link rel="stylesheet" href="<?php echo base_url() ?>asset/plugins/iCheck/all.css">  
<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>asset/plugins/iCheck/icheck.min.js"></script> 
 
<script>
jQuery(function($) { 
   
      
    $('.datepicker').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd' 
    }); 
    
    
    $('#add_modal .calc').keyup(function() {  //alert($('#inclu_gst').is(":checked"));
        
         var tc = $('#add_modal #transport_charges').val();
         var lc = $('#add_modal #loading_charges').val();
         var hc = $('#add_modal #handling_charges').val();
         var gst = $('#add_modal #gst_per').val();
         var s_tot = parseFloat(tc) + parseFloat(lc) + parseFloat(hc) ;
         if($('#add_modal #inclu_gst').is(":checked")=== true)
         {
            var tax = parseFloat(parseFloat(s_tot) * gst / (100 + parseFloat(gst))) ;
            var tot = parseFloat(s_tot) ;
         } else {
            var tax = parseFloat(parseFloat(s_tot) * gst / 100) ;
            var tot = parseFloat(s_tot) + parseFloat(tax) ;
         }
         
         
         $('#add_modal .tot').html("<h4>Quote Amount: " + tot.toFixed(2) + "</h4>");
         $('#add_modal .g_amt').html("<h4>GST Amount: " + tax.toFixed(2) + "</h4>");
         $('#add_modal #gst_amt').val(tax.toFixed(2));
         $('#add_modal #total_amount').val(tot.toFixed(2));
    });
    
    $('#add_modal .calc').change(function() {  
         var tc = $('#add_modal #transport_charges').val();
         var lc = $('#add_modal #loading_charges').val();
         var hc = $('#add_modal #handling_charges').val();
         var gst = $('#add_modal #gst_per').val();
         var s_tot = parseFloat(tc) + parseFloat(lc) + parseFloat(hc) ;
         if($('#add_modal #inclu_gst').is(":checked")=== true)
         {
            var tax = parseFloat(parseFloat(s_tot) * gst / (100 + parseFloat(gst))) ;
            var tot = parseFloat(s_tot) ;
         } else {
            var tax = parseFloat(parseFloat(s_tot) * gst / 100) ;
            var tot = parseFloat(s_tot) + parseFloat(tax) ;
         }
         $('#add_modal .tot').html("<h4>Quote Amount: " + tot.toFixed(2) + "</h4>");
         $('#add_modal .g_amt').html("<h4>GST Amount: " + tax.toFixed(2) + "</h4>");
         $('#add_modal #gst_amt').val(tax.toFixed(2));
         $('#add_modal #total_amount').val(tot.toFixed(2));
    });
    
    $('#edit_modal .calc').keyup(function() {  
         var tc = $('#edit_modal #transport_charges').val();
         var lc = $('#edit_modal #loading_charges').val();
         var hc = $('#edit_modal #handling_charges').val();
         var gst = $('#edit_modal #gst_per').val();
         var s_tot = parseFloat(tc) + parseFloat(lc) + parseFloat(hc) ;
         if($('#edit_modal #inclu_gst1').is(":checked")=== true)
         {
            var tax = parseFloat(parseFloat(s_tot) * gst / (100 + parseFloat(gst))) ;
            var tot = parseFloat(s_tot) ;
         } else {
            var tax = parseFloat(parseFloat(s_tot) * gst / 100) ;
            var tot = parseFloat(s_tot) + parseFloat(tax) ;
         }
         $('#edit_modal .tot').html("<h4>Quote Amount: " + tot.toFixed(2) + "</h4>");
         $('#edit_modal .g_amt').html("<h4>GST Amount: " + tax.toFixed(2) + "</h4>");
         $('#edit_modal #gst_amt').val(tax.toFixed(2));
         $('#edit_modal #total_amount').val(tot.toFixed(2));
    });
    
    $('#edit_modal .calc').change(function() {   
         var tc = $('#edit_modal #transport_charges').val();
         var lc = $('#edit_modal #loading_charges').val();
         var hc = $('#edit_modal #handling_charges').val();
         var gst = $('#edit_modal #gst_per').val();
         var s_tot = parseFloat(tc) + parseFloat(lc) + parseFloat(hc) ;
         if($('#edit_modal #inclu_gst1').is(":checked")=== true)
         {
            var tax = parseFloat(parseFloat(s_tot) * gst / (100 + parseFloat(gst))) ;
            var tot = parseFloat(s_tot) ;
         } else {
            var tax = parseFloat(parseFloat(s_tot) * gst / 100) ;
            var tot = parseFloat(s_tot) + parseFloat(tax) ;
         }
         $('#edit_modal .tot').html("<h4>Quote Amount: " + tot.toFixed(2) + "</h4>");
         $('#edit_modal .g_amt').html("<h4>GST Amount: " + tax.toFixed(2) + "</h4>");
         $('#edit_modal #gst_amt').val(tax.toFixed(2));
         $('#edit_modal #total_amount').val(tot.toFixed(2));
    });
    
    
    $(".edit_record").click(function() {  
     
       
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'ftl-quote', id: $(this).val() },
                success: function(d) {                                 
                    // alert(d.sender_name);
                    $('#edit_modal #ftl_quote_id').val(d.ftl_quote_id) ; 
                    $('#edit_modal #quote_no').val(d.quote_no) ; 
                    $('#edit_modal #quote_date').val(d.quote_date) ; 
                    $('#edit_modal #vehicle_type').val(d.vehicle_type) ;  
                    $('#edit_modal #origin_state').val(d.origin_state) ;  
                    $('#edit_modal #dest_state').val(d.dest_state) ;  
                    $('#edit_modal #sender_company').val(d.sender_company) ;  
                    $('#edit_modal #sender_name').val(d.sender_name) ;  
                    $('#edit_modal #sender_mobile').val(d.sender_mobile) ;  
                    $('#edit_modal #sender_address').val(d.sender_address) ;  
                    $('#edit_modal #sender_gst').val(d.sender_gst) ;  
                    $('#edit_modal #receiver_company').val(d.receiver_company) ;  
                    $('#edit_modal #receiver_name').val(d.receiver_name) ;  
                    $('#edit_modal #receiver_mobile').val(d.receiver_mobile) ;  
                    $('#edit_modal #receiver_address').val(d.receiver_address) ;  
                    $('#edit_modal #receiver_gst').val(d.receiver_gst) ;  
                    $('#edit_modal #no_of_pieces').val(d.no_of_pieces) ;  
                    $('#edit_modal #weight').val(d.weight) ;  
                    $('#edit_modal #description_of_goods').val(d.description_of_goods) ;  
                    $('#edit_modal #transport_charges').val(d.transport_charges) ;  
                    $('#edit_modal #loading_charges').val(d.loading_charges) ;  
                    $('#edit_modal #handling_charges').val(d.handling_charges) ;  
                    $('#edit_modal #gst_per').val(d.gst_per) ;  
                    $('#edit_modal #gst_amt').val(d.gst_amt) ;  
                    $('#edit_modal #total_amount').val(d.total_amount) ;   
                    $('#edit_modal #quote_to').val(d.quote_to) ;   
                    $('#edit_modal input:checkbox[value='+ d.inclu_gst +']').prop('checked', true);                     
                    $('#edit_modal input:radio[value='+ d.status +']').prop('checked', true);                     
                    $('#edit_modal .calc').change();
                }
      }); 
      
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'ftl-quote', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }        
     });  
    
    
});
</script>    