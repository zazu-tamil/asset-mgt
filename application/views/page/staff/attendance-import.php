
<?php  include_once(VIEWPATH . '/inc/header.php'); ?>
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
    <div class="box box-info">
        <div class="box-header with-border bg-info">  
             <b>Staff Attendance Import From Excel File</b>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4 form-group"><strong class="text-fuchsia">Step 1</strong></div>
                <div class="col-md-4 form-group"><strong class="text-fuchsia">Step 2</strong></div>
                <div class="col-md-4 form-group"><strong class="text-fuchsia">Step 3</strong></div>
            </div>    
            <div class="row">
                <div class="col-md-4 form-group">
                    <a href="<?php echo base_url('asset/staff-attendance-format.xlsx');?>" class="btn btn-info">Download Xls File Format</a>
                </div>
                <form method="post" action="<?php echo site_url('attendance-import-xls'); ?>" enctype="multipart/form-data">
                <div class="col-md-4 form-group"> 
                        <label>Upload Staff Attendance Excel File</label>
                        <input type="file" name="attendance_file" id="attendance_file" class="form-control" /> 
                </div>
                <div class="col-md-4 form-group"> 
                        <label>Click To Import</label>  
                        <button type="submit" name="btn_import" class="btn btn-success btn-sm form-control">Import Staff Attendance</button>
                 </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?php  include_once(VIEWPATH . 'inc/footer.php'); ?>    