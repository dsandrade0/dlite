<?php
final class :m:perfil extends :x:element {

	public function render() {
		return
			<x:frag>
				<m:form action="#" method="post" title="Perfil">
					<m:input id="idNome"
						name="nome" 
						placeholder="Nome do perfil" icon="dashboard"/>
						<fieldset>
							<legend>Acesso do perfil</legend>
							<div data-row-span="2">
								<div data-field-span="1">
									<b>Cadastrar</b><br/>
									<label>
										<input 
											type="checkbox" 
											name="url[]" value="/cadastrar/usuario"/>
										Usuario &nbsp;
									</label>
									<label>
										<input 
											type="checkbox" 
											name="url[]" value="/cadastrar/pessoa"/>
										Pessoa &nbsp;
									</label>
								</div>

                <br/>

								<div data-field-span="1">
									<b>Gestão de usuários</b><br/>
									<label>
										<input 
											type="checkbox" 
											name="url[]" value="/cadastrar/perfil"/>
										Criar perfil &nbsp;
									</label>
									<label>
										<input 
											type="checkbox" 
											name="url[]" value="/listar/usuarios"/>
										Listar usuários &nbsp;
									</label>
									<label>
										<input 
											type="checkbox" 
											name="url[]" value="/gestor"/>
										Alterar gestor &nbsp;
									</label>
								</div>
							</div>
						</fieldset>
				</m:form>
			</x:frag>;
	}
}
