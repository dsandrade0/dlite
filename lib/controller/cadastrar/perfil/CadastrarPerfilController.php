<?php
final class CadastrarPerfilController extends LayoutController {
	public $js = array('utils');
	private $perfis;

	public function setContent() {
		return
			<x:frag>
				<div class="page-wrapper">
					<h1> Criar Perfil </h1>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<m:perfil/>
						<div class="col-xs-6 col-xs-offset-3">
							<m:accordion head={"Perfis Cadastrados"}>
								{$this->perfis}	
							</m:accordion>
						</div>
					</div>
				</div>
			</x:frag>;
	}
	public function processRequest() {
		Gandalf::check();
		js_call("$('#idNome').maiusculo()");
		$conn = dbconn();

		$q_perfis =
			<<<EOD
SELECT 
	nome, 
	id
FROM perfil 
ORDER BY nome ASC;
EOD;
		$res_perfis = $conn->executeQuery($q_perfis);
		$this->perfis = <ul class="list-unstyled col-xs-12"/>;

		foreach($res_perfis as $o) {
			$link;
				/*<a onclick={"excluir(".$o->id.")"}
					class="btn btn-danger btn-xs prepend-left" title="Remover">
					<i class="fa fa-trash"/>
          </a>;*/

			$this->perfis->appendChild(
				<li>
					<h5>
						{$o->nome}
						<span>
							{$link}
						</span>
					</h5>
				</li>
			);
		}

		if (is_post()) {
			$r = $this->getRequest();
			$urls = $r->getArray('url');
			$nome_perfil = $r->getString('nome');

			if (!$nome_perfil) {
				add_msg(ERROR, 'Digite um nome para o perfil');
				return;
			}

			if (count($urls) == 0) {
				add_msg(ERROR, 'Escolha alguma permissão para o perfil');
				return;
			}

			$q_sel =
				<<<EOD
SELECT 1 AS ok FROM perfil WHERE nome = ?;
EOD;
			$res_sel = $conn->executeQuery($q_sel, array($nome_perfil));

			$q_insert =
				<<<EOD
INSERT INTO perfil(nome) VALUES(?);
EOD;
			$conn->beginTransaction();
			$res_insert = $conn->execute($q_insert, array($nome_perfil));

			if ($res_insert) {
				$q_sel =
					<<<EOD
SELECT id FROM perfil WHERE nome = ?;
EOD;
				$res_sel = $conn->executeQuery($q_sel, array($nome_perfil));
        print_r($urls);
				$id_perfil = $res_sel[0]->id;

				for($i=0; $i<count($urls); $i++) {
					$q_final =
						<<<EOD
INSERT INTO perfilUrl(perfil, url) VALUES(?, ?)
EOD;
					$res_final = $conn->execute($q_final, array($id_perfil, $urls[$i]));
					if (!$res_final) {
						add_msg(ERROR, 'Alguma coisa aconteceu. Procure o administrador.');
						$conn->rollbackTransaction();
						return;
					}
				}
				$conn->commitTransaction();
				add_msg(SUCCESS, 'Perfil cadastrado com sucesso');
				send_redirect('/listar/usuarios');
			}
		}
	}
}
