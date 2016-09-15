<?php
final class AlterarUsuarioAdminController extends LayoutController {
  public $js = array('utils');
	private $nome;
	private $email;
	private $perfil;
	private $id;

	public function setContent() {
		return
			<x:frag>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Alterar usuário</h1>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <m:form action="#" 
                title="" method="post" 
                lblButton="Alterar" 
                title="Alterar usuário">
                <m:input name="nome" value={$this->nome} id="idNome" icon="user"/>
                <m:input name="email" value={$this->email} id="idEmail" icon="at"/>
                {$this->perfil}
                <input type="hidden" name="id" value={$this->id}/>
              </m:form>
            </div>
          </div>
        </div>
			</x:frag>;
	}

	public function processRequest() {
		Gandalf::check();
    js_call("$('#idEmail').attr('disabled', 'true')");
		js_call("$('#idNome').maiusculo();");
		$r = $this->getRequest();
		$id = $r->getInt('id');
		$this->id = $id;

		$q =
			<<<EOD
SELECT 
	u.nome,
	u.id,
	u.email,
	u.nivel
FROM usuario u, perfil p
WHERE u.id = ?
	AND u.nivel = p.id;
EOD;

		$conn = dbconn();
		$res = $conn->executeQuery($q, array($id));
    $this->perfil = <m:select id="" class="form-control" name="perfil"
      icon="dashboard"/>;
		if ($res) {
			$o = $res[0];

			$q_perfil =
				<<<EOD
SELECT id, nome FROM perfil;
EOD;

			$res_perfil = $conn->executeQuery($q_perfil);
			foreach ($res_perfil as $p) {
				$selected = 'false';
				if ($p->id == $o->nivel) {
					$selected = 'true';
				}
				$this->perfil->appendChild(
					<option value={$p->id} selected={$selected}> {$p->nome}</option>
				);
			}
			$this->nome = $o->nome;
			$this->email = $o->email;
		}

		if (is_post()) {
			$nome = $r->getString('nome');
			$email = $r->getString('email');
			$perfil = $r->getInt('perfil');
			$this->id = $r->getInt('id');

			if (!$nome) {
				add_msg(ERROR, 'Um nome precisa ser preenchido');
				return;
			}

			if (!$email) {
				add_msg(ERROR, 'Um email precisa ser preenchido');
				return;
			}

			if (!$perfil) {
				add_msg(ERROR, 'Um perfil precisa ser escolhido');
				return;
			}

			$q_update =
				<<<EOD
UPDATE usuario 
	SET nome = ?, email = ?, nivel = ? 
WHERE id = ?;
EOD;
			$res_update = $conn->execute($q_update, array($nome, $email, $perfil, $this->id));
			if ($res_update) {
				add_msg(SUCCESS, 'Usuário alterado com sucesso');
				send_redirect('/listar/usuarios');
			}
		}
	}
}
