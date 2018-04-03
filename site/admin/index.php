<?php
ob_start();
session_start();



require_once '../../index.php';
require_once './model/Main.php';

$login = isset($_SESSION[LOGIN_MEMBER]) ? intval($_SESSION[LOGIN_MEMBER]) : 0;
$mod = isset($_GET['mod']) ? $_GET['mod'] : "home";
$site = isset($_GET['site']) ? $_GET['site'] : "index";


// $tpl = "../" . $mod . "/" . $site . ".tpl";
$file = ucfirst($mod) . ".php";
$class = ucfirst($mod);


require_once './model/' . $file;
$use = new $class;
$use->$site();

# ------------------------------------- #
