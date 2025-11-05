<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
      
      //alert($(this).val());
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'mgt_bank_info', id: $(this).val() },
                success: function(d) {   //alert(d.department_name);
                    $('#edit_modal #mgt_bank_id').val(d.mgt_bank_id) ; 
                    $('#edit_modal #bank_name').val(d.bank_name) ; 
                    $('#edit_modal #account_no').val(d.account_no) ; 
                    $('#edit_modal #account_holder_name').val(d.account_holder_name); 
                    $('#edit_modal #branch').val(d.branch); 
                    $('#edit_modal #ifsc').val(d.ifsc); 
                    $('#edit_modal #remarks').val(d.remarks); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'mgt_bank_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 