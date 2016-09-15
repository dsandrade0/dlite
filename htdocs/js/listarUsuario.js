function exclusao(id) {
	$.post(
		'/excluir/usuario',
	 	{'id': id},
	 	function(data, status) {
      console.log(status);
		}
	);
}

function excluir(id) {
	exibaConfirmacao('Excluir', 'Deseja realmente excluir o usuário?', false, true, exclusao, id);
}
