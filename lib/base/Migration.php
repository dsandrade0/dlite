<?php
abstract class Migration {

  abstract protected function run();

  public function go($conn) {
    try {
      $result = $conn->execute($this->run());
    } catch(Exception $e) {
      return false;
    }
    return $result;
  }

	public function undo() {}
}
