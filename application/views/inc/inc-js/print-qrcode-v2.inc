<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<style>
	@page {
		size: A4 portrait;
		margin: 0;
	}

	/* --- PRINT + SCREEN SHARED --- */
	.print-page {
		width: 210mm;
		height: 297mm;
		position: relative;
		box-sizing: border-box;
		background: #fff;
		page-break-after: always;
	}

	.print-page:last-child {
		page-break-after: auto;
	}

	.qr-table {
		position: absolute;

		width: 210mm;
		height: 297mm;
		border-collapse: collapse;
		table-layout: fixed;
	}

	.qr-table td {
		width: 39mm;
		height: 35mm;
		padding: 0;
		margin: 0;
		text-align: center;
		vertical-align: middle;
		box-sizing: border-box;
	}

	.qr-table td .label-content {
		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 2mm 0;
	}

	.qr-container {
		width: 24mm;
		height: 24mm;
	}

	.qr-container img {
		width: 24mm !important;
		height: 24mm !important;
	}

	.qr-text {
		font-size: 7pt;
		font-weight: bold;
		text-transform: uppercase;
		line-height: 1.1;
		margin-top: 1.5mm;
		max-width: 35mm;
		text-align: center;
		color: #000;
		word-wrap: break-word;
	}

	/* Empty cells */
	.qr-table td.empty {
		background: transparent;
	}

	/* --- SCREEN PREVIEW --- */
	@media screen {
		body {
			background: #f2f2f2;
		}

		.print-page {
			margin: 20px auto;
			box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
		}

		.qr-table td {
			border: 1px dashed #ccc;
		}

		.qr-table td.empty {
			background: #fafafa;
		}
	}

	/* --- PRINT MODE --- */
	@media print {
		.noprint,
		.main-header,
		.main-sidebar,
		.content-header,
		.main-footer {
			display: none !important;
		}

		body {
			margin: 0;
			padding: 0;
			-webkit-print-color-adjust: exact;
			print-color-adjust: exact;
		}

		.qr-table td {
			border: none !important;
		}
	}
</style>
<script>
	var allQRCodes = <?php echo json_encode($qrcode); ?>;

	$(document).ready(function () {
	  renderMultiplePages(1);
	  updateSelectedCount();
	});

	function getSelectedQRCodes() {
	  var selected = [];
	  $('.qr-checkbox:checked').each(function () {
	    selected.push(allQRCodes[$(this).data('index')]);
	  });
	  return selected;
	}

	function updateSelectedCount() {
	  $('#selected_count').text($('.qr-checkbox:checked').length);
	}

	function selectAll() {
	  $('.qr-checkbox').prop('checked', true);
	  updateSelectedCount();
	  applyFilter();
	}

	function deselectAll() {
	  $('.qr-checkbox').prop('checked', false);
	  updateSelectedCount();
	  applyFilter();
	}

	// Generate QR code image
	function generateQRCodeImage(text, callback) {
	  var tempDiv = document.createElement('div');
	  tempDiv.style.display = 'none';
	  document.body.appendChild(tempDiv);

	  var qrcode = new QRCode(tempDiv, {
	    text: text,
	    width: 256,
	    height: 256,
	    colorDark: "#000000",
	    colorLight: "#ffffff",
	    correctLevel: QRCode.CorrectLevel.H
	  });

	  setTimeout(function () {
	    var canvas = tempDiv.querySelector('canvas');
	    if (canvas) callback(canvas.toDataURL('image/png'));
	    document.body.removeChild(tempDiv);
	  }, 100);
	}

	function renderMultiplePages(startFrom) {
	  var selected = getSelectedQRCodes();
	  var $printArea = $('#print_area');
	  $printArea.empty();

	  if (selected.length === 0) {
	    $printArea.html('<div class="alert alert-warning noprint" style="margin:20px;"><i class="fa fa-warning"></i> No QR codes selected.</div>');
	    return;
	  }

	  const LABELS_PER_PAGE = 40, COLS = 5, ROWS = 8;
	  var skipCount = (parseInt(startFrom) || 1) - 1;
	  if (skipCount < 0) skipCount = 0;

	  var qrIndex = 0;
	  var totalLabelsNeeded = skipCount + selected.length;
	  var totalPages = Math.ceil(totalLabelsNeeded / LABELS_PER_PAGE);

	  for (var pageNum = 0; pageNum < totalPages; pageNum++) {
	    var $page = $('<div class="print-page"></div>');
	    var $table = $('<table class="qr-table"></table>');

	    for (var row = 0; row < ROWS; row++) {
	      var $tr = $('<tr></tr>');
	      for (var col = 0; col < COLS; col++) {
	        var cellPosition = (pageNum * LABELS_PER_PAGE) + (row * COLS) + col;

	        if (cellPosition < skipCount || qrIndex >= selected.length) {
	          $tr.append('<td class="empty"></td>');
	          continue;
	        }

	        var qrData = selected[qrIndex++];
	        var uniqueId = 'qr_img_' + pageNum + '_' + row + '_' + col;
	        var $td = $('<td><div class="label-content"><div class="qr-container"><img id="' + uniqueId + '"/></div><div class="qr-text">' + htmlEscape(qrData.qr_code_ctnt) + '</div></div></td>');
	        $tr.append($td);

	        (function (id, content) {
	          generateQRCodeImage(content, function (dataURL) {
	            $('#' + id).attr('src', dataURL);
	          });
	        })(uniqueId, qrData.qr_code_ctnt);
	      }
	      $table.append($tr);
	    }
	    $page.append($table);
	    $printArea.append($page);
	  }
	}

	function applyFilter() {
	  var startFrom = parseInt($('#start_from').val()) || 1;
	  if (startFrom < 1) startFrom = 1;
	  if (startFrom > 40) startFrom = 40;
	  $('#start_from').val(startFrom);
	  renderMultiplePages(startFrom);
	}

	function resetFilter() {
	  $('#start_from').val(1);
	  $('.qr-checkbox').prop('checked', true);
	  updateSelectedCount();
	  renderMultiplePages(1);
	}

	function htmlEscape(str) {
	  return String(str).replace(/[&<>"']/g, function (m) {
	    return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[m];
	  });
	}

	window.addEventListener('keydown', function (e) {
	  if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
	    e.preventDefault();
	    window.print();
	  }
	});
</script>
