<?php
final class HomeController extends LayoutController {
 /**
  * Seta css adicionais que estão posicionados em/htdocs/css/
  * no exemplo abaixo temos o arquivo /htdocs/css/componente.css
  * criado na pasta.
  */ 
  public $css = array('componente');

  /**
   * Seta javascripts adicionais a esta página. Estes estão criados em
   * /htdocs/js
   * no exemplo abaixo temos os arquivos /htdocs/js/lightbox.js
   * estão criados na pasta.
   */
  public $js = array('lightbox', 'utils');

  /**
   * Função que seta o título da página
   */
  public function setTitle() {
    return 'Medico';
  }

  protected function setContent() {
    return
      <x:frag>
        <div id="page-wrapper">
          {$this->getMsg()}
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Cenário Geral</h1>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-12">
              <m:panel 
                number="5" 
                description="Pedidos de Consultas" 
                href="#"
                icon="comments"/>
            </div>
            <div class="col-lg-4 col-md-12">
              <m:panel
                number="12"
                description="Consultas agendadas"
                icon="tasks"
                color="green"
                href="#"/>
            </div>
            <div class="col-lg-4 col-md-12">
              <m:panel
                number="5"
                description="Cancelamentos"
                icon="frown-o"
                color="red"
                href="#"/>
            </div>
          </div>
        </div>
      </x:frag>;
  }
  /**
   * Função usada para processar as requisições feitas a este controller
   */
  public function processRequest() {
    Gandalf::needLogin();
    $conn = dbconn();
    $q =
      <<<EOD
SELECT id, nome FROM usuario;
EOD;
    $res = $conn->executeQuery($q);
  }
}
