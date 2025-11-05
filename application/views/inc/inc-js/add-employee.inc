<link rel="stylesheet" href="<?php echo base_url() ?>/asset/bower_components/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<script src="<?php echo base_url() ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>   

<style>
   /* #emp-tab li a{color: chocolate; font-weight: bolder;}
   // #emp-tab .nav-tabs-custom>.nav-tabs>li.active {color: orange;}  */
     
    .nav-tabs-custom>.nav-tabs>li.active {
        border-top-color: orange; 
       
    }
    
    .nav-tabs-custom>.nav-tabs>li.active a {
        color: #FFF;  
         background-color: orange; 
    }
</style>
<script>


jQuery(function($) {  
    
     //$('#roles').wysihtml5();  
     //$('#responsibility').wysihtml5();  
     
   
       
     $('#employee_category').change(function() {  
        $("#designation_id > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-designation', id: $(this).val() },
                success: function(d) {   
                    
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('Select');
                    $('#designation_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.designation_id);
	                    opt1.text(info.designation_name);
	                    $('#designation_id').append(opt1); 
	                });
                }
         });  
     });
     
     
     $('#designation_id').change(function() {       
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'designation_info', id: $(this).val() },
                success: function(d) {
                    //$('#roles').wysihtml5();
                    $('#roles').val(d.roles);
                    //$('#responsibility').wysihtml5();
                    $('#responsibility').val(d.responsibility);
                    
                     
                }
         });  
     });        
    

     
       
     
});
</script>