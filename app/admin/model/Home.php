<?php

class Home extends Main
{

  function __construct() {
    parent::__construct();
  }

  public function index()
  {
    // pre($this->arg);
    $this->smarty->display(DEFAULT_LAYOUT);
  }
  public function denied()
  {
    $this->smarty->display ( "error.tpl" );
  }
}
 ?>
