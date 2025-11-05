<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>asset/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>asset/bower_components/morris.js/morris.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>asset/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() ?>asset/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<?php
/*	
<script src="<?php echo base_url() ?>asset/dist/js/demo.js"></script>
*/
?>
<script>
jQuery(function($) {   
    
    function get_notice() {   
         $.ajax({
                url: "<?php echo site_url('get-notice');?>",
                type: "post", 
                data: { 
                        user_type : "<?php echo $this->session->userdata(SESS_HD . 'user_type');?>", 
                        emp_id : "0", 
                        emp_category: "0", 
                        emp_designation : "0", 
                      },
                success: function(det) {  
                   $('#notice').html(det.msg); 
                   $('.txt_cnt').html(det.cnt); 
                   $('.txt_cnt').attr('data-original-title',det.cnt + " New Messages"); 
                   //alert(det.cnt)
                }
         });
      }
      setInterval(get_notice, 60000); 
      get_notice();
     
    
  /* $('.approval_record').click(function() {  
        //if (confirm('Are U Sure Want To Approve The Leave Request ??')) {
             $.ajax({
                    url: "<?php echo site_url('update-data');?>",
                    type: "post",
                    data: { tbl : 'approve-leave-request', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
        // }
        
     });  */
     
     
     $('.approval_record').click(function() {  
        //alert($(this).val());
        $("#leave_approve_modal .staff_info").html("<h4>" + $(this).attr('data-staff') + "</h4>");
             $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'staff_leave_request_info', id: $(this).val() },
                success: function(d) {    //alert(d.leave_date);
                    $('#leave_approve_modal #leave_request_id').val(d.leave_request_id) ; 
                    //$('#edit_modal #req_date').val(d.req_date); 
                    $('#leave_approve_modal #leave_date').val(d.leave_date);   
                    $('#leave_approve_modal #leave_type').val(d.leave_type);   
                    $('#leave_approve_modal #reason').val(d.reason);   
                    //$('#leave_approve_modal input:radio[value="'+ d.leave_type +'"]').prop('checked', true);  
                    $('#leave_approve_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                    //$('#leave_approve_modal #status').val(d.status); 
                    $('#leave_approve_modal #comments').val(d.comments); 
                    
                    $('#leave_approve_modal').modal('show'); 
                }
             }); 
        
     });
     
     
     $('.loan_approval_record').click(function() {  
        //alert($(this).val());
        $("#loan_approve_modal .staff_info").html("<h4>" + $(this).attr('data-staff') + "</h4>");
             $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'emp_loan_info', id: $(this).val() },
                success: function(d) {    //alert(d.leave_date);
                    $('#loan_approve_modal #emp_loan_id').val(d.emp_loan_id) ;  
                    $('#loan_approve_modal #loan_required_date').val(d.loan_required_date);   
                    $('#loan_approve_modal #loan_pct').val(d.loan_pct);   
                    $('#loan_approve_modal #loan_tenure').val(d.loan_tenure);   
                    $('#loan_approve_modal #loan_amount').val(d.loan_amount);   
                    $('#loan_approve_modal #loan_emi').val(d.loan_emi);    
                    $('#loan_approve_modal #remarks').val(d.remarks);    
                    $('#loan_approve_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                    
                    $('#loan_approve_modal').modal('show'); 
                }
             }); 
        
     });
     
     
     $('#loan_approve_modal #loan_tenure').keyup(function() {  
        
        var emi = ((parseFloat($('#loan_approve_modal #loan_amount').val()) + ((parseFloat($('#loan_approve_modal #loan_amount').val()) * ( parseFloat($('#loan_approve_modal #loan_pct').val()) / 100))))  / parseFloat($('#loan_approve_modal #loan_tenure').val()));
        
        $('#loan_approve_modal #loan_emi').val(emi.toFixed(2)); 
        
     });
     
     $('#loan_approve_modal #loan_pct').keyup(function() {  
        
        var emi = ((parseFloat($('#loan_approve_modal #loan_amount').val()) + ((parseFloat($('#loan_approve_modal #loan_amount').val()) * ( parseFloat($('#loan_approve_modal #loan_pct').val()) / 100))))  / parseFloat($('#loan_approve_modal #loan_tenure').val()));
        
        $('#loan_approve_modal #loan_emi').val(emi.toFixed(2)); 
        
     });
     
     
     $('.approve_adv').click(function() {  
        //if (confirm('Are U Sure Want To Approve The Leave Request ??')) {
             $.ajax({
                    url: "<?php echo site_url('update-data');?>",
                    type: "post",
                    data: { tbl : 'approve-adv-request', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
        // }
        
     }); 
     
     $('.reject_adv').click(function() {  
        //if (confirm('Are U Sure Want To Approve The Leave Request ??')) {
             $.ajax({
                    url: "<?php echo site_url('update-data');?>",
                    type: "post",
                    data: { tbl : 'reject-adv-request', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
        // }
        
     }); 
    
});
</script>