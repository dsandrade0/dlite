<?php
class LayoutController extends WebController {
  
  protected function setTitle() {
    return 'Consulta';
  }

  protected function composeBody() {
    $html = 
      <x:frag>
        <body>
          <div id="wrapper">
            {$this->getMsg()}
            {$this->composeMenu()}
            {$this->setContent()}
          </div>
        </body>
      </x:frag>;
    return $html;
  }

  protected function setContent() {
  }

  protected function composeMenu() {
    return
      <m:menu/>;
  }

  protected function composeTop() {
    return
      <x:frag>
        <m:top>
        </m:top>
      </x:frag>;
  }

  protected function composeFooter() {
    return
      <x:frag>
  <!--      <footer class="footer hidden-phone">
          <div class="container">
            <p> RODAPE - {date('Y')}</p>
            <p>Site desenvolvido pela próprio rodape.</p>
            <p>Telefone: (xx)xxxx-xxxx</p>
          </div>
        </footer> -->

       <!-- visão mobile
        <footer class="footer visible-phone">
          <div class="container">
            <p>RODAPE - {date('Y')}</p>
          </div>
          </footer> -->
        </x:frag>; 
  }
}
