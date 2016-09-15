<?php
final class PerfilUrlMigration extends Migration {
	
	public function run() {
		$q =
			<<<EOD
CREATE TABLE perfilUrl(
	perfil integer NOT NULL,
	url varchar(255) NOT NULL,
	PRIMARY KEY (perfil, url)
);
EOD;
		return $q;
	}

	public function undo() {}
}
