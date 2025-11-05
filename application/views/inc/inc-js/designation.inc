<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/select2/dist/css/select2.min.css">
<script src="<?php echo base_url() ?>asset/bower_components/select2/dist/js/select2.full.min.js"></script>
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #0080FF;
    border: 1px solid #000;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #000;
    cursor: pointer;
    display: inline-block;
    font-weight: bold;
    margin-right: 2px;
}
</style>
<script>
jQuery(function($) {    
    
    $('#salary_brkup_modal #pct_of_salary_breakup_id').select2();


    $(".btn_salary_brkup").click(function() {  
        //alert($(this).val()) ;
    
        $('#salary_brkup_modal #designation_id').val($(this).val()) ; 
        
        $.ajax({
                url: "<?php echo site_url('get-content');?>",
                type: "post",
                data: { tbl : 'designation-salary-breakup', id: $(this).val() ,edit_mode : 1, del_mode : 1},
                success: function(ctnt) {                                 
                     //alert(ctnt);
                    $('#salary_brkup_modal .brekup_list').html(ctnt) ; 
                     
                }
        }); 
        
        
    });
    
    $(document).on('click','#salary_brkup_modal .btn_cancel', function () { 
        location.reload();       
    });  
      
    $(document).on('click','#salary_brkup_modal .btn_chld_edit', function () { 
        
        //alert($(this).val());
        $('#salary_brkup_modal #desgn_salary_brk_id').val($(this).val());
        $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'designation-salary-breakup', id: $(this).val() },
                success: function(d) {                                 
                    // alert(d.pct_of_salary_breakup_id);
                    $('#salary_brkup_modal #mode').val('Edit Salary Breakup') ;  
                   // $('#salary_brkup_modal #as_on_date').val(d.as_on_date) ;  
                    $('#salary_brkup_modal #designation_id').val(d.designation_id) ;  
                    $('#salary_brkup_modal #salary_breakup_id').val(d.salary_breakup_id) ;  
                    $('#salary_brkup_modal #salary_breakup_pct').val(d.salary_breakup_pct) ;  
                    $('#salary_brkup_modal #pct_of_salary_breakup_id').val(d.pct_of_salary_breakup_id).trigger('change');
                    //$('#salary_brkup_modal #pct_of_salary_breakup_id').val(JSON.stringify(d.pct_of_salary_breakup_id.split(','))); 
                    $('#salary_brkup_modal #sort_order').val(d.sort_order) ;  
                    $('#salary_brkup_modal input:radio[value="'+ d.status +'"]').prop('checked', true); 
                    $('#salary_brkup_modal #btn_action').val('Update');
                }
        }); 
     });
    
    
     $(document).on('click','#salary_brkup_modal .btn_chld_del', function () {
        //alert(  $(this).attr('data') + $(this).val());
        
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : $(this).attr('data'), id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         } 
     });   
    
    
    $(".edit_record").click(function() {  
      
      //alert($(this).val());
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'designation_info', id: $(this).val() },
                success: function(d) {   //alert(d.designation_name);
                    $('#edit_modal #designation_id').val(d.designation_id) ; 
                    $('#edit_modal #employee_category').val(d.employee_category); 
                    $('#edit_modal #designation_name').val(d.designation_name);  
                    $('#edit_modal #roles').val(d.roles); 
                    $('#edit_modal #responsibility').val(d.responsibility); 
                    $('#edit_modal input:radio[value="'+ d.status +'"]').prop('checked', true);  
                }
      }); 
       
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'designation_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 