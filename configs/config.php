<?php

define('FILE_CONF_DATABASE', '../../constant/database.ini');
define('DB_INFO', get_db_info());
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
