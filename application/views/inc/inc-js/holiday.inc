<script>
jQuery(function($) {    


    $(".edit_record").click(function() {   
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'holidays_info', id: $(this).val() },
                success: function(d) {                                 
                    // alert(d);
                    $('#edit_modal #holiday_id').val(d.holiday_id) ; 
                    $('#edit_modal #holiday_date').val(d.holiday_date) ; 
                    $('#edit_modal #holiday_det').val(d.holiday_det) ; 
                    $('#edit_modal input:radio[value='+ d.status +']').prop('checked', true);   
                }
      }); 
      
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'holidays_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 