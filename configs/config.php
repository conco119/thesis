<?php

define('FILE_CONF_DATABASE', '../../constant/database.ini');
define('DB_INFO', get_db_info());
define("THIS_LINK", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$http_host = $_SERVER['HTTP_HOST'];
define("DOMAIN", "http://" . $http_host . "/~mtd/htaccess/");
define("HOME_PAGE", DOMAIN . "admin");
define("LOGIN_PAGE", DOMAIN . "admin?mc=user&site=login");
define("DENIED_PAGE", DOMAIN . "admin?mc=home&site=denied");
// lay info db
function get_db_info() {
  if(file_exists(FILE_CONF_DATABASE)){
    $info = parse_ini_file(FILE_CONF_DATABASE);
    // var_dump($info);
    if(count($info) > 1){
      $info[] = @$content['server'];
      $info[] = @$content['data_user'];
      $info[] = @$content['data_pass'];
      $info[] = @$content['data_name'];
      $conn = implode(",", $info);
    }
  }
  return $conn;
}

 ?>
