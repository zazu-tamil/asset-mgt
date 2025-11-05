<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
     
     //alert($(this).closest('tr').find('td').eq(1).text());
      
      var o_status = $(this).closest('tr').find('td').eq(6).text();
      var p_status = $(this).closest('tr').find('td').eq(5).text(); 
      var remarks = $(this).closest('tr').find('td').eq(7).text(); 
      
      $('#edit_modal #order_id').val($(this).val()) ; 
      $('#edit_modal #order_status').val(o_status) ; 
      $('#edit_modal #payment_status').val(p_status) ;   
      $('#edit_modal #remarks').val(remarks) ;   
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'order_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 