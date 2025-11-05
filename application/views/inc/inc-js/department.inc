<script>
jQuery(function($) {    


    $(".edit_record").click(function() {  
      
      //alert($(this).val());
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'department_info', id: $(this).val() },
                success: function(d) {   //alert(d.department_name);
                    $('#edit_modal #department_id').val(d.department_id) ; 
                    $('#edit_modal #department_name').val(d.department_name); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'department_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 