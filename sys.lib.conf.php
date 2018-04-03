<?php

define("CORE_PDO","core:PDO");
define("LOGIN_MEMBER", "session_login_member");


// require lib
function lib_use($path){
  $convToArray = explode(":", $path);
  $dir = "library";
  $dir .= "/" . implode("/", $convToArray) . ".php";
  require_once $dir;
}
 ?>
