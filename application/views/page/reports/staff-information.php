<?php
// echo "<pre>"; 
//print_r($emp);
//print_r($dyn_list);
//print_r($emp_doc_list);
//echo "</pre>";  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $emp['employee_code']. '-' . $emp['employee_name']  ?> Information</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>asset/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.min.js"></script> 
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    @media print{
       .noprint{
           display:none;
       }
       
        body {
          overflow-y: hidden; /* Hide vertical scrollbar */
          overflow-x: hidden; /* Hide horizontal scrollbar */
        }
    }
    i{font-size: 12px;}
    #payslip td {border: 1px solid black;}
    #payslip th {border: 1px solid black;}
    #payslip .table td {border: 1px solid black;}
    #payslip .table th {border: 1px solid black;}
  </style>  
 
</head>
<body>
<?php 
 /*echo "<pre>";
print_r($record_list); 
echo "</pre>"; */
?>
<div class="wrapper1">
  <!-- Main content -->
  <section class="invoice">
    
    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-condensed " id="payslip">  
                <thead> 
                    <tr>
                        <th colspan="3" class="text-center">
                            <h2>The Aalam Montessori School</h2>
                            32, Kalapatti-Kurumbapalayam Rd, Kalapatti, Coimbatore, Tamil Nadu 641048
                        </th>
                        <th class="text-center">
                            <img src="<?php if(!empty($emp['photo_img'])) echo base_url($emp['photo_img']); else echo base_url('asset/images/user1.jpg');?>" alt="" class="img-rounded img-thumbnail profile-user-img" />
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center text-uppercase">Staff Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-info">
                        <th colspan="4" class="text-left">Basic Information</th>
                    </tr>
                    <tr>
                        <th width="25%">Name</th>
                        <td width="25%"><?php echo $emp['employee_name']  ?></td>
                        <th width="25%">Employee Code</th>
                        <td width="25%"><?php echo $emp['employee_code']  ?></td>
                    </tr> 
                    <tr>
                        <th>Gender</th>
                        <td><?php echo $emp['gender']  ?></td>
                        <th>DOB</th>
                        <td><?php echo date('d-M-Y', strtotime($emp['dob']))  ?></td>
                    </tr> 
                     <tr>
                        <th>Employee Category</th>
                        <td><?php echo $emp['employee_category']  ?></td>
                        <th>Join Date</th>
                        <td><?php echo date('d-M-Y', strtotime($emp['hire_date']));?></td>
                    </tr> 
                    <tr>
                        
                        <th scope="row">Department</th>
                        <td><?php echo $emp['department']  ?></td>
                        <th scope="row">Designation</th>
                        <td><?php echo $emp['designation']  ?></td>
                    </tr>
                    <tr>
                        <th>Blood Group</th>
                        <td><?php //echo $emp['marital_status'] ;?></td>
                        <th>Marital Status</th>
                        <td><?php echo $emp['marital_status'] ;?></td>
                    </tr> 
                    <tr class="bg-info">
                        <th colspan="4" class="text-left">Contact Information</th>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td><?php echo $emp['permanent_address']  ?></td>
                        <th>Temporary Address</th>
                        <td><?php echo $emp['temporary_address'] ;?></td>
                    </tr> 
                    <tr>
                        <th>Mobile</th>
                        <td><?php echo $emp['mobile']  ?></td>
                        <th>Alternate Mobile</th>
                        <td><?php echo $emp['alt_mobile'] ;?></td>
                    </tr> 
                    <tr>
                        <th>Email</th>
                        <td><?php echo $emp['email'];?></td>
                    </tr>    
                    <tr class="bg-info">
                        <th colspan="4" class="text-left">Leave Policy Infomation</th>
                    </tr>
                    <tr>
                        <th scope="row">Casual Leave</th>
                        <td><?php echo $emp['casual_leave']  ?></td>
                        <th scope="row">Sick Leave</th>
                        <td><?php echo $emp['medical_leave']  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Permission</th>
                        <td><?php echo $emp['permission']  ?></td>
                        <th scope="row">In & Out Time</th>
                        <td><?php echo $emp['in_time']  ?> & <?php echo $emp['out_time']  ?></td>
                    </tr>
                    <tr class="bg-info">
                        <th colspan="4" class="text-left">Salary Information</th>
                    </tr>
                    <tr>
                        <th scope="row">Salary</th>
                        <td><?php echo $emp['fixed_salary'];?></td>
                        <th scope="row">ESI & PF Required</th>
                        <td><?php echo ($emp['is_esi_pf_req'] == '1' ? 'Yes' : 'No')  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">PF No</th>
                        <td><?php echo $emp['pf_no']  ?></td>
                        <th scope="row">UAN No</th>
                        <td><?php echo $emp['uan_no']  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Salary Default A/c</th>
                        <td><?php echo $emp['emp_bank_def_ac']  ?></td> 
                    </tr>  
                    <?php foreach($dyn_list as $head => $ls){  ?>
                    <tr class="bg-info">
                        <th colspan="4" class="text-left"><?php echo $head ; ?></th>
                    </tr>
                    <?php for ($i=0; $i < count($ls) ; $i+=2) {  ?>
                    <tr>
                        <th scope="row"><?php echo $ls[$i]['fld_name']  ?></th>
                        <td class="text-left"><?php echo  $ls[$i]['fld_value']; ?></td> 
                        <th scope="row"><?php if(isset($ls[($i + 1)]['fld_name'])) echo $ls[($i + 1)]['fld_name']; else echo "-"; ?></th>
                        <td class="text-left"><?php if(isset($ls[($i + 1)]['fld_name'])) echo  $ls[($i + 1)]['fld_value']; else echo "-"; ?></td> 
                    </tr> 
                    <?php }  ?> 
                    <?php }  ?> 
                    <tr class="bg-info">
                        <th colspan="4" class="text-left">Uploaded Documents</th>
                    </tr>
                    <?php foreach($emp_doc_list as $j => $doc){  ?>
                    <tr>
                        <th scope="row"><?php echo $doc['doc_upload_type_name']  ?></th>
                        <td class="text-center"><i class="fa fa-check-square-o"></i></td> 
                        <td colspan="2" class="text-center"><a href="<?php echo base_url($doc['doc_path'])  ?>" target="_blank" class="btn btn-info btn-xs noprint" ><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <?php }  ?>     
                </tbody>
            </table> 
        </div>
        <div class="col-md-12 text-center">
            <button type="button" name="btn_print" class="btn btn-success " onclick="window.print();"><i class="fa fa-print"></i> Print</button>
        </div>
    </div> 
  </section> 
</div> 
</body>
</html>
