<?php
final class ApiPessoaController extends RestController {
  private $ar = array();

  public function restResponse() {
    return $this->ar;
  }

  public function processRequest() {
    if (is_get()) {
      $r = $this->getRequest();
      $part = $r->getString('part');
      $part = 
        <<<EOD
%$part%
EOD;
      $q =
        <<<EOD
SELECT id, nome, sobrenome, rg FROM pessoa WHERE nome like ?;
EOD;
      $conn = dbconn();
      $res = $conn->executeQuery($q, array($part));
      if ($res) {
        foreach($res as $o) {
          $this->ar[] = $o;
        }
      }
    } 
  }
}
