<?php
/*
 * Funções que serão utilizadas em toda a aplicação
 */
//Constantes usadas nas mensagens
const ERROR = 1;
const SUCCESS = 2;
const WARNING = 3;
const INFO = 4;


/**
 * Função para retornar uma conexão com o banco de dados
 *
 */

function dbconn() {
  if (!isset($GLOBALS['connection'])) {
    return new Dbconn();
  }
  return $GLOBALS['connection'];
}

/**
 * Função que redireciona para outro control usando a mesma escrita do 
 * application_configuration.php
 *
 * Ex.: send_redirect('/home'); 
 **/
function send_redirect($page) {
  header('Location:'.$page);
  exit();
}

/**
 * Coloca uma mensagem para ser exibida na proxima WebController a ser executada
 * O HTML da mensagem éretornado pela função getMsg() definida na classe Controller
 *
 */
function add_msg($type, $msg) {
  $msgs = $_SESSION['msg_system'];
  $msgs[] = array($type, $msg);
  $_SESSION['msg_system'] = $msgs;
}

function is_post() {
  return ($_SERVER['REQUEST_METHOD'] == 'POST');
}

function is_get() {
  return ($_SERVER['REQUEST_METHOD'] == 'GET');
}

function is_put() {
  return ($_SERVER['REQUEST_METHOD'] == 'PUT');
}

function is_delete() {
  return ($_SERVER['REQUEST_METHOD'] == 'DELETE');
}

/*
 * Função usada para chamar uma função javascript
 */
function js_call(/***/) {
  $args = func_get_args();
  $case = count($args);
  switch ($case) {
  case 1:
    $GLOBALS['js_call'] .= 
      '<script type="text/javascript">'.$args[0].'</script>'; 
      return false;
  case 2:
    $GLOBALS['js_call'] .=
      '<script type="text/javascript">'.$args[0].'('.$args[1].')</script>';
      return false;
  }
}

//Função que devolve uma imagem
function get_image($name) {
  return '/htdocs/images/'.$name;
}

//Função que devolve um arquivo para download
function get_file($name) {
  return '/htdocs/downloads/'.$name;
}

function add_head($text) {
  $GLOBALS['head'] .= $text;
}

//Função de require dos arquivos da pasta e da suas subpastas
function require_path($path) {
  $root = scandir($path);
  foreach ($root as $value) {
    if ($value === '.' || $value === '..')
      continue;

    if (is_file("$path/$value")) {
      $info = pathinfo($value);
      if ($info['extension']== "php"){
        include_once("$path/$value");
      }  
    } else {
      require_path($value);
    }
  }
}

function nlog($msg, $erro = E_USER_NOTICE) {
  $msg = '['.gmdate('d-M-Y H:i::s e'). '] - '.$msg;
  trigger_error('>>>>>>>>> '.$msg, $erro);
}

function dlog($msg, $erro = E_USER_NOTICE) {
  trigger_error('>>>>>>>>> '.$msg, $erro);
}

function is_mobile_access() {
  $browser = $_SERVER['HTTP_USER_AGENT'];
  $iphone = strpos($browser, 'iPhone');
  $android = strpos($browser, 'Android');
  $palm = strpos($browser, 'webOS');
  $berry = strpos($browser, 'BlackBerry');
  $ipod = strpos($browser, 'iPod');

  if ($iphone || $android || $palm || $berry || $ipod) {
    return true;
  }

  return false;
}

function format_date($date, $separator = '-') {
  $a = explode($separator, $date);
  return date($a[2].'/'.$a[1].'/'.$a[0]);
}

function hash_string($length = 32) {
  $hash = substr(sha1(microtime()), 0, $length);
  return $hash;
}

function send_mail($subject, $body, $to, $cc = array(), $cco = array()) {
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 2;
	//$mail->setLanguage('br', '/../third/PHPMailer/language/phpmailer.lang-br.php');
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.zoho.com";  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = "contato@sefincaninde.com.br";                 // SMTP username
	$mail->Password = "c4n1nd3@";                           // SMTP password
	$mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;

	$mail->smtpConnect();
	$mail->setFrom("contato@sefincaninde.com.br", "Contato");
	
	$people = explode(',', $to);
	for ($i=0; $i < count($people); $i++) {
		$person = explode(':', $people[$i]);
		$mail->addAddress($person[1], $person[0]);
	}

	$mail->Subject = $subject;
	$mail->Body    = $body;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

	if($mail->send()) {
		return true;
	} else {
		return false;
	}
}

function existe_email($email, $conn) {
  $q =
    <<<EOD
SELECT 1 FROM usuario WHERE email = ?
EOD;
  $res = $conn->executeQuery($q, array($email));
  if ($res) {
    return true;
  } else {
    return false;
  }
}
