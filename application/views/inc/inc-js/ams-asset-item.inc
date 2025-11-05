<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
      $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'asset_item_info', id: $(this).val() },
                success: function(d) {    
                    $('#edit_modal #asset_item_id').val(d.asset_item_id) ; 
                    $('#edit_modal #asset_category_id').val(d.asset_category_id) ; 
                    $('#edit_modal #asset_item_name').val(d.asset_item_name); 
                    $('#edit_modal #asset_item_code').val(d.asset_item_code); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {   
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'asset_item_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 