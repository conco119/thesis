<?php

class Export extends Main
{
  function __construct() {
    parent::__construct();
  }

  public function index()
  {
    $this->smarty->display(DEFAULT_LAYOUT);
    echo "here";
  }
}

 ?>
