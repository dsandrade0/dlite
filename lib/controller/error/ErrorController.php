<?php
final class ErrorController extends WebController {
  public $js = array('utils');

  public function composeBody() {
    header('Status: 404', false, 404);
    return
      <x:frag>
        <h1>Erro 404 - Página não encontrada</h1>
        <a href="home" class="btn btn-default btn-xl sr-button prepend-top">
          Voltar
        </a>
      </x:frag>;
  }

  public function setContent() {
  }
  public function processRequest() {
  }

}
