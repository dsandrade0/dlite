<?php
final class Dbconn {
  private $conn;
  private $result;
  private $hasMemcache = true;
  private $mem;

  public function __construct() {
    if (!isset($GLOBALS['connection'])) {
      $this->connect();
    } else {
      $this->conn = $GLOBALS['connection'];
    }
    if ($this->hasMemcache) {
      $this->mem = new Memcached(); 
      $this->mem->addServer('localhost', 11211);
    }
  }

  public function connect() {
    try {
      $this->conn = 
        new PDO('mysql:host=localhost;dbname=consulta;port=3306', 'root', '12345678');
      $GLOBALS['connection'] = $this;
    } catch(PDOException $e) {
      echo 'Error to connect database - '. $e->getMessage();
    }
  }

  public function close() {
    //$this->mem->flush_all();
    $this->conn = null;
  }

  public function executeQuery($q, $args = array()) {
    if ($this->hasMemcache) {
      $is_cache = $this->inMemory($q);
      if ($is_cache) {
        //Get data from the cache
        dlog('Cache');
        return $this->getCache($q);
      }
    }

    $stmt = $this->conn->prepare($q);
    $this->result = $stmt->execute($args);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  /** 
   * Função usada para UPDATE, INSERT e DELETE
   */
  public function execute($query, $args = array()) {
    $stmt = $this->conn->prepare($query);
    $this->result = $stmt->execute($args);
    return $this->result;
  }

  /** Trabalhando com transações em banco de dados **/
  public function beginTransaction() {
    $this->conn->beginTransaction();
  }

  public function rollbackTransaction() {
    $this->conn->rollBack();
  }

  public function commitTransaction() {
    $this->conn->commit();
  }

  public function getResult() {
    return $this->result;
  }
  
  public function getConn() {
    return $this->conn;
  }

  private function inMemory($query) {
    $key = md5($query);
    $cache = $this->mem->get($key);
    if ($cache == false) {
      return false;
    } else {
      return true;
    }
  }

  private function getCache($query) {
    $key = md5($query);
    return $this->mem->get($key);
  }

  private function setCache($query, $result, $time = 3600) {
    $key = md5($query);
    $this->mem->set($key, $result, $time);
  }
}
