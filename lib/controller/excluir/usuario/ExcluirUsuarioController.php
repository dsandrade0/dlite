<?php
final class ExcluirUsuarioController extends Controller {

	public function processRequest() {
		$id = $this->getRequest()->getInt('id');	

		if (is_post()) {
			$q =
				<<<EOD
UPDATE usuario SET bloqueio = 2 WHERE id = ?;
EOD;
			$res = dbconn()->execute($q, array($id));
			if ($res) {
				add_msg(SUCCESS, 'Usuário excluído com sucesso');
				send_redirect('/listar/usuarios');
			} else {
				add_msg(ERROR, 'Erro ao excluir usuário');
				send_redirect('/listar/usuarios');
			}
		}
	}
}
