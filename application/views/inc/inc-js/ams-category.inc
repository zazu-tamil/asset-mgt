<script>
jQuery(function($) {    


    $(".edit_record").click(function() {   
      //alert($(this).val()); 
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'asset_category_info', id: $(this).val() },
                success: function(d) {    
                    $('#edit_modal #asset_category_id').val(d.asset_category_id) ; 
                    $('#edit_modal #asset_category_name').val(d.asset_category_name); 
                    $('#edit_modal #asset_category_code').val(d.asset_category_code); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'asset_category_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 