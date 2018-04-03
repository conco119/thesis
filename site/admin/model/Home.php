<?php

class Home extends Main{
  function __construct() {
    parent::__construct();
  }
  function index() {
    echo "home function" . "<br>";
    // pre($this->pdo);
    $this->pdo->connect();
    $users = $this->pdo->fetch_all_array("select * from user");
    pre($users);
    // var_dump($this->pdo->affected_rows);
  }
}

 ?>
