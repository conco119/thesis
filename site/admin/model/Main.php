<?php

lib_use(CORE_PDO);
lib_use(CORE_STRING);
lib_use(CORE_PAGINATION);
lib_use(CORE_FILEHANDLE);
lib_use(CORE_TIMES);
class Main {
  public $pdo;
  function __construct() {
    $this->pdo = new DPDO();
    $this->pagination = new pagination();
    $this->filehanle = new FileHandle();
    $this->times = new Times();
    $this->dstring = new DString();
  }
}

 ?>
