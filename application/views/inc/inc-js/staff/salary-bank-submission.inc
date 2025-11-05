<script> 
jQuery(function($) { 
    
  $('#selectall').on('click', function(){
        let chk_status = this.checked;

        // Iterate all listed checkbox items
        $('.payslip_ids').each(function(){
            this.checked = chk_status;
        });
    });  
    
});     
</script>