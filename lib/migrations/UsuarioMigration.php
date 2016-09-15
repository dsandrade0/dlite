<?php
final class UsuarioMigration extends Migration {
	
	public function run() {
		$q =
			<<<EOD
CREATE TABLE usuario(
	id serial,
	nome varchar(255),
	email varchar(255),
	senha varchar(255),
	bloqueio int,
	nivel int,
  cliente integer,
	gestor int DEFAULT 0,
	PRIMARY KEY (id)
);
EOD;
		return $q;
	}

	public function undo() {}
}
