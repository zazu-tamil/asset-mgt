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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="start_from">Start From Count:</label>
                                        <input type="number" class="form-control" id="start_from"
                                            placeholder="Enter blank space count (e.g., 0, 5, 10)" value="0" min="0"
                                            max="<?php echo count($qrcode); ?>"
                                            style="max-width:180px; margin-left:10px;">
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">  
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

            <div class="box-footer text-muted">
                <small>
                    <i class="fa fa-info-circle"></i> Layout: 5 columns × 8 rows = 40 labels per page (A4).
                    Each label is <strong>39 mm × 35 mm</strong>. Use "Start From Count" to skip labels.
                    Only checked QR codes will be printed.
                </small>
            </div>
        </div>
    </div>
</div>

<!-- ================= QRCode.js ================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<!-- ================= CSS ================= -->
<style>
    @media print {
        .noprint {
            display: none !important;
        }

        @page {
            size: A4 portrait;
            margin: 0.5mm;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            font-family: Arial, sans-serif;
        }

        #qr_table td {
            border: none;
            padding: 1.5mm;
            box-sizing: border-box;
        }

        tr {
            page-break-inside: avoid;
        }

        .text-sm {
            font-size: 10px;
            text-transform: uppercase;
            display: block;
            text-align: center;
            word-break: break-all;
            margin-bottom: 7px !important;
            margin-top: 5px;
        }
    }

    #qr_table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin: 0 auto;
    }

    #qr_table td {
        text-align: center;
        vertical-align: middle;
        border: 1px dashed #ccc;
        padding: 10px 10px;
        box-sizing: content-box;
    }

    .qr-container {
        width: 25mm;
        height: 25mm;
        margin: 0 auto;
    }

    .qr-container canvas {
        width: 25mm !important;
        height: 25mm !important;
    }

    .text-sm {
        font-size: 12px;
        text-transform: uppercase;
        display: block;
        text-align: center;
        word-break: break-all;
        margin-bottom: 5px !important;
    }
</style>

<!-- ================= QR Code Grid ================= -->
<table class="table table-condensed no-margin" id="qr_table"></table>

<?php include_once(VIEWPATH . '/inc/footer.php'); ?>

<!-- ================= JS Logic ================= -->
<script>
    var allQRCodes = <?php echo json_encode($qrcode); ?>;
    var totalQRCodes = allQRCodes.length;

    $(document).ready(function () {
        renderQRTable(0);
        $('#start_from').val(0);
        updateSelectedCount();
    });

    // Get selected QR codes based on checkboxes
    function getSelectedQRCodes() {
        var selected = [];
        $('.qr-checkbox:checked').each(function () {
            var index = parseInt($(this).data('index'));
            selected.push(allQRCodes[index]);
        });
        return selected;
    }

    // Update selected count display
    function updateSelectedCount() {
        var count = $('.qr-checkbox:checked').length;
        $('#selected_count').text(count);
    }

    // Select all checkboxes
    function selectAll() {
        $('.qr-checkbox').prop('checked', true);
        updateSelectedCount();
        applyFilter();
    }

    // Deselect all checkboxes
    function deselectAll() {
        $('.qr-checkbox').prop('checked', false);
        updateSelectedCount();
        applyFilter();
    }

    // Render QR Code Table
    function renderQRTable(startFrom) {
        var $table = $('#qr_table');
        $table.empty();

        // Get only selected QR codes
        var selectedQRCodes = getSelectedQRCodes();

        if (selectedQRCodes.length === 0) {
            $table.append('<tr><td colspan="5" style="text-align:center; padding:20px;">No QR codes selected for printing</td></tr>');
            return;
        }

        var colsPerRow = 5;
        var cellCount = 0, qrIndex = 0;
        var $currentRow = null;

        // Blank cells before first label
        for (var i = 0; i < startFrom; i++) {
            if (cellCount % colsPerRow === 0) {
                $currentRow = $('<tr></tr>');
                $table.append($currentRow);
            }
            $currentRow.append('<td></td>');
            cellCount++;
        }

        // Populate selected QR Codes
        for (qrIndex = 0; qrIndex < selectedQRCodes.length; qrIndex++) {
            if (cellCount % colsPerRow === 0) {
                $currentRow = $('<tr></tr>');
                $table.append($currentRow);
            }

            var qrData = selectedQRCodes[qrIndex];
            var uniqueId = 'qrcode_' + qrIndex + '_' + Date.now();
            var $td = $('<td></td>');
            var $qrDiv = $('<div class="qr-container" id="' + uniqueId + '"></div>');
            var $text = $('<strong class="text-sm">' + qrData.qr_code_ctnt.toLowerCase() + '</strong>');

            $td.append($qrDiv).append($text);
            $currentRow.append($td);

            // Generate QR
            setTimeout((function (id, content) {
                return function () {
                    new QRCode(document.getElementById(id), {
                        text: content,
                        width: 100,
                        height: 100,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                };
            })(uniqueId, qrData.qr_code_ctnt), 10);

            cellCount++;
        }

        // Fill remaining empty cells to complete last row
        while (cellCount % colsPerRow !== 0) {
            $currentRow.append('<td></td>');
            cellCount++;
        }
    }

    // Apply Filter - start position for blank labels
    function applyFilter() {
        var startFrom = parseInt($('#start_from').val());
        if (isNaN(startFrom) || startFrom < 0) {
            startFrom = 0;
        }
        renderQRTable(startFrom);
    }

    // Reset Filter
    function resetFilter() {
        $('#start_from').val(0);
        renderQRTable(0);
    }
</script>