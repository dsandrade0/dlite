var Utils = {
  lastPage: function() {
    hIstory.back();
  },

  ip: function() {
    $.getJSON(
    'http://ipinfo.io', 
    function(data){
      return data.ip;
    });
  },

  back: function() {
    window.history.go(-1);
  }
}

$.fn.extend({maiusculo: function() {
	$(this).css("text-transform", "uppercase");
	$(this).blur(function() {
		this.value = this.value.toUpperCase();
	});
}
});

function exibaMensagem(titulo, mensagem, limpar, reload, link) {
	bootbox.dialog({
		message: mensagem == "" ? "Operação realizada com sucesso." : mensagem,
		title: titulo == "" ? "" : titulo,
		buttons: {
			success: {
				label: "OK",
				className: "btn-primary",
				callback: function() {
					if (limpar) {
						$('body form:first').each(function() {
							this.reset();
							$(':input:visible:enabled:first').focus();
						});
					}
					if (reload) {
						window.location.reload();
					}
					if (link != null && link !== undefined && link != "") {
						window.location.href = link;
					}
				}
			}
		}
	});
};

function exibaConfirmacao(
	titulo, mensagem, limpar, reload, fn, parametro, parametro2) {
	bootbox.dialog({
		message: mensagem == "" ? "Operação realizada com sucesso." : mensagem,
		title: titulo == "" ? "" : titulo,
		buttons: {
			success: {
				label: "SIM",
				className: "btn-danger",
				callback: function() {
					if (limpar) {
						$('body form:first').each(function() {
							this.reset();
							$(':input:visible:enabled:first').focus();
						});
					}
					if (reload) {
						window.location.reload();
					}
					if (fn !== undefined) {
						fn(parametro, parametro2);
					}
				}
			},
			danger: {
				label: "NÃO",
				className: "btn-default",
			}
		}
	});
}

function tabelaDinamica(el, colunas) {
	$(el).dataTable({
		"dom": '<"clear">lf<"pull-right"Tr>tip',
		'oLanguage': {
			'sLengthMenu': 'Mostrar _MENU_  por página',
			'sSearch': 'Buscar...'
		},	
		aoColumns: colunas,
	
		"oTableTools": {
			"sSwfPath": "/htdocs/plugins/datatables/TableTools/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
				{
					"sExtends": "pdf",
					"sButtonText": "PDF",
					"sTitle": "Extrato",
				},
				{
					"sExtends": "xls",
					"sButtonText": "Excel",
					"sTitle": "Extrato",
				},
				{
					"sExtends": "print",
					"sButtonText": "Imprimir",
					"sTitle": "Extrato",
				},
			],
		},
	});
}
