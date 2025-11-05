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
    $('#add_modal #pf_salary_include').select2();
    $('#add_modal #esi_salary_include').select2();
    
     
     $('#edit_modal #pf_salary_include').select2();
     $('#edit_modal #esi_salary_include').select2();
    
    
    $(".edit_record").click(function() {   
        
       
      
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'esi_pf_info', id: $(this).val() },
                success: function(d) {     
                    $('#edit_modal #esi_pf_id').val(d.esi_pf_id) ; 
                    $('#edit_modal #pf_salary_max_limit').val(d.pf_salary_max_limit);  
                    $('#edit_modal #pf_salary_include').val(d.pf_salary_include.split(',')).trigger('change');;
                     $('#edit_modal #employer_pf').val(d.employer_pf); 
                    $('#edit_modal #employee_pf').val(d.employee_pf); 
                    $('#edit_modal #admin_pf').val(d.admin_pf); 
                    $('#edit_modal #pf_remarks').val(d.pf_remarks); 
                    $('#edit_modal #esi_salary_min_limit').val(d.esi_salary_min_limit); 
                    $('#edit_modal #esi_salary_include').val(d.pf_salary_include.split(',')).trigger('change');; 
                    $('#edit_modal #employer_esi').val(d.employer_esi); 
                    $('#edit_modal #employee_esi').val(d.employee_esi); 
                    $('#edit_modal #esi_remarks').val(d.esi_remarks);   
                }
      }); 
       
                
    });
    
});
</script>     