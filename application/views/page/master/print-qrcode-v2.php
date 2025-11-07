<?php include_once(VIEWPATH . '/inc/header.php'); ?>

<div class="row noprint filter-section">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-cogs"></i> Print Settings (Novajet MPL 40L – 39×35 mm)
                </h3>
            </div>
            <div class="box-body">
                <div class="box box-info" style="margin-top:15px;">
                    <div class="box-header">
                        <strong>
                            Select QR Codes to Print &nbsp; &nbsp; &nbsp;
                            <?php
                            echo
                                $defenition_list['asset_location_name'] . ' [' . $defenition_list['asset_location_code'] . '] => ' .
                                $defenition_list['asset_category_name'] . ' [' . $defenition_list['asset_category_code'] . '] => ' .
                                $defenition_list['asset_item_name'] . ' [' . $defenition_list['asset_item_code'] . '] => Qty: ' .
                                $defenition_list['asset_item_qty'];
                            ?>
                        </strong>


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
                                    <label style="cursor:pointer;">
                                        <input type="checkbox" class="qr-checkbox" data-index="<?php echo $i; ?>"
                                            value="<?php echo htmlspecialchars($qrc['qr_code_ctnt']); ?>" checked="checked"
                                            onchange="updateSelectedCount()">
                                        &nbsp;&nbsp;<?php echo htmlspecialchars($qrc['qr_code_ctnt']); ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start From Position:</label>
                                    <input type="number" class="form-control" id="start_from" value="1" min="1" max="40"
                                        style="max-width:180px;">
                                    <span class="help-block"><small>Position 1-40 (1 = top-left)</small></span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="button" class="btn btn-primary" onclick="applyFilter()">
                                        <i class="fa fa-filter"></i> Apply
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="resetFilter()"
                                        style="margin-left:5px;">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="window.print();"
                                        style="margin-left:5px;">
                                        <i class="fa fa-print"></i> Print
                                    </button>
                                    <span class="help-block"
                                        style="display:inline-block; margin-left:15px; margin-bottom:0;">
                                        <strong>Total:</strong> <?php echo count($qrcode); ?> |
                                        <strong>Selected:</strong> <span
                                            id="selected_count"><?php echo count($qrcode); ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer text-muted">
                <small>
                    <i class="fa fa-info-circle"></i> Layout: 5 columns × 8 rows = 40 labels per A4 sheet.
                    Each label is <strong>39 mm × 35 mm</strong>. Extra labels continue automatically on new pages.
                    <br><strong>Important:</strong> Set printer to 100% scale (no fit to page) with 0mm margins.
                </small>
            </div>
        </div>
    </div>
</div>



<div id="print_area"></div>

<?php include_once(VIEWPATH . '/inc/footer.php'); ?>