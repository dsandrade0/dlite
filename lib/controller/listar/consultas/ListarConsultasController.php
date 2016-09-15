<?php
final class ListarConsultasController extends LayoutController {
	private $tabela;

	public function setContent() {
		return
      <x:frag>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header">Listagem de Consultas</h1>
            </div>
          </div>
          <div class="row">
            <div class="prepend-bot">
              <a href="/cadastrar/consulta" class="btn btn-success">
                <i class="fa fa-user"/>
                Nova Consulta
              </a>
            </div>
          </div>
          <div class="row prepend-top">
            <div class="panel panel-default prepend-top">
              <div class="panel-heading">
              Pacientes
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
		$this->tabela = <table class="table table-hover table-striped"/>;
		$this->tabela->appendChild(
				<tr class="center">
				<th> Nome </th>
				<th> Data </th>
				<th> Editar </th>
				<th> Excluir </th>
				</tr>
		);
	}
}
