<?php include_once(VIEWPATH . '/inc/header.php'); ?>

<!-- ================= Filter Section (Not Printed) ================= -->
<div class="row noprint filter-section">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-cogs"></i> Print Settings (Novajet MPL 40L – 39×35 mm)
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <div class="box box-info" style="margin-top:15px;">
                    <div class="box-header">
                        <strong>Select QR Codes to Print</strong>
                        <div class="pull-right">
                            <button type="button" class="btn btn-xs btn-success" onclick="selectAll()">
                                <i class="fa fa-check-square-o"></i> Select All
                            </button>
                            <button type="button" class="btn btn-xs btn-warning" onclick="deselectAll()">
                                <i class="fa fa-square-o"></i> Deselect All
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <?php foreach ($qrcode as $i => $qrc) { ?>
                                <div class="col-md-2 col-sm-3 col-xs-4">
                                    <label for="showqrcode_<?php echo $i; ?>" style="cursor:pointer;">
                                        <input type="checkbox" class="qr-checkbox" name="showqrcode[]"
                                            id="showqrcode_<?php echo $i; ?>"
                                            value="<?php echo htmlspecialchars($qrc['qr_code_ctnt']); ?>"
                                            data-index="<?php echo $i; ?>" checked="checked"
                                            onchange="updateSelectedCount()">
                                        &nbsp;&nbsp;<?php echo htmlspecialchars($qrc['qr_code_ctnt']); ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row" style="margin-top:25px;"> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="start_from">Start From Count:</label>
                                        <input type="number" class="form-control" id="start_from"
                                            placeholder="Enter blank space count (e.g., 0, 5, 10)" value="1" min="1"
                                            max="<?php echo count($qrcode); ?>"
                                            style="max-width:180px; margin-left:10px;">
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4" >
                                <div class="form-group">  
                                    <br>
                                    <button type="button" class="btn btn-primary" onclick="applyFilter()"
                                        style="margin-left:10px;">
                                        <i class="fa fa-filter"></i> Apply
                                    </button>

                                    <button type="button" class="btn btn-default" onclick="resetFilter()"
                                        style="margin-left:5px;">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>

                                    <button type="button" name="btn_print" class="btn btn-success"
                                        onclick="window.print();" style="margin-left:5px;">
                                        <i class="fa fa-print"></i> Print
                                    </button>

                                    <span class="help-block" style="margin-left:15px; display:inline-block;">
                                        <strong>Total QR Codes:</strong> <?php echo count($qrcode); ?> |
                                        <strong>Selected:</strong> <span
                                            id="selected_count"><?php echo count($qrcode); ?></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer text-muted text-center text-danger">
                <small>
                    <i class="fa fa-info-circle"></i> Layout: 5 columns × 8 rows = 40 labels per page (A4).
                    Each label is <strong>39 mm × 35 mm</strong>. Use "Start From Count" to skip labels.
                    Only checked QR codes will be printed.
                </small>
            </div>
        </div>
    </div>
</div>


<!-- ================= QR Code Grid ================= -->
<table class="table table-condensed1 no-margin" id="qr_table"></table>
<!-- <div class="no-margin" id="qr_table1"></div> -->

<?php include_once(VIEWPATH . '/inc/footer.php'); ?>

