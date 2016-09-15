<?php
final class LogoutController extends Controller {
	
	public function processRequest() {
		unset($_SESSION['usuario']);
		send_redirect('/login');
	}
}
