
<!-- ================= QRCode.js ================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<!-- ================= CSS ================= -->
<style>
    @media print {
        .noprint {
            display: none !important;
        }

        .empty {
             display: block !important;
            color: #ffffff !important;
            background: transparent !important;
            visibility: visible !important;
        }

        @page {
            size: A4 portrait;
            margin: 0.5mm;
            padding-top:10px; 
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

    .empty {
             display: block !important;
            color: #ffffff !important;
            background: transparent !important;
            visibility: visible !important;
        }

    #qr_table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        
        border:0px solid red;
    }

    #qr_table td {
        text-align: center;
        vertical-align: middle;
       /* border: 1px dashed #ccc;*/
        border: 0px dashed #1a181cff;
        /*padding: 10px 10px;*/
        box-sizing: content-box; 
    }

    .divtd{
        width: 39mm;
        height: 33mm; 
        border:0px solid black;
        padding-top:2mm;
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
        font-size: 10px;
        text-transform: uppercase;
        display: block;
        text-align: center;
        word-break: break-all;
        margin-bottom: 2px !important;
    }
</style>

<!-- ================= JS Logic ================= -->
<script>
    var allQRCodes = <?php echo json_encode($qrcode); ?>;
    var totalQRCodes = allQRCodes.length;

    $(document).ready(function () {
        renderQRTable(0);
        $('#start_from').val(1);
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
        for (var i = 1; i < startFrom; i++) {
            if (cellCount % colsPerRow === 0) {
                $currentRow = $('<tr></tr>');
                $table.append($currentRow);
            }
            //$currentRow.append('<td></td>');
            var $td = $('<td></td>');
            var $divtd = $('<div class="divtd"></div>');
            var $qrDiv = $('<div class="qr-container empty" id="empty">empty</div>');
            var $text = $('<strong class="text-sm empty">44</strong>');

            $divtd.append($qrDiv).append($text);
            $td.append($divtd);
            $currentRow.append($td);

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
            var $divtd = $('<div class="divtd"></div>');
            var $qrDiv = $('<div class="qr-container" id="' + uniqueId + '"></div>');
            var $text = $('<strong class="text-sm">' + qrData.qr_code_ctnt.toLowerCase() + '</strong>');

            //$td.append($qrDiv).append($text);
            $divtd.append($qrDiv).append($text);
            $td.append($divtd);
            $currentRow.append($td);

            // Generate QR
            setTimeout((function (id, content) {
                return function () {
                    new QRCode(document.getElementById(id), {
                        text: content,
                        width: 90,
                        height: 90,
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

    function renderQRTable11(startFrom) {
        var $table = $('#qr_table1');
        $table.empty();

        // Get only selected QR codes
        var selectedQRCodes = getSelectedQRCodes();

        if (selectedQRCodes.length === 0) {
           // $table.append('<tr><td colspan="5" style="text-align:center; padding:20px;">No QR codes selected for printing</td></tr>');
            $table.append('<div style="text-align:center; padding:20px;">No QR codes selected for printing</div>');
            return;
        }

        var colsPerRow = 5;
        var cellCount = 0, qrIndex = 0;
        var $currentRow = null;

        // Blank cells before first label
        for (var i = 1; i < startFrom; i++) {
            if (cellCount % colsPerRow === 0) {
                $currentRow = $('<div></div>');
                $table.append($currentRow);
            }
            //$currentRow.append('<td></td>');
            //var $td = $('<td></td>');
            var $divtd = $('<div class="divtd"></div>');
            var $qrDiv = $('<div class="qr-container empty" id="empty">empty</div>');
            var $text = $('<strong class="text-sm empty">44</strong>');

            $divtd.append($qrDiv).append($text);
           // $td.append($divtd);
            $currentRow.append($divtd);

            cellCount++;
        }

        // Populate selected QR Codes
        for (qrIndex = 0; qrIndex < selectedQRCodes.length; qrIndex++) {
            if (cellCount % colsPerRow === 0) {
                $currentRow = $('<div class="row"></div>');
                $table.append($currentRow);
            }

            var qrData = selectedQRCodes[qrIndex];
            var uniqueId = 'qrcode_' + qrIndex + '_' + Date.now();
           // var $td = $('<td></td>');
            var $divtd = $('<div class="divtd col-md-3"></div>');
            var $qrDiv = $('<div class="qr-container" id="' + uniqueId + '"></div>');
            var $text = $('<strong class="text-sm">' + qrData.qr_code_ctnt.toLowerCase() + '</strong>');

            //$td.append($qrDiv).append($text);
            $divtd.append($qrDiv).append($text);
           // $td.append($divtd);
            $currentRow.append($divtd);

            // Generate QR
            setTimeout((function (id, content) {
                return function () {
                    new QRCode(document.getElementById(id), {
                        text: content,
                        width: 90,
                        height: 90,
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
        if (isNaN(startFrom) || startFrom < 1) {
            startFrom = 1;
        }
        renderQRTable(startFrom);
    }

    // Reset Filter
    function resetFilter() {
        $('#start_from').val(1);
        renderQRTable(1);
    }
</script>