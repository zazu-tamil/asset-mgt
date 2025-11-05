<script>
jQuery(function($) {    


    $(".edit_record").click(function() {     
     
      $.ajax({
            url: "<?php echo site_url('get-data');?>",
            type: "post",
            data: { tbl : 'opening_balance_info', id: $(this).val() },
            success: function(d1) {   
              $('#edit_modal #opening_balance_id').val(d1.opening_balance_id) ;  
              $('#edit_modal #opening_date').val(d1.opening_date) ;  
              $('#edit_modal #ac_type').val(d1.ac_type) ;  
              $('#edit_modal #amount').val(d1.amount) ;   
              
            }
            
         });
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'opening_balance_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 