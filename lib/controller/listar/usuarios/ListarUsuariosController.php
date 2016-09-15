<?php
final class ListarUsuariosController extends LayoutController {
  public $js = array('utils', 'listarUsuario');
  private $tabela;

  public function setContent() {
    return
      <x:frag>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Listagem de usuários</h1>
            </div>
          </div>
          <div class="row">
            <div class="prepend-bot">
              <a href="/cadastrar/usuario" class="btn btn-success">
                <i class="fa fa-user"/>
                Novo Usuário
              </a>
              <a href="/cadastrar/perfil" class="btn btn-primary prepend-left">
                <i class="fa fa-gear"/>
                Criar Perfil
              </a>
              <a href="/gestor" class="btn btn-info pull-right">
                <i class="fa fa-eye"/>
                Alterar Gestor
              </a>
            </div>
          </div>
          <div class="row prepend-top">
            <div class="panel panel-default prepend-top">
              <div class="panel-heading">
                Usuarios
              </div>
              <div class="panel-body">
                {$this->tabela}	
              </div>
            </div>
          </div>
        </div>
      </x:frag>;
  }
  
  public function processRequest() {
    Gandalf::check();
    $this->tabela = <table class="table table-hover table-striped"/>;
    $this->tabela->appendChild(
      <tr class="center">
        <th> NOME </th>
        <th> PERFIL </th>
        <th> EDITAR </th>
        <th> EXCLUIR </th>
      </tr>
    );
    $q =
      <<<EOD
SELECT u.nome as nome, u.id as id, p.nome as perfil
  FROM usuario u, perfil p
WHERE u.nivel = p.id
  AND u.bloqueio <> 2;
EOD;

   $conn = dbconn();
   $res_q = $conn->executeQuery($q, array());
    if ($res_q) {
      foreach($res_q as $o) {
        $cor = ($o->perfil == 'ADMINISTRADOR') ? 'success': 'primary';
        $this->tabela->appendChild(
          <tr>
            <td> <b>{$o->nome}</b> </td>
            <td> <span class={"label label-".$cor}>{$o->perfil} </span> </td>
            <td>
              <a href={"/alterar/usuario/admin?id=".$o->id} class="btn btn-primary">
                <i class="fa fa-pencil"/>
              </a>
            </td>
            <td>
              <a href={"javascript:excluir(".$o->id.")"}  class="btn btn-danger">
                <i class="fa fa-remove"/>
              </a>
            </td>
          </tr>
        );
      }
    }
  }
}
