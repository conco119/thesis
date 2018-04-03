<?php

lib_use(CORE_PDO);
class Main {
  public $pdo;
  function __construct() {
    $this->pdo = new Dbo();
  }
}

 ?>
