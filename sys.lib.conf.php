<?php

define("CORE_PDO","core:DPDO");
define("CORE_STRING","core:String");
define("CORE_TIMES","core:Times");
define("CORE_PAGINATION","core:Pagination");
define("CORE_FILEHANDLE","core:FileHandle");
define('DEFAULT_LAYOUT', 'default.tpl');
define("USER", "user");
define("MACOS", '/~mtd/htaccess/');


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
function lib_redirect($url=THIS_LINK){
  echo "<script> window.location = '".$url."' </script>";
  exit();
}
function lib_redirect_back(){
	echo "<script> history.go(-1); </script>";
	exit();
}
 ?>
