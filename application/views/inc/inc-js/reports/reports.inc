
<script src="https://rawgit.com/Snack-X/excelexport.js/master/excelexport.js"></script>
<script>
jQuery(function($) {  
 
	$(".dl-xls").click(function() {   
    
    var ee = excelExport("content-table").parseToCSV().parseToXLS($(this).attr('data')); 
		location.href = ee.getXLSDataURI();
	}); 
       
    
}); 
 
</script> 
<style>
    @media print{
       .noprint{
           display:none;
       } 
    }
</style>    