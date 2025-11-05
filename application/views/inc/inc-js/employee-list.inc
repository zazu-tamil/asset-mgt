<script>
jQuery(function($) {  
    

     $(".btn_add_login").click(function() {  
            //alert($(this).val()); 
          $('#login_modal #employee_id').val($(this).val()) ;  
          $.ajax({
            url: "<?php echo site_url('get-data');?>",
            type: "post",
            data: { tbl : 'get-login', id: $(this).val() },
            success: function(d) {   
              
              if(d.user_id) { //alert('Edit');  
                  $('#login_modal #user_id').val(d.user_id) ;     
                  $('#login_modal #user_name').val(d.user_name) ;  
                  $('#login_modal #user_pwd').val(d.user_pwd) ;   
                  $('#login_modal input:radio[value="'+ d.status +'"]').prop('checked', true); 
              } else {
                //alert('Add');
              }
              
            }
         });
         
     });
     
      
     
     $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'employee_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  
     
});
</script>