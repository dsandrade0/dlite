<?php
final class AlterarSenhaController extends LayoutController {

  public function setContent() {
    return
      <x:frag>
        <div id="page-wrapper">
          {$this->getMsg()}
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Alterar Senha</h1>
            </div>
          </div>
          <div class="row">
            <m:form method="post" title="Alterar senha" lblButton="Alterar">
              <m:input type="password" icon="key"
                name="atual" placeholder="Senha Atual"/>
              <m:input type="password" icon="key"
                name="nova" placeholder="Nova Senha"/>
              <m:input type="password" icon="key"
                name="renova" placeholder="Repita a nova senha"/>
            </m:form>
          </div>
        </div>
      </x:frag>;
  }
  
  public function processRequest() {
    Gandalf::needLogin();
    if (is_post()) {
      $r = $this->getRequest();
      $atual = $r->getString('atual');
      $nova = $r->getString('nova');
      $renova = $r->getString('renova');
      $user = Gandalf::getUsuario();

      if (!$atual) {
        add_msg(ERROR, 'Digite a senha atual');
        return;
      }

      if (!$nova || !$renova) {
        add_msg(ERROR, 'Digite a nova senha');
        return;
      }

      if ($nova != $renova) {
        add_msg(ERROR, 'As novas senhas não conferem');
        return;
      }

      $atual = md5($atual);
      $q =
        <<<EOD
SELECT 1 FROM usuario WHERE id = ? AND senha = ?;
EOD;
      $conn = dbconn();
      $res = $conn->executeQuery($q, array($user->id, $atual));
      if ($res) {
        $q_up =
          <<<EOD
UPDATE usuario SET senha = ? WHERE id = ?;
EOD;
        $res2 = $conn->execute($q_up, array(md5($nova), $user->id));
        if ($res2) {
          add_msg(SUCCESS, 'Senha alterada com sucesso');
          return;
        }
      } else {
        add_msg(ERROR, 'A senha atual não confere');
        return;
      }
    }
  }
}
