<?php

class Pub
{

  public function denied()
  {
    global $smarty, $tpl_file;
    $smarty->assign("tpl_file", $tpl_file);
    $smarty->display( "error.tpl" );
  }

}
 ?>
