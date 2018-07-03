<?php

define("CORE_PDO","core:DPDO");
define("CORE_STRING","core:String");
define("CORE_TIMES","core:Times");
define("CORE_PAGINATION","core:Pagination");
define("CORE_PAGINATION2","core:Pagination2");
define("CORE_FILEHANDLE","core:FileHandle");
define("CORE_ZEBRA","core:Zebra");
define("CORE_IMAGE","core:Image");
define('DEFAULT_LAYOUT', 'default.tpl');
define("USER", "user");
define("ROOT_PATH", __DIR__);
// define()

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
function lib_alert($title){
	echo "<meta charset=\"UTF-8\"><script> alert('".$title."'); </script>";
}

function lib_alert_with_exit($title){
  echo "<meta charset=\"UTF-8\"><script> alert('".$title."'); </script>";
  exit();
}
function base_path($path = null) {
  if($path == null)
    return ROOT_PATH . '/';
  else
    return ROOT_PATH . "/" . $path;
}

function base_url($url = null) {
  if($url == null)
      return DOMAIN;
  else
      return DOMAIN . $url;
}

 ?>
