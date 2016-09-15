<?php
final class ClienteMigration extends Migration {

  public function run() {
    $q =
      <<<EOD
CREATE TABLE cliente(
  id serial,
  nome varchar(255),
  status integer,
  PRIMARY KEY (id)
);
EOD;
    return $q;
  }
}
