<?php
final class :t:section extends :x:element {
  attribute
    string sectionClass, string id;
  public function render() {
    $this->sectionClass = $this->getAttribute('sectionClass');
    $this->id = $this->getAttribute('id');
    return
      <x:frag>
        <section class={$this->sectionClass} id={$this->id}>
          <div class="container">
            <div class="row">
              {$this->getChildren()}
            </div>
          </div>
        </section>
      </x:frag>;
  }
}
