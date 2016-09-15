<?php
final class LoginController extends WebController {
	
	public function composeBody() {
		return 
		<x:frag>
				<m:form title="Login" lblButton="Entrar" method="post" action="#">		
					<m:input type="email" icon="user" name="email" placeholder="login"/>		
					<m:input icon="key" name="senha" type="password" placeholder="senha"/>
				</m:form>
		</x:frag>;
	}
	public function processRequest() {
		if(is_post()) {
      $r= $this->getRequest();
      $email = $r->getString('email');
      $senha = $r->getString('senha');

      if(!$email){
        add_msg(ERROR,'Informe o login');
        return;
      }

      if(!$senha){
        add_msg(ERROR,'Informe a senha');
        return;
      }
      $senha = md5($senha);

      $q =
        <<<EOD
SELECT u.id, u.email, c.status, u.nome, u.nivel, u.bloqueio, u.cliente, u.gestor
  FROM cliente c, usuario u
WHERE u.cliente = c.id
  AND u.email = ?
  AND u.senha = ?
  AND u.bloqueio <> 2
  AND c.status = 1
;
EOD;
      $conn = dbconn();
      $res = $conn->executeQuery($q, array($email, $senha));
      if ($res) {
        if (sizeof($res) == 1) {
          $_SESSION['usuario'] = $res[0]; 
          if ($res[0]->bloqueio == 1) {
            send_redirect('/alterarSenha');
          }
          send_redirect('/home');
        } else {
          add_msg(ERROR, 'Usuário duplicado, contate o administrador.');
        }
      } else {
        add_msg(ERROR, ' Entre em contato com o administrador.');
      }
		}
	}
}
