<?php
final class CadastrarPessoaController extends LayoutController {
  private $nome, $sobrenome, $cpf, $rg, $email, $dataNascimento,
    $endereco, $query;
	public function setContent() {
		return
      <x:frag>
        <div id="page-wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">Cadastrar pessoa</h1>
            </div>
          </div>
          <div class="row">
            <m:form title="Cadastro de Pessoa" lblButton="Cadastrar" id="idForm"
              method="post" validate={true}>
              <m:input icon="user" name="nome" 
                placeholder="Nome" value={$this->nome}/>
              <m:input icon="user" name="sobrenome" 
                placeholder="Sobrenome" value={$this->sobrenome}/>
              <m:input id="idCpf" icon="dashboard" name="cpf"
                placeholder="Cpf" value={$this->cpf}/>
              <m:input icon="certificate" name="rg"
                placeholder="Rg" value={$this->rg}/>
              <m:input icon="at" name="email" 
                placeholder="Email" value={$this->email}/>
              <m:input icon="calendar" id="idData" name="dataNascimento" 
                placeholder="Data de Nascimento" type="date" value={$this->dataNascimento}/>
              <m:selectQuery icon="male" name="sexo" 
                placeholder="Sexo" query={$this->query}/>

              <m:input icon="road" name="endereco"
                placeholder="Endereco" value={$this->endereco}/>
            </m:form>
          </div>
        </div>
		</x:frag>;
	}
	public function processRequest() {
    $this->query =
      <<<EOD
SELECT id, nome FROM sexo;
EOD;

    js_call("$('#idCpf').mask('000.000.000-00')");
    js_call("$('#idData').datepicker(
      {
        'language': 'pt-BR', 'autoclose': 'true',
        'dateFormat' : 'dd/mm/yy',
        'changeMonth' : true,
        'changeYear' : true,
        yearRange : '1930:2000',
        defaultDate : new Date(1960, 0, 01)
      })");
		if(is_post()) {
			$r= $this->getRequest();
			$this->nome = $r->getString('nome');
			$this->sobrenome = $r->getString('sobrenome');
			$this->cpf = $r->getString('cpf');
			$this->rg = $r->getString('rg');
			$this->email = $r->getString('email');
			$this->dataNascimento = $r->getString('dataNascimento');
			$this->sexo = $r->getString('sexo');
			$this->endereco = $r->getString('endereco');
	
		  if (!$this->nome | $this->sobrenome) {
        add_msg(ERROR, 'Um nome precisa ser digitado');
        return;
      }	

		  if (!$this->cpf) {
        add_msg(ERROR, 'Digite o cpf');
        return;
      }	

		  if (!$this->dataNascimento) {
        add_msg(ERROR, 'Digite a data de nascimento');
        return;
      }	
			
			$q =
			<<<EOD
Insert into paciente(nome, sobrenome, cpf, rg, email, dataNascimento, 
  endereco, sexo) values (
    '$this->nome', 
    '$this->sobrenome',
    '$this->cpf',
    '$this->rg',
    '$this->email',
    STR_TO_DATE('$this->dataNascimento', '%d/%m/%Y'),
    '$this->endereco', 1);
EOD;
			$conn = dbconn();
			$res = $conn->execute($q);
			if ($res) {
				add_msg(SUCCESS, 'Cadastrado com sucesso');		
        send_redirect('/cadastrar/paciente');
        return;
			} else {
				add_msg(ERROR, 'Erro ao cadastrar');
        return;
			}
		}
	}
}
