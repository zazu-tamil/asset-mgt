<?php
/*echo "<pre>"; 
print_r($salary_bank_submit); 
echo "</pre>";  */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo date('F-Y' ,strtotime($salary_bank_submit[0]['payslip_month']. '-01'));  ?> - Salary Bank Submission</title>
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
            <h2><?php echo date('F-Y' ,strtotime($salary_bank_submit[0]['payslip_month']. '-01'));  ?> - Salary Bank Submission</h2>
            <table class="table table-condensed " id="payslip">  
                <tr>
                    <th>Type of Transfer</th>
                    <th>Amount</th>
                    <th>Date Of Transaction</th>
                    <th>Name</th>
                    <th>Account Number</th>
                    <th width="10%">&nbsp;</th>
                    <th width="10%">&nbsp;</th>
                    <th>Debit Account Number</th>
                    <th>Fund Transfer Detail with year month and number</th>
                    <th>IFSC</th>
                    <th>Transaction Code</th>
                    <th>Description</th>
                </tr>
                <?php if(!empty($salary_bank_submit)) {?>
                <?php foreach($salary_bank_submit as $k => $ls ) {?>
                    <tr>
                        <td><?php echo $ls['transfer_type'] ?></td>
                        <td><?php echo $ls['amount'] ?></td>
                        <td><?php echo $ls['transaction_date'] ?></td>
                        <td><?php echo $ls['name'] ?></td>
                        <td><?php echo $ls['ac_no'] ?></td>
                        <td>&nbsp;</td> 
                        <td>&nbsp;</td> 
                        <td><?php echo $ls['debit_ac_no'] ?></td>
                        <td>Fund Transfer for the <?php echo date('M-Y' ,strtotime($ls['payslip_month']. '-01'));  ?></td>
                        <td><?php echo $ls['ifsc'] ?></td>
                        <td><?php echo $ls['tran_code'] ?></td>
                        <td>Salary for the <?php echo date('M-Y' ,strtotime($ls['payslip_month']. '-01'));  ?></td>
                    </tr>
                <?php } ?>
                <?php } ?>
            </table>     
        </div>
    </div> 
  </section> 
</div> 
</body>
</html>
