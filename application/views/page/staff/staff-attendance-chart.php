<?php  include_once(VIEWPATH . '/inc/header.php');
/*echo "<pre>";
print_r($attendance);
print_r($emp_info);
echo "</pre>";*/

 ?>
 <section class="content-header">
  <h1><?php echo $title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cubes"></i> Staff Payroll</a></li> 
    <li><a href="#"><i class="fa fa-cubes"></i> Attendance</a></li> 
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  <!-- Default box -->
  <div class="box box-info no-print"> 
    <div class="box-header with-border">
      <h3 class="box-title text-white">Search Filter</h3>
    </div>
    <div class="box-body">
         <form method="post" action="<?php echo site_url('staff-attendance-chart') ?>" id="frmsearch">          
         <div class="row">  
             <div class="form-group col-md-3">
                <label>Month</label> 
                <input type="month" name="srch_month" id="srch_month" class="form-control" value="<?php echo set_value('srch_month',$srch_month);?>" />
              </div>
              
             <div class="form-group col-md-3">
                <label>Employee Category</label> 
                <?php echo form_dropdown('srch_emp_category',array('' => 'All') + $emp_category_opt  ,set_value('srch_emp_category',$srch_emp_category) ,' id="srch_emp_category" class="form-control"');?> 
              </div>  
             <div class="form-group col-md-3">
                <label>Department</label> 
                <?php echo form_dropdown('srch_department',array('' => 'All') + $department_opt  ,set_value('srch_department',$srch_department) ,' id="srch_department" class="form-control"');?> 
              </div>
              
              <div class="form-group col-md-3 text-right">
                <br />
                <button class="btn btn-success" name="btn_show" value="Show"><i class="fa fa-search"></i> Show</button>
              </div>
         </div>  
        </form>
     </div> 
  </div>   
  <div class="box box-info">
    <div class="box-header with-border">
     Attendance Chart for <?php echo date('F , Y',strtotime($srch_month));?>
    </div>
    <div class="box-body table-responsive"> 
       <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr> 
                <th rowspan="2">Employee</th>  
                <th class="text-center" colspan="<?php echo date('t',strtotime($srch_month)); ?>"><?php echo date('F , Y',strtotime($srch_month));?></th>
            </tr>
            <tr>  
                <?php  
                for ($j=1 ;$j<=(date('t',strtotime($srch_month)));$j++){
				 echo "<th class='text-center'>".$j .'<br><i>'. date('D',strtotime($srch_month.'-'.$j))."</i></th>";
				} 
                ?> 
            </tr>
            
        </thead>
          <tbody>
                <?php foreach($emp_info as $code => $info) {?>
               <tr>
                    <td>
                        <?php echo $code; ?> - <?php echo $info['employee_name']?><br />
                        <i class="label label-info"><?php echo $info['employee_category']?></i>
                    </td>
                    <?php  
                    for ($j=1 ;$j<=(date('t',strtotime($srch_month)));$j++){
                     if(isset($attendance[$code][(date('Y-m-d',strtotime($srch_month.'-'.$j)))])) {
    				    //echo "<td class='text-center'><i class='badge'>P</i><i class='label label-info '>". $attendance[$code][(date('Y-m-d',strtotime($srch_month.'-'.$j)))]['hrs']."</i></td>";
    				    echo "<td class='text-center'><i class='label label-success'>P</i></td>";
                     } else {
                        echo "<td class='text-center'><i class='label label-warning'>A</i></td>";
                     }
    				} 
                    ?> 
               </tr>   
               <?php } ?>                       
          </tbody>
      </table> 
        
    </div>
    <!-- /.box-body -->
    
  </div>
  <!-- /.box -->
 

</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>
