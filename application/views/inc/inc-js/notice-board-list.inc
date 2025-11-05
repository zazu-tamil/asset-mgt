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
    
    $('#add_modal #employee_id').select2();
    $('#edit_modal #employee_id').select2();

    function datetimeLocal(datetime) {
        const dt = new Date(datetime);
        dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
        return dt.toISOString().slice(0, 16);
    }
    
    
    $('#add_modal #employee_category').change(function() {  
        $("#add_modal #designation_id > option").remove();    
        $("#add_modal #employee_id > option").remove();   
            
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-designation', id: $(this).val() },
                success: function(d) {   
                    
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('All');
                    $('#add_modal #designation_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.designation_id);
	                    opt1.text(info.designation_name);
	                    $('#add_modal #designation_id').append(opt1); 
	                });
                }
         });  
     });
     
     $('#edit_modal #employee_category').change(function(e, para = 0) {  //alert("PAra" + para);
        $("#edit_modal #designation_id > option").remove();      
        $("#edit_modal #employee_id > option").remove();     
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-designation', id: $(this).val() },
                success: function(d) {   
                    
                    var opt1 = $('<option />'); 
                    opt1.val('');
                    opt1.text('All');
                    $('#edit_modal #designation_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.designation_id);
	                    opt1.text(info.designation_name);
                        if(para == info.designation_id)
                          opt1.attr('selected','selected');
	                    $('#edit_modal #designation_id').append(opt1); 
	                });
                }
         });  
     });
    
    $('#add_modal #designation_id').change(function() {  
        $("#add_modal #employee_id > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-design-employee', id: $(this).val() },
                success: function(d) {   
                    
                   // var opt1 = $('<option />'); 
                   // opt1.val('');
                   // opt1.text('All');
                   // $('#add_modal #employee_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.employee_id);
	                    opt1.text(info.employee_name + ' [ ' + info.department_name + ' ]'); 
	                    $('#add_modal #employee_id').append(opt1); 
	                });
                }
         });  
     });
     
      $('#edit_modal #designation_id').change(function( e, para = 0 , para2 = 0) {  
        //alert(para + " : " + $('#edit_modal #designation_id').val()) ;
        //alert($('#edit_modal #designation_id').val() == null ? para2 : $('#edit_modal #designation_id').val()); 
        $("#edit_modal #employee_id > option").remove();      
          $.ajax({
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'get-design-employee', id: ($('#edit_modal #designation_id').val() == null ? para2 : $('#edit_modal #designation_id').val()) },
                success: function(d) {   
                    
                   // var opt1 = $('<option />'); 
                   // opt1.val('');
                   // opt1.text('All');
                   // $('#edit_modal #employee_id').append(opt1); 
                    
    				$.each(d,function(key,info) 
	                {
	                    var opt1 = $('<option />'); 
	                    opt1.val(info.employee_id);
	                    opt1.text(info.employee_name + ' [ ' + info.department_name + ' ]');
                         
                        if(para != 0) {
                            if(jQuery.inArray( info.employee_id, para.split(',') ) != '-1') {
                                opt1.attr('selected','selected');
                            }
                        }
	                   
                        $('#edit_modal #employee_id').append(opt1); 
	                });
                    
                   //$('#edit_modal #employee_id').select2();
                }
         });  
     });

    $(".edit_record").click(function() {   
        
      $.ajax({
            url: "<?php echo site_url('get-data');?>",
            type: "post",
            data: { tbl : 'notice_board_info', id: $(this).val() },
            success: function(d) {  // alert(d.employee_id);
                $('#edit_modal #notice_board_id').val(d.notice_board_id) ; 
                $('#edit_modal #notice_date').val(d.notice_date) ; 
                $('#edit_modal #notice_title').val(d.notice_title) ; 
                $('#edit_modal #notice_start_date').val(datetimeLocal(d.notice_start_date)) ; 
                $('#edit_modal #notice_end_date').val(datetimeLocal(d.notice_end_date)) ; 
                $('#edit_modal #notice_msg').val(d.notice_msg) ;  
                $('#edit_modal #employee_category').val(d.employee_category).trigger('change',[ d.designation_id ]) ;  
                $('#edit_modal #designation_id').val(d.designation_id).trigger('change',[ d.employee_id ,d.designation_id  ]) ;
               // $('#edit_modal #designation_id').change() ;
               //alert( "S:" + d.employee_id.split(','));
                // var k = d.employee_id.split(',');
                //$('#edit_modal #employee_id').select2(k);
                $('#edit_modal input:radio[value='+ d.status +']').prop('checked', true);
               
            }
         }); 
      
        
                
    });
    
    
    $('.del_record').click(function() {  
        if (confirm('Are U sure want to delete ??')) {
             $.ajax({
                    url: "<?php echo site_url('delete-record');?>",
                    type: "post",
                    data: { tbl : 'notice_board_info', id: $(this).val() },
                    success: function(d) {  
                        alert(d);
                        location.reload();
                    }
             });
         }
        
     });  

});
</script> 