<?php
/*echo "<pre>"; 
print_r($qrcode); 
echo "</pre>";  */
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        @media print {
            .noprint {
                display: none;
            }

            body {
                overflow-y: hidden;
                /* Hide vertical scrollbar */
                overflow-x: hidden;
                /* Hide horizontal scrollbar */
            }

            .text-sm {
                text-transform: uppercase;
            }

        }

        i {
            font-size: 12px;
        }

        #payslip td {
            border: 1px solid black;
        }

        #payslip th {
            border: 1px solid black;
        }

        #payslip .table td {
            border: 1px solid black;
        }

        #payslip .table th {
            border: 1px solid black;
        }

        #payslip .qrsize {
            width: 132px;
            height: 147px;
        }

        #labeltbl .lbl {
            width: 132px;
            height: 147px;
            border: 1px solid red;
        }

        .text-sm {
            text-transform: uppercase;
        }
    </style>

</head>

<body>
    <?php
    //echo ceil(count($qrcode)/4);
    ?>
    <div class="wrapper1" style="display: none;">
        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-bordered table-condensed table-striped" id="">
                        <?php
                        $cnt = count($qrcode);
                        $cnt_row = ceil(count($qrcode) / 5);
                        $k = 0;
                        for ($i = 0; $i < ceil(count($qrcode) / 5); $i++) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <?php if (isset($qrcode[($k)])) { ?>
                                        <img src="<?php echo base_url($qrcode[($k)]['qr_path']) ?>" class="img qrsize" />

                                        <b class="text-sm"><?php echo strtolower($qrcode[($k)]['qr_code_ctnt']) ?></b>
                                    <?php } ?>
                                </td>
                                <td class="text-center qrsize">
                                    <?php if (isset($qrcode[($k + 1)])) { ?>
                                        <img src="<?php echo base_url($qrcode[($k + 1)]['qr_path']) ?>" class="img qrsize" />
                                        <br />
                                        <strong
                                            class="text-sm"><?php echo strtolower($qrcode[($k + 1)]['qr_code_ctnt']); ?></strong>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($qrcode[($k + 2)])) { ?>
                                        <img src="<?php echo base_url($qrcode[($k + 2)]['qr_path']) ?>" class="img qrsize" />
                                        <br />
                                        <strong
                                            class="text-sm"><?php echo strtolower($qrcode[($k + 2)]['qr_code_ctnt']) ?></strong>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($qrcode[($k + 3)])) { ?>
                                        <img src="<?php echo base_url($qrcode[($k + 3)]['qr_path']) ?>" class="img qrsize" />
                                        <br />
                                        <strong
                                            class="text-sm"><?php echo strtolower($qrcode[($k + 3)]['qr_code_ctnt']) ?></strong>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php if (isset($qrcode[($k + 4)])) { ?>
                                        <img src="<?php echo base_url($qrcode[($k + 4)]['qr_path']) ?>" class="img qrsize" />
                                        <br />
                                        <strong
                                            class="text-sm"><?php echo strtolower($qrcode[($k + 4)]['qr_code_ctnt']) ?></strong>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $k += 5;
                        } ?>
                    </table>
                </div>
            </div>
            <div class="row noprint">
                <div class="col-md-12 text-center">
                    <button type="button" name="btn_print" class="btn btn-success " onclick="window.print();"><i
                            class="fa fa-print"></i> Print</button>
                </div>
            </div>

        </section>

    </div>

    <table class="table table-condensed no-margin">
        <?php
        $cnt = count($qrcode);
        $cnt_row = ceil(count($qrcode) / 5);
        $k = 0;
        for ($i = 0; $i < ceil(count($qrcode) / 5); $i++) {
            ?>
            <tr>
                <td class="text-center" style="width: 39mm;height:35mm;">
                    <?php if (isset($qrcode[($k)])) { ?>
                        <img src="<?php echo base_url($qrcode[($k)]['qr_path']) ?>" class="img"
                            style="width: 35mm;height:30mm;" />
                        <p class="text-sm"><?php echo strtolower($qrcode[($k)]['qr_code_ctnt']) ?></p>
                    <?php } ?>
                </td>
                <td class="text-center" style="width: 39mm;height:35mm;">
                    <?php if (isset($qrcode[($k + 1)])) { ?>
                        <img src="<?php echo base_url($qrcode[($k + 1)]['qr_path']) ?>" class="img"
                            style="width: 35mm;height:30mm;" />
                        <p class="text-sm"><?php echo strtolower($qrcode[($k + 1)]['qr_code_ctnt']) ?></p>
                    <?php } ?>
                </td>
                <td class="text-center" style="width: 39mm;height:35mm;">
                    <?php if (isset($qrcode[($k + 2)])) { ?>
                        <img src="<?php echo base_url($qrcode[($k + 2)]['qr_path']) ?>" class="img"
                            style="width: 35mm;height:30mm;" />
                        <p class="text-sm"><?php echo strtolower($qrcode[($k + 2)]['qr_code_ctnt']) ?></p>
                    <?php } ?>
                </td>
                <td class="text-center" style="width: 39mm;height:35mm;">
                    <?php if (isset($qrcode[($k + 3)])) { ?>
                        <img src="<?php echo base_url($qrcode[($k + 3)]['qr_path']) ?>" class="img"
                            style="width: 35mm;height:30mm;" />
                        <p class="text-sm"><?php echo strtolower($qrcode[($k + 3)]['qr_code_ctnt']) ?></p>
                    <?php } ?>
                </td>
                <td class="text-center" style="width: 39mm;height:35mm;">
                    <?php if (isset($qrcode[($k + 4)])) { ?>
                        <img src="<?php echo base_url($qrcode[($k + 4)]['qr_path']) ?>" class="img"
                            style="width: 35mm;height:30mm;" />
                        <p class="text-sm"><?php echo strtolower($qrcode[($k + 4)]['qr_code_ctnt']) ?></p>
                    <?php } else {
                        echo "&nbsp;";
                    } ?>
                </td>
            </tr>
            <?php $k += 5;
        } ?>

    </table>
    <div class="row noprint">
        <div class="col-md-12 text-center">
            <button type="button" name="btn_print" class="btn btn-success " onclick="window.print();"><i
                    class="fa fa-print"></i> Print</button>
        </div>
    </div>
</body>

</html>