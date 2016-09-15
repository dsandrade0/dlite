<?php
final class PessoaMigration extends Migration{
	
	public function run(){
	$q =
	<<<EOD
CREATE TABLE pessoa(
	id serial,
	nome varchar(255),
	sobrenome varchar(255),
	cpf varchar(255),
	rg varchar(255),
	email varchar(255),
	dataNascimento date,
	endereco varchar(255),
	sexo integer,
	PRIMARY KEY (id)
);
EOD;
	return $q;
	}
}
