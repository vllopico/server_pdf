$(function() {
	var table = $('#tabla_pdfs').DataTable({
		"ajax": {
			"url": "pdf_files.php"
		},
		"columns": [
			{"data": "id"},
			{"data": "referencia"},
			{"data": null}
		],
		"iDisplayLength":10,
		"fnCreatedRow": function(nRow,aData,iDataIndex) {
			var fichero = aData.fichero;
			var link = "<a target='_blank' href='pdf_server.php?fichero="+fichero+"'>PDF</a>";
			$('td:eq(2)',nRow).html(link);
		},
	});
});
