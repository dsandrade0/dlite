<?php
class :m:accordion extends :x:element {
	attribute
		string img, string parent, string href, var head,
		var body, string class, var complemento;

	public function render() {
		$href = hash_string(4);
		$this->img = $this->getAttribute('img');
		$this->parent = $this->getAttribute('parent');
		$this->head = $this->getAttribute('head');
		$this->body = $this->getAttribute('body');
		$this->class = $this->getAttribute('class');
		$this->complemento = $this->getAttribute('complemento');
		return
			<x:frag>
				<div class={"panel panel-default ".$this->class}>
					<a data-toggle="collapse" data-parent={"#".$this->parent} 
						href={"#".$href}>
						<div class="panel-heading">
							<x:frag>
								{$this->head}
							</x:frag>
							{$this->complemento}
						</div>
					</a>
					<div id={$href} 
						class="collapse" 
						aria-expanded="false" 
						style="height: 0px;">
						<div class="panel-body">
							{$this->getChildren()}
						</div>
					</div>
				</div>
			</x:frag>;
	}
}
