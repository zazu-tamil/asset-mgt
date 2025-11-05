 
<script>
jQuery(function($) {   
     
      
      function get_notice() {   
         $.ajax({
                url: "<?php echo site_url('get-notice');?>",
                type: "post", 
                data: { 
                        user_type : "<?php echo $this->session->userdata(SESS_HD . 'user_type');?>", 
                        emp_id : "<?php echo $this->session->userdata(SESS_HD . 'ref_id');?>", 
                        emp_category: "<?php echo $emp_info['employee_category'] ?>", 
                        emp_designation : "<?php echo $emp_info['designation_id'] ?>", 
                      },
                success: function(det) {  
                   $('#notice').html(det.msg); 
                   $('.txt_cnt').html(det.cnt); 
                   $('.txt_cnt').attr('data-original-title',det.cnt + " New Messages"); 
                   //alert(det.cnt)
                }
         });
      }
      setInterval(get_notice, 60000); 
      get_notice();
    
});
</script>