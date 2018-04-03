<?php

class Home extends Main{

  function __construct() {
    parent::__construct();
  }

  function index() {
    echo "home function" . "<br>";
    // pre($this->pdo);
    // $this->pdo->connect();
    $sql = "select * from users";
    // $users = $this->pdo->fetch_all($sql);
    $paging = $this->pagination->get_content($this->pdo->count_rows($sql),5);
    $sql.= $paging['sql_add'];
    $users = $this->pdo->fetch_all($sql);
    echo $paging['paging'];
    pre($users);
    echo $this->times->time_posts(1522749955);
    echo $this->dstring->str_short("http://www.rustycompass.com   Learning a few words of Vietnamese can bring loads of fun to travel in the country. The Vietnamese people are very receptive to foreigners who try to learn a few words of their language. In this, the first in a series of language classes for travellers, we cover some basic vocabulary and some of the challenges the language presents.", 20);
  }
}

 ?>
