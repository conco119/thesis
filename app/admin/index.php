<?php
ob_start();
session_start();
// error_reporting(0);


require_once '../../index.php';
require_once './model/interface.php';
require_once './model/main.php';
//help
require_once './helper/helpabstract.php';
require_once './helper/helper.php';

// id user
$login_id = isset($_SESSION["LOGIN_MEMBER"]) ? intval($_SESSION["LOGIN_MEMBER"]) : 0;

$mc = isset($_GET['mc']) ? $_GET['mc'] : "home";
$site = isset($_GET['site']) ? $_GET['site'] : "index";


$tpl_file = "../" . $mc . "/" . $site . ".tpl";
$file = ucfirst($mc) . ".php";
$class = ucfirst($mc);

//require helper without ajax
$helper_wo_ajax = explode('ajax', $mc)[0];
if( file_exists("./helper/" . $helper_wo_ajax . "helper" . ".php") )
    require_once "./helper/" . $helper_wo_ajax . "helper" . ".php";

//require helper if exist
if( file_exists("./helper/" . $mc . "helper" . ".php") )
    require_once "./helper/" . $mc . "helper" . ".php";

require_once './model/' . $file;
$use = new $class;
$use->$site();

# ------------------------------------- #
