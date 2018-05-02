<?php
require_once('configs/config.php');
require_once('sys.lib.conf.php');

date_default_timezone_set("Asia/Bangkok");
require_once('library/smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = "view/layouts/";
$compile_dir = "cache/";
if(!is_dir($compile_dir)){
  mkdir($compile_dir, 0777);
}
$smarty->compile_dir  = $compile_dir;
$smarty->config_dir   = 'configs/';
#$smarty->cache_dir    = CACHE_PATH;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 1200;


 ?>
<?php

// define('FILE_CONF_DATABASE', '../constant/database.ini');
// define('DB_INFO', get_db_info());
// // lay info db
// function get_db_info() {
//   if(file_exists('constant/database.ini')){
//     $info = parse_ini_file('constant/database.ini');
//     if(count($info) > 1){
//       $info[] = @$content['server'];
//       $info[] = @$content['data_user'];
//       $info[] = @$content['data_pass'];
//       $info[] = @$content['data_name'];
//       $conn = implode(",", $info);
//     }
//   }
//   var_dump($info);
// }

 ?>
