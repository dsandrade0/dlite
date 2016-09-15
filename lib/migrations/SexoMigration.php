<?php
final class SexoMigration extends Migration {

  public function run() {
    $q =
      <<<EOD
CREATE TABLE sexo(
  id serial,
  nome varchar(255),
  PRIMARY KEY (id)
);
EOD;
    return $q;
  }
}
