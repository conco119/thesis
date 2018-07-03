<?php
ob_start();
session_start();
// error_reporting(0);
// ini_set('display_errors', 1) ;


require_once '../../index.php';
// require_once './model/interface.php';
require_once './model/Main.php';
//help
require_once './helper/HelpAbstract.php';
require_once './helper/Helper.php';

// id user
$login_id = isset($_SESSION["LOGIN_MEMBER"]) ? intval($_SESSION["LOGIN_MEMBER"]) : 0;

$mc = isset($_GET['mc']) ? $_GET['mc'] : "home";
$site = isset($_GET['site']) ? $_GET['site'] : "index";


$tpl_file = "../" . $mc . "/" . $site . ".tpl";
$file = ucfirst($mc) . ".php";
$class = ucfirst($mc);
$mc = ucfirst($mc);


//require helper without ajax
$helper_wo_ajax = explode('ajax', $mc)[0];
if( file_exists("./helper/" . $helper_wo_ajax . "Helper" . ".php") )
    require_once "./helper/" . $helper_wo_ajax . "Helper" . ".php";

//require helper if exist
if( file_exists("./helper/" . $mc . "Helper" . ".php") ) {
    require_once "./helper/" . $mc . "Helper" . ".php";
}


require_once './model/' . $file;
$use = new $class;
$use->$site();

# ------------------------------------- #
