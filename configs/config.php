<?php

define('FILE_CONF_DATABASE', '../../constant/database.ini');
define('SETTING_FILE', '../../constant/setting.ini');
define('DB_INFO', get_db_info());
define("THIS_LINK", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
define("DOMAIN", "http://" . $_SERVER['HTTP_HOST'] . '/~mtd/htaccess/');
define("HOME_PAGE", DOMAIN . "admin");
define("LOGIN_PAGE", DOMAIN . "admin?mc=user&site=login");
define("DENIED_PAGE", DOMAIN . "admin?mc=home&site=denied");
// lay info db

function get_db_info() {
  if(file_exists(FILE_CONF_DATABASE))
  {
    $info = parse_ini_file(FILE_CONF_DATABASE);
    if(count($info) > 1)
    {
      $conn = implode(",", $info);
    }
  }
  return $conn;
}


 ?>
