<?php
class :m:input extends :x:element {

	attribute
		string name, string type, string placeholder, string icon,
    string class, string id, string value, string tam = 12,
    bool required = false, string validation = "Campo obrigatório",
    bool disabled;
	public function render() {
		$this->name = $this->getAttribute('name');
		$this->tam = $this->getAttribute('tam');
	 	$this->type = $this->getAttribute('type');
	 	$this->icon = $this->getAttribute('icon');
	 	$this->class = $this->getAttribute('class');
	 	$this->id = $this->getAttribute('id');
	 	$this->placeholder = $this->getAttribute('placeholder');
	 	$this->value = $this->getAttribute('value');
	 	$this->required = $this->getAttribute('required');
	 	$this->validation = $this->getAttribute('validation');
	 	$this->disabled = $this->getAttribute('disabled');

		if (!$this->type) {
			$this->type = 'text';
		}

    if (!$this->id) {
      $this->id = hash_string(5);
    }

    $require = <x:frag/>;
    if ($this->required) {
      $require->appendChild( 
        <label id="cname-error" class="error" for={$this->id}>
          {$this->validation}
        </label>
      );
    }

		return
			<x:frag>
				<div class="form-group">
					<div class={"col-xs-".$this->tam}>
						<div class="input-group">							
							<span class="input-group-addon">
								<i class={"fa fa-".$this->icon}></i>
							</span>
							<input type={$this->type} id={$this->id}
								name={$this->name}
								class={"form-control ".$this->class}
                required={$this->required}
								placeholder={$this->placeholder} value={$this->value}/>
                {$require}
						</div>
					</div>
					{$this->getChildren()}
				</div>
			</x:frag>;
	}
}

class :m:select extends :x:element {
	
	attribute
		string name, string type, string placeholder, string icon,
		string class, string id, string classOut, string idParent;	
	public function render() {
		$this->name = $this->getAttribute('name');
	 	$this->type = $this->getAttribute('type');
	 	$this->icon = $this->getAttribute('icon');
	 	$this->class = $this->getAttribute('class');
	 	$this->id = $this->getAttribute('id');
	 	$this->placeholder = $this->getAttribute('placeholder');
	 	$this->classOut = $this->getAttribute('classOut');
	 	$this->idParent = $this->getAttribute('idParent');

		return
			<x:frag>
				<div class={"form-group ".$this->classOut} id={$this->idParent}>
					<div class="col-xs-12">
						<div class="input-group">							
							<span class="input-group-addon">
								<i class={"fa fa-".$this->icon}></i>
							</span>
							<select name={$this->name} 
								class={"form-control ".$this->class} id={$this->id}>
								<option> {$this->placeholder} </option>
								{$this->getChildren()}
							</select>
						</div>
					</div>
				</div>
			</x:frag>;
	}
}

class :m:selectQuery extends :m:select {

  attribute
    string query, var params;

  public function render() {
		$this->name = $this->getAttribute('name');
	 	$this->type = $this->getAttribute('type');
	 	$this->icon = $this->getAttribute('icon');
	 	$this->class = $this->getAttribute('class');
	 	$this->id = $this->getAttribute('id');
	 	$this->placeholder = $this->getAttribute('placeholder');
	 	$this->classOut = $this->getAttribute('classOut');
	 	$this->idParent = $this->getAttribute('idParent');
	 	$this->query = $this->getAttribute('query');
	 	$this->params = $this->getAttribute('params');
    $select =
      <select name={$this->name} 
        class={"form-control ".$this->class} id={$this->id}/>;

    if ($this->query) {
      $conn = dbconn();
      $res = $conn->executeQuery($this->query, $this->params);

      foreach($res as $o) {
        $select->appendChild(
          <option value={$o->id}> {$o->nome} </option>
        );
      }
    }

    return
			<x:frag>
				<div class={"form-group ".$this->classOut} id={$this->idParent}>
					<div class="col-xs-12">
						<div class="input-group">							
							<span class="input-group-addon">
								<i class={"fa fa-".$this->icon}></i>
							</span>
              {$select}
						</div>
					</div>
				</div>
			</x:frag>;
  
  }
}
