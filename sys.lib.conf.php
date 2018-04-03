<?php

define("CORE_PDO","core:DPDO");
define("CORE_STRING","core:String");
define("CORE_TIMES","core:Times");
define("CORE_PAGINATION","core:Pagination");
define("CORE_FILEHANDLE","core:FileHandle");

define("LOGIN_MEMBER", "session_login_member");


// require lib
function lib_use($path){
  $convToArray = explode(":", $path);
  $dir = "library";
  $dir .= "/" . implode("/", $convToArray) . ".php";
  require_once $dir;
}

function pre($content) {
  echo "<pre>";
    print_r($content);
  echo "</pre>";
}

 ?>
