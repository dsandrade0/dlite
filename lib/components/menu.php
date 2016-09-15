<?php

final class :m:top extends :x:element {

  public function render() {
    return
      <x:frag>
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
              <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> New Comment
                        <span class="pull-right text-muted small">4 minutes ago</span>
                    </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                  <a href="#">
                      <div>
                          <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                          <span class="pull-right text-muted small">12 minutes ago</span>
                      </div>
                  </a>
              </li>
              <li class="divider"></li>
              <li>
                  <a href="#">
                      <div>
                          <i class="fa fa-envelope fa-fw"></i> Message Sent
                          <span class="pull-right text-muted small">4 minutes ago</span>
                      </div>
                  </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-tasks fa-fw"></i> New Task
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a href="#">
                  <div>
                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                    <span class="pull-right text-muted small">4 minutes ago</span>
                  </div>
                </a>
              </li>
              <li class="divider"></li>
              <li>
                <a class="text-center" href="#">
                  <strong>See All Alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-use">
            <li>
              <a href={"/alterar/usuario?id=".Gandalf::getUsuario()->id}>
                <i class="fa fa-user fa-fw"></i> 
                {Gandalf::getUsuario()->nome}
              </a>
            </li>
            <li>
              <a href="/alterar/usuario/senha">
                <i class="fa fa-gear fa-fw"/> 
                Alterar Senha
              </a>
            </li>
            <li class="divider"></li>
            <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </x:frag>;
  }
}

final class :m:menu extends :x:element {

  public function render() {
    return
      <x:frag>
        <nav class="navbar navbar-default navbar-static-top" data-role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/home">Consulta Legal</a>
          </div>
          <m:top/>

          <div class="navbar-default sidebar" data-data-role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
                <li>
                  <a href="/home">
                    <i class="fa fa-dashboard fa-fw"></i> 
                    Cenário Geral
                  </a>
                </li>
                <li>
                  <a href="/listar/usuarios">
                    <i class="fa fa-users fa-fw"></i> 
                    Listar Usuários
                  </a>
                </li>
                <li>
                	<a href="/listar/pacientes">
               		 <i class="fa fa-users fa-fw"></i>
                		Listar Pacientes
                	</a>
                </li>
                <li>
                	<a href="/listar/consultas">
                		<i class="fa fa-users fa-fw"></i>
               			 Listar Consultas
                	</a>
                </li>
                <li>
                	<a href="/cadastrar/pessoa">
                		<i class="fa fa-user"></i>
               			 Cadastrar Pessoa
                	</a>
                </li>
                <li>
                	<a href="/cadastrar/consulta">
                		<i class="fa fa-calendar"></i>
                			Cadastrar Consultas
                	</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </x:frag>;
  }
}

