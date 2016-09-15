<?php
final class ListarPacientesController extends LayoutController {
	private $tabela;

	public function setContent() {
		return
		<x:frag>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Listagem de Pacientes</h1>
					</div>
				</div>
				<div class="row">
					<div class="prepend-bot">
						<a href="/cadastrar/paciente" class="btn btn-success">
							<i class="fa fa-user"/>
							Novo Paciente
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
		$q = 
		<<<EOD
SELECT id, nome FROM paciente;
EOD;
		
		$conn = dbconn();
		$res = $conn->executeQuery($q);
		
		
		$this->tabela->appendChild(
				<tr class="center">
				<th> Nome </th>
				<th> Pagamento </th>
				<th> Editar </th>
				<th> Excluir </th>
				</tr>
		);
		
		for($i=0; $i< sizeof($res); $i++) {
			$this->tabela->appendChild(
				<tr>
					<td>{$res[$i]->nome}</td>
				</tr>			
			);
		}
	}
}