<?php
final class URLMigration extends Migration {
	
	public function run() {
		$q =
			<<<EOD
CREATE TABLE url(
	id serial,
  nome varchar(255),
	label varchar(255),
	PRIMARY KEY (id),
	UNIQUE (nome)
);
EOD;
		return $q;
	}

	public function undo() {}
}
