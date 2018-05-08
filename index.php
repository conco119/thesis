<?php
require_once 'vendor/autoload.php';

$dsn = 'mysql:host=localhost;dbname=htaccess3;charset=utf8';
$usr = 'root';
$pwd = '1234';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

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

 ?>
