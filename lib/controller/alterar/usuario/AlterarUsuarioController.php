<?php
final class AlterarUsuarioController extends LayoutController {
  public $js = array('utils');
	private $nome;
	private $email;

	public function setContent() {
		return
			<x:frag>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Alterar Usuário</h1>
            </div>
          </div>
          <div class="row">
            <m:form action="#" title="" method="post" lblButton="Alterar" title="Alterar usuário">
              <m:input name="nome" value={$this->nome} id="idNome" icon="user"/>
              <m:input name="email" value={$this->email} 
                class="disabled" id="idEmail" icon="at"/>
            </m:form>
          </div>
        </div>
			</x:frag>;
	}

	public function processRequest() {
		Gandalf::needLogin();
    js_call("$('#idEmail').attr('disabled', 'true')");
		js_call("$('#idNome').maiusculo();");
		$r = $this->getRequest();
		$this->nome = Gandalf::getUsuario()->nome;
		$this->email = Gandalf::getUsuario()->email;

		if (is_post()) {
			$nome = $r->getString('nome');
			$email = $r->getString('email');
			$usuario_id = Gandalf::getUsuario()->id;

			if ($nome == $this->nome) {
				add_msg(WARNING, 'Nada foi alterado');
				return;
			}
			$q =
				<<<EOD
UPDATE usuario
	SET nome = ?, 
WHERE id = ?;
EOD;
			$conn = dbconn();
			$res = $conn->execute($q, array($nome, $usuario_id));
			if ($res) {
				$q_sel =
					<<<EOD
SELECT 
	id, 
	nome, 
	email,
	bloqueio,
	nivel
FROM usuario 
WHERE id = ?;
EOD;
				$res_sel = $conn->executeQuery($q_sel, array($usuario_id));
				if ($res_sel) {
					$o = $res_sel[0];
					$_SESSION['usuario'] = $o;
					add_msg(SUCCESS, 'Usuário alterado com sucesso');
					$this->nome = $nome;
					$this->email = $email;
				} else {
					add_msg(ERROR, 'Erro ao alterar o usuário.');
				}
			}
		}
	}
}
