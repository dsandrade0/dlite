#!/usr/bin/php -q
<?php
include_once "__init__.php";
include_once "../application_configuration.php";

$conn = dbconn();
echo "************************************************************\n";
echo "*** URL \t\t\t\t\t\t STATUS ***\n";
echo "************************************************************\n";
while($key = current($map)) {
	
	$res = cadastraUrl($conn, key($map));
	if ($res) {
		echo key($map)."\t\t\t\t\t\t Inserindo...\n";
	} else {
		echo key($map)."\t\t\t\t\t\t SKIP\n";
	}
	next($map);
} 

echo "\n******* Update Admin profile *******\n";
$q =
	<<<EOD
INSERT INTO perfil(nome) VALUES('ADMINISTRADOR')
EOD;

$res = $conn->execute($q);
if ($res) {
	echo "ADMIN profile created ---------- ok\n";
} else {
	echo "ADMIN profile created ---------- no\n";
}

$q = 
	<<<EOD
INSERT INTO perfilUrl(perfil, url) 
(SELECT 1, nome FROM url 
	WHERE nome NOT IN (SELECT url FROM perfilUrl WHERE perfil = 1));
EOD;

echo "\n******* Update Acess for Admin *******\n";
$res = $conn->execute($q);
if ($res) {
	echo "ADMIN access update ---------- ok\n";
} else {
	echo "ADMIN access update ---------- no\n";
}

function cadastraUrl($conn, $url) {
	$q =
		<<<EOD
INSERT INTO url(nome) VALUES(?);
EOD;
	$res = $conn->execute($q, array($url));

	if ($res) {
		return true;
	} else {
		return false;
	}
}
