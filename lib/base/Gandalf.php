<?php
final class Gandalf {
	private $usuario;

	public function __construct() {
		$this->setUsuario($_SESSION['usuario']);	
	}

	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	public static function isLogged() {
		if ($_SESSION['usuario'] == null) {
			return false;
		} else {
			return true;
		}
	}

	public static function needLogin() {
		if (!self::isLogged()) {
			add_msg(ERROR, 'Essa ação necessita de login!');
			send_redirect('/login');
		}
	}

	public static function check() {
		if (!isset($_SESSION['usuario'])) {
			add_msg(ERROR, 'Sessão expirada');
			send_redirect('/logout');
		}
		$uri = $_SERVER['REQUEST_URI'];
		$uri = explode('?', $uri)[0];
		$urls = self::getUrlPerfil();
		if (!in_array($uri, $urls)) {
			add_msg(ERROR, 'Você não possui acesso a essa transação');
			send_redirect('/home');
    }
	}

	public static function isAdmin() {
		if ($_SESSION['usuario']->nivel == 1) {
			return true;
		} else {
			return false;
		}
	}

	public static function onlyAdmin() {
		if (self::check()) {
			if (self::isAdmin()) {
			} else {
				add_msg(ERROR, 'Você não possui acesso para essa ação');
				send_redirect('/home');
			}
		}
	}

	public static function getUsuario() {
		return $_SESSION['usuario'];
	}

	private static function getUrlPerfil() {
		$perfil = self::getUsuario()->nivel;
		$connection = dbconn();
		$q = 
			<<<EOD
SELECT p.url as url FROM perfilUrl p WHERE perfil = ?
EOD;
		$res = $connection->executeQuery($q, array($perfil));
		$urls = array();
    if ($res) {
      foreach($res as $o) {
        $urls[] = $o->url;
      }
      return $urls;
    }  
	}
}
