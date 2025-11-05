<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
      
      //alert($(this).val());
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'staff_leave_request_info', id: $(this).val() },
                success: function(d) {    
                    $('#edit_modal #leave_request_id').val(d.leave_request_id) ; 
                    //$('#edit_modal #req_date').val(d.req_date); 
                    $('#edit_modal #leave_date').val(d.leave_date);   
                    $('#edit_modal #reason').val(d.reason);   
                    $('#edit_modal input:radio[value="'+ d.leave_type +'"]').prop('checked', true);  
                    //$('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                    $('#edit_modal #status').val(d.status); 
                }
      }); 
       
                
    });
    
    
    
    $('.approval_record').click(function() {  
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
        
     });  
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'staff_leave_request_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 