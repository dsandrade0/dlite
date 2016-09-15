<?php
$map = array(
  '/error' => 'ErrorController',
  '/home' => 'HomeController', 
  '/contato' => 'ContatoController',
  '/listar/usuarios' => 'ListarUsuariosController',
	'/listar/pacientes' => 'ListarPacientesController',
	'/listar/consultas' => 'ListarConsultasController',
  '/cadastrar/usuario' => 'CadastrarUsuarioController',
	'/cadastrar/pessoa' => 'CadastrarPessoaController',
	'/cadastrar/consulta' => 'CadastrarConsultaController',
	'/cadastrar/perfil' => 'CadastrarPerfilController',
	'/login' => 'LoginController',
	'/logout' => 'LogoutController',
	'/excluir/usuario' => 'ExcluirUsuarioController',
	'/alterar/usuario' => 'AlterarUsuarioController',
	'/alterar/usuario/senha' => 'AlterarSenhaController',
	'/alterar/usuario/admin' => 'AlterarUsuarioAdminController',

  '/api' => 'ApiPessoaController',
);
