 <style>
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
     
   // $('#roles').wysihtml5();  
   // $('#responsibility').wysihtml5();  
    
    //$('#designation_id').change();
       
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
                success: function(d) { //alert(d.roles);
                    //$('#roles').refresh(); 
                    $('#roles').val(d.roles); 
                    //$('#responsibility').refresh();
                    $('#responsibility').val(d.responsibility);
                    
                     
                }
         });  
     });   
     
     
     $(".edit_doc_emp").click(function() {   
     // alert($(this).val());
      $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'emp_doc_upload_info', id: $(this).val() },
                success: function(d) {                                 
                    // alert(d.doc_upload_type_id);
                    $('#edit_doc_modal #emp_doc_upload_id').val(d.emp_doc_upload_id) ; 
                    $('#edit_doc_modal #doc_upload_type_id').val(d.doc_upload_type_id) ; 
                    $('#edit_doc_modal #emp_doc_path').val(d.doc_path) ; 
                    $('#edit_doc_modal #remarks').val(d.remarks) ; 
                    //$('#edit_modal input:radio[value='+ d.status +']').prop('checked', true);   
                }
      }); 
      
       
                
    });
     
     $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'emp_doc_upload_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });   
     
     
     $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
		localStorage.setItem('parentTab', $(this).closest('ul').attr('id'));
	});
	var activeTab = localStorage.getItem('activeTab');
	var parentTab = localStorage.getItem('parentTab');
	if(activeTab){
		$('#'+ parentTab +' a[href="' + activeTab + '"]').tab('show');
	} 
     
    
     
});
</script>