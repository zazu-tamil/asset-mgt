<script>
jQuery(function($) {    
    
    $('#add_modal #asset_item_id').change(function() {  //alert($(this).find(':selected').attr('data-code'));
    
        $('#add_modal #item_code').val($(this).find(':selected').attr('data-code'));
    });
    
    $('#add_modal #asset_location_id').change(function() {  //alert($(this).find(':selected').attr('data-code'));
    
        $('#add_modal #location_code').val($(this).find(':selected').attr('data-code'));
    });

    $('#add_modal #asset_category_id').change(function() {  //alert($(this).find(':selected').attr('data-code'));
    
        $('#add_modal #category_code').val($(this).find(':selected').attr('data-code'));
        
        $("#add_modal #asset_item_id > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-asset-category-item', id: $(this).val() },
                success: function(d) {   
                    
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select');
                    $('#add_modal #asset_item_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.asset_item_id);
	                    opt1.text(info.asset_item_name);
	                    opt1.attr('data-code',info.asset_item_code);
	                    $('#add_modal #asset_item_id').append(opt1); 
	                });
                }
         });  
     });
     
    
    
    $('.del_record').click(function() {   
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'asset_item_qrcode_gen_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 