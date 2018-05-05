<?php
/* Smarty version 3.1.30, created on 2018-04-09 09:47:36
  from "/Users/mtd/Sites/htaccess/site/admin/index.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5acad448ebef04_74184031',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1adc08c54bc858b28b3fe997a31014a19bb32650' => 
    array (
      0 => '/Users/mtd/Sites/htaccess/site/admin/index.php',
      1 => 1523241844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5acad448ebef04_74184031 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>ob_start();
session_start();



require_once '../../index.php';
require_once './model/Main.php';

$login = isset($_SESSION[LOGIN_MEMBER]) ? intval($_SESSION[LOGIN_MEMBER]) : 0;
$mc = isset($_GET['mc']) ? $_GET['mc'] : "home";
$site = isset($_GET['site']) ? $_GET['site'] : "index";


// $tpl = "../" . $mod . "/" . $site . ".tpl";
$file = ucfirst($mc) . ".php";
$class = ucfirst($mc);


require_once './model/' . $file;
$use = new $class;
$use->$site();

# ------------------------------------- #
<?php }
}
