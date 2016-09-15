<?php
class :m:form extends :x:element {
	attribute
		string method, string class="form-horizontal", string action="#", 
		string id, string lblButton, string title, string idBtn, string classBtn,
		string tamanho = "col-lg-6 col-lg-offset-3", bool validate = false ;

	public function render() {
		$this->method = $this->getAttribute('method');
		$this->class = $this->getAttribute('class');
		$this->action = $this->getAttribute('action');
		$this->id = $this->getAttribute('id');
		$this->lblButton = $this->getAttribute('lblButton');
		$this->title = $this->getAttribute('title');
		$this->idBtn = $this->getAttribute('idBtn');
		$this->classBtn = $this->getAttribute('classBtn');
		$this->tamanho = $this->getAttribute('tamanho');
		$this->validate = $this->getAttribute('validate');

		if (!$this->lblButton) {
			$this->lblButton = 'Cadastrar';
		}

    if (!$this->id) {
      $this->id = hash_string(5);
    }
		
    $html =
			<x:frag>
				<div class="row">
					<div class={$this->tamanho}>
						<div class="panel panel-default">
							<div class="panel-heading">
								{$this->title}
							</div>
							<div class="panel-body">
								<form action={$this->action} id={$this->id}
						 			method={$this->method} class={$this->class}>

									{$this->getChildren()}

									<div class="panel-footer">
										<div class="clearfix">
											<input 
										 		id={$this->idBtn}	
												type="submit" 
												class={"btn btn-primary pull-right ".$this->classBtn} 
												value={$this->lblButton}/>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</x:frag>;
      
    if ($this->validate) {
      $js = "$('#".$this->id."').validate({'localization': 'pt_BR'})";
      js_call($js);
    }
		return $html;
	}
}
