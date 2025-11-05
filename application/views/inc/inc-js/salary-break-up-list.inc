<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
      
      //alert($(this).val());
      
      $.ajax({ 
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'salary_breakup_info', id: $(this).val() },
                success: function(d) {   
                    $('#edit_modal #salary_breakup_id').val(d.salary_breakup_id) ; 
                    $('#edit_modal #salary_breakup_name').val(d.salary_breakup_name); 
                    $('#edit_modal #sort_order').val(d.sort_order); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'salary_breakup_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 