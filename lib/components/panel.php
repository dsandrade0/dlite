<?php
final class :m:panel extends :x:element {
  attribute
    string class, string number, string description, string detalhes, 
    string href="#", string icon, string color="primary";

  public function render() {
    $this->class = $this->getAttribute('class');
    $this->number = $this->getAttribute('number');
    $this->description = $this->getAttribute('description');
    $this->href = $this->getAttribute('href');
    $this->icon = $this->getAttribute('icon');
    $this->color = $this->getAttribute('color');
    return 
      <x:frag>
        <div class={"panel panel-$this->color"}>
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class={"fa fa-$this->icon fa-5x"}></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge">{$this->number}</div>
                      <div>{$this->description}</div>
                  </div>
              </div>
          </div>
          <a href={$this->href}>
            <div class="panel-footer">
              <span class="pull-left">Ver Detalhes</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </x:frag>;
  }
}
