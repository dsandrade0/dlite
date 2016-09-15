<?php
final class CadastrarUsuarioController extends LayoutController {
  public $js = array('utils');
  private $sel;

  public function setContent() {
    return
      <x:frag>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Cadastro de usuários</h1>
            </div>
          </div>
          <m:form
            title="Cadastro de usuário"
            method="post"
            action="#"
            lblButton="Salvar">

            <m:input
              id="idName"
              type="text"
              name="nome"
              placeholder="Nome"
              icon="user"/>

            <m:input
              type="email"
              name="email"
              placeholder="Email"
              icon="at"/>

            {$this->sel}
          </m:form>
        </div>
      </x:frag>;
  }
  
  public function processRequest() {
    js_call("$('#idName').maiusculo();");
    $conn = dbconn();
    $q_sel =
      <<<EOD
SELECT id, nome FROM perfil;
EOD;
    $res_sel = $conn->executeQuery($q_sel);
    $this->sel = 
      <m:select name="perfil" placeholder="Selecione o perfil" icon="dashboard"/>;
    foreach($res_sel as $o) {
      $this->sel->appendChild(
        <option value={$o->id}> {$o->nome} </option>
      ); 
    } 
		if (is_post()) {
			$r = $this->getRequest();
			$email = $r->getString('email');
			$nome = $r->getString('nome');
			$senha = hash_string(5);
			$perfil = $r->getInt('perfil');

			if (!$email) {
				add_msg(ERROR, 'Digite o endereço de email.');
				return;
			}

			if (!$nome) {
				add_msg(ERROR, 'Digite o nome.');
				return;
			}

			if (!$perfil) {
				add_msg(ERROR, 'Escolha um perfil');
				return;
			}

			if(existe_email($email, $conn)) {
				add_msg(ERROR, 'Email já cadastrado!');
				return;
			}

			//TODO Fazer o bloqueio do usuario functionar
			$senhaCripto = md5($senha);
			$q =
				<<<EOD
INSERT INTO usuario(email, senha, nome, bloqueio, nivel, cliente) 
VALUES(?, ?, ?, ?, ?, ?);
EOD;
			$res = $conn->execute($q, array($email, $senhaCripto, $nome, 1, $perfil, Gandalf::getUsuario()->cliente));
			if (!$res) {
				add_msg(ERROR, 'Algo errado aconteceu! -> '.mysql_error());
				return;
			} else {
				$q00 =
					<<<EOD
SELECT perfilNome as nome FROM perfil WHERE perfilID = $perfil
EOD;
				$res2 = $conn->executeQuery($q00);

				$perfil_name = $res2->nome;

				/*
				 * 	A variavel $body abaixo é responsável pelo corpo da mensagem
				 * que será enviada por email.
				 */

				$body =
					<<<EOD
						<div>
							Olá {$nome},<br/>
							Você foi adicionado ao sistema de 
							finanças com o perfil de <b>{$perfil_name}</b>. <br/>
							Utilize login: {$email}
							Sua senha para o primeiro acesso é <a href=""><b>{$senha}</b></a><br/>
							Acesse <a href="www.sefincaninde.com.br" target="_blank"> CONSULTAS </a> 
							Lembre de alterar sua senha no primeiro acesso!
							<footer> 
								<h4 style="margin: 0;"> &copy; 2016 79-Team</h4>
							</footer>
						</div>
EOD;

				/**
				 * A variavel $to é o destinatário do email.
				 * Deve ser construido da seguinte maneira
				 * 				'nome:email'
				 * 				'Diego Andrade:didi.ufs@gmail.com'
				 * 				'Marcelo Wazaa:marcelowazaa$gmail.com'
				 *
				 * pode ser construido para colocar mais de um email
				 * Ex. 'Diego:didi.ufs@gmail.com,Marcelo:marcelowazaa@gmail.com'
				 */
				$to = "$nome:$email";

				/**
				 * A função send_mail, envia um email e tem como parametros
				 * os seguintes campos
				 *	1) Assunto
				 *	2) Corpo da mensagem
				 *	3) destinatario
				 */
				$sent = send_mail('Ativação da conta', $body, $to);
				if ($sent) {
					add_msg(SUCCESS, 
						'Usuario cadastrado com sucesso. Um email foi enviado para o usuário');
				}
				send_redirect('/listar/usuarios');
				return;
			}
		}
  }
}
