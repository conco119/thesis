<?php

lib_use(CORE_PDO);
class Main {
  public $pdo;
  function __construct() {
    $pdo = new Dbo(DB_INFO);
    $pdo->query("select * from user");
    $pdo->close();
  }
}

 ?>
