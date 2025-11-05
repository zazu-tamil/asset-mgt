<script>
jQuery(function($) {    
    
    function datetimeLocal(datetime) {
        const dt = new Date(datetime);
        dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
        return dt.toISOString().slice(0, 16);
    }


    $(".edit_record").click(function() {  
      
    //  alert($(this).val());
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'emp_attendance_info', id: $(this).val() },
                success: function(d) {    
                    $('#edit_modal #emp_attendance_id').val(d.emp_attendance_id) ;  
                    $('#edit_modal #employee_code').val(d.employee_code); 
                    $('#edit_modal #in_time').val(datetimeLocal(d.in_time)) ;  
                    $('#edit_modal #out_time').val(datetimeLocal(d.out_time)) ;  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'emp_attendance_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 