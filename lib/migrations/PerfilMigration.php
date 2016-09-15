<?php
final class PerfilMigration extends Migration {
	
	public function run() {
		$q =
			<<<EOD
CREATE TABLE perfil(
	id serial,
	nome varchar(255),
	PRIMARY KEY (id),
	UNIQUE(nome)
);
EOD;
		return $q;
	}

	public function undo() {}
}
