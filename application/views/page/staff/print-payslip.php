<?php
/*echo "<pre>"; 
print_r($payslip_info);
print_r($payslip_ctc_info);
echo "</pre>"; */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo date('F-Y' ,strtotime($payslip_info['payslip_month']));  ?>-Pay Slip-<?php echo $payslip_info['employee_code']  ?></title>
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
<body onload="window.print();">
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
                        <th colspan="4" class="text-center">
                            <h2>The Aalam Montessori School</h2>
                            32, Kalapatti-Kurumbapalayam Rd, Kalapatti, Coimbatore, Tamil Nadu 641048
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center text-uppercase">SALARY FOR THE MONTH OF <?php echo date('F Y' ,strtotime($payslip_info['payslip_month']));  ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="25%">Name</th>
                        <td width="25%"><?php echo $payslip_info['employee_name']  ?></td>
                        <th width="25%">Employee Code</th>
                        <td width="25%"><?php echo $payslip_info['employee_code']  ?></td>
                    </tr> 
                    <tr>
                        
                        <th scope="row">Department</th>
                        <td><?php echo $payslip_info['department']  ?></td>
                        <th scope="row">Designation</th>
                        <td><?php echo $payslip_info['designation']  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">PF No</th>
                        <td><?php echo $payslip_info['pf_no']  ?></td>
                        <th scope="row">UAN No</th>
                        <td><?php echo $payslip_info['uan_no']  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Actual Gross</th>
                        <td class="text-right"><?php echo number_format($payslip_info['fixed_salary'],2)  ?></td>
                        <th scope="row">LOP Days</th>
                        <td class="text-right"><?php echo $payslip_info['lop_day']  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">LOP Amount (Rs)</th>
                        <td class="text-right"><?php echo number_format(($payslip_info['lop_day'] * $payslip_info['per_day_salary']),2)  ?></td>
                        <th scope="row">Current Gross Salary</th>
                        <td class="text-right"><?php echo number_format($payslip_info['gross_salary'],2)  ?></td>
                    </tr> 
                    <tr >
                        <td colspan="2" class="no-border no-padding">
                           <table class="table table-condensed intfg"> 
                           <tr>
                                <th colspan="2" class="text-center" style="border-top: 0px; border-right: 0px;">Earnings</th> 
                            </tr>
                           <?php
	                          foreach($payslip_brkup_info as $i => $ls){ 
                            ?>
                                <tr>
                                    <td><?php echo $ls['breakup_name'];?></td> 
                                    <td class="text-right"><?php echo number_format($ls['salary_breakup_amt'],2)  ?></td> 
                                </tr>
                            <?php } ?>   
                             <?php for($k = count($payslip_brkup_info); $k<=5; $k++){ ?> 
                                <tr>
                                    <td>&nbsp;</td> 
                                    <td>&nbsp;</td> 
                                </tr>
                             <?php } ?>   
                                <tr>
                                    <th scope="row">Gross Earnings</th>
                                    <td class="text-right"><strong><?php echo number_format($payslip_info['gross_salary'],2)  ?></strong></td>
                                </tr>
                           </table>   
                        </td> 
                        <td colspan="2" class="no-border no-padding">
                           <table class="table table-condensed intfg"> 
                            <tr> 
                                <th colspan="2" class="text-center" style="border-top: 0px;">Deductions</th>
                            </tr>
                           <?php
	                          foreach($payslip_ded_info as $i => $ls){ 
                            ?>
                                <tr>
                                    <td style="border-left: 0px;"><?php echo $ls['deduction_name'];?></td> 
                                    <td class="text-right"><strong><?php echo number_format($ls['deduction_amt'],2)  ?></strong></td> 
                                </tr>
                            <?php } ?> 
                             <?php for($k = count($payslip_ded_info); $k<=5; $k++){ ?> 
                                <tr>
                                    <td style="border-left: 0px;">&nbsp;</td> 
                                    <td>&nbsp;</td> 
                                </tr>
                             <?php } ?>  
                            <tr>
                                <th style="border-left: 0px;">Total Deductions</th>
                                <td class="text-right"><strong><strong><?php echo number_format($payslip_info['deduction'],2)  ?></strong></strong></td>
                            </tr>  
                           </table>   
                        </td> 
                    </tr>  
                    
                     <tr>
                        <td colspan="2" class="no-border no-padding1">
                           <table class="table table-condensed intfg"> 
                           <tr>
                                <th colspan="2" class="text-center">COST TO COMPANY</th> 
                            </tr>
                            <tr>
                                <th scope="row">Gross Earnings</th>
                                <td class="text-right"><strong><?php echo number_format($payslip_info['gross_salary'],2)  ?></strong></td>
                            </tr>
                           <?php
	                          foreach($payslip_ctc_info as $i => $ls){ 
                            ?>
                                <tr>
                                    <td><?php echo $ls['ctc_name'];?></td> 
                                    <td class="text-right"><?php echo number_format($ls['ctc_amt'],2)  ?></td> 
                                </tr>
                            <?php } ?>    
                                <tr>
                                    <th><h4>TOTAL COST TO COMPANY (CTC)</h4></th>
                                    <td class="text-right"><h4><?php echo number_format($payslip_info['ctc'],2)  ?></h4></td>
                                </tr>
                                
                           </table>   
                        </td> 
                        <td colspan="2" class="no-border no-padding1">
                           <table class="table table-condensed intfg">  
                            <tr>
                                <th><h3>NET PAY</h3></th>
                                <td class="text-right"><strong><h3><?php echo number_format($payslip_info['net_salary'],2)  ?></h3></td>
                            </tr>  
                            <tr> 
                                <td class="text-left" colspan="2" style="height: 135px;">
                                   Amount in words : 
                                   <p class="text-center text-uppercase"><?php echo $this->cce_model->getIndianCurrency($payslip_info['net_salary']);?></p>
                                </td>
                            </tr>  
                            <tr> 
                                <td class="text-center" colspan="2">This is computer generated report signature not required.</td>
                            </tr> 
                           </table>   
                        </td> 
                    </tr>  
                </tbody>
            </table> 
        </div>
    </div> 
  </section> 
</div> 
</body>
</html>
