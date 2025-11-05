<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 <!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>asset/plugins/timepicker/bootstrap-timepicker.min.js"></script> 
<script>
jQuery(function($) { 
   
      
     $('.datepicker').datepicker({
      autoclose: true,
      format : 'yyyy-mm-dd' 
    }); 
    
    
    $(".add_row").click(function(){ 
  	   var t = $('#inv_itm');
        var clone = t.find('#clone-row').clone(true);
        clone.attr('id', ''); 
        t.append(clone); 
        
        var ind = $(this).closest("tr").index();
        //alert($(this).closest("tr").index()); 
        $("#inv_itm .description:eq("+ (ind +1 ) +")").val(''); 
        $("#inv_itm .amount:eq("+ (ind +1 ) +")").val(0); 
         
    });    
    
    $(".remove_row").click(function(){ 
  	    $(this).closest("tr").remove();
    }); 
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record')?>",
                    type: "post",
                    data: { tbl : 'quote-item', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });   
        
      
     
});
</script> 