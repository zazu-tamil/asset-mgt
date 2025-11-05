<script>
jQuery(function($) { 
    
   

    $('#add_modal #dyn_fld_opt_type').change(function() {  
       if($(this).val() == 'Dropdown' || $(this).val() == 'radio' || $(this).val() == 'checkbox'){
            $('#add_modal .opt_val_div').addClass('show').removeClass('hide'); 
        } else {
            $('#add_modal .opt_val_div').addClass('hide').removeClass('show'); 
        }
     });   
     
     
     $('#edit_modal #dyn_fld_opt_type').change(function() {  
        if($(this).val() == 'Dropdown' || $(this).val() == 'radio' || $(this).val() == 'checkbox'){
            $('#edit_modal .opt_val_div').addClass('show').removeClass('hide'); 
        } else {
            $('#edit_modal .opt_val_div').addClass('hide').removeClass('show'); 
        }
     });  
     
     $(".edit_record").click(function() {   
      //alert($(this).val()); 
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'dyn_fld_opt_info', id: $(this).val() },
                success: function(d) {   //alert(d.department_name);
                    $('#edit_modal #dyn_fld_opt_id').val(d.dyn_fld_opt_id) ; 
                    $('#edit_modal #dyn_fld_opt_category').val(d.dyn_fld_opt_category); 
                    $('#edit_modal #dyn_fld_opt_name').val(d.dyn_fld_opt_name); 
                    $('#edit_modal #dyn_fld_opt_type').val(d.dyn_fld_opt_type); 
                    $('#edit_modal #fld_s_order').val(d.fld_s_order); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                    
                    //alert(d['opt_val'].length);
                    if(d['opt_val'].length> 0 ){
                        
                        $.each(d['opt_val'], function(key,obj) {             
                            //alert(obj.dyn_fld_opt_val_name);    
                            $('#edit_modal #dyn_fld_opt_val_id_' + key).val(obj.dyn_fld_opt_val_id);     
                            $('#edit_modal #dyn_fld_opt_val_name_' + key).val(obj.dyn_fld_opt_val_name) ;    
                            $('#edit_modal #fld_val_s_order_' + key).val(obj.fld_val_s_order) ;    
                        });
                        
                    }
                    
                     $('#edit_modal #dyn_fld_opt_type').change();
                    
                }
      }); 
       
                
    }); 
     
     
     
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'dyn_fld_opt_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     }); 
}); 
</script>