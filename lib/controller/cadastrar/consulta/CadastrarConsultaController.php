<?php
final class CadastrarConsultaCOntroller extends LayoutController{
	public function setContent() {
		return
		<x:frag>
			<m:form title="Agendar Consulta" lblButton="Cadastrar" method="post">
			<m:input icon="user" name="paciente" placeholder="nome do paciente"/>
			<m:input icon="user" name="medico" placeholder="nome do medico"/>
			<m:input icon="user" name="dataConsulta" placeholder="Data da Consulta" type = "date"/>
			</m:form>
		</x:frag>;
	}
	public function processRequest() {
		if(is_post()) {
			$r= $this->getRequest();
			$paciente = $r->getString('paciente');
			$medico = $r->getString('medico');
			$dataConsulta = $r->getString('dataConsulta');
	
			// 		print_r($nome);
		}	
	}
		
		private function verificaDiaDiposnivel(){
			
			$q =
			<<<EOD
		Select * from consulta where data = $dataConsulta and idMedico = $medico ;
EOD;
			$conn = dbconn();
			$res = $conn->execute($q);
			if($res){		
				$q =
				<<<EOD
		Insert into consulta(idPaciente,idMedico, data) values 
		($idPaciente, $medico date($dataConsulta))
EOD;
			}
		}
}