<?php
session_start();
header('X-Frame-Options: DENY');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(substr($_SERVER['SERVER_NAME'],0,4) != "www." && $_SERVER['SERVER_NAME'] != 'localhost'){
    header('Location: http://www.'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
}
header("Content-type: text/html; charset=utf-8");
$dir_explode = explode("index.php",__FILE__);
define("DIR", $dir_explode[0]);
// Deny requesting GLOBALS
if (ini_get('register_globals'))
{
    (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) AND exit(1);
    $global_variables = array_keys($GLOBALS);
    $global_variables = array_diff($global_variables, array(
                '_COOKIE', '_ENV', '_GET',
                '_FILES', '_POST', '_REQUEST',
                '_SERVER', '_SESSION', 'GLOBALS'
            ));
    foreach ($global_variables as $name)
        unset($GLOBALS[$name]);
}
date_default_timezone_set("Asia/Tbilisi");
@include("config.php");
function __autoload($class_name) 
{
    $filename = str_replace('_', DIRECTORY_SEPARATOR, strtolower($class_name)).'.php';

	$file = $filename;
	if (!file_exists($file))
    {
        echo "Class: <b>".$class_name."</b> can't load.."; exit();
    }
    @include $file;
}

$bootstrap = new lib_lancher_bootstrap();
$bootstrap->lanch($c); 
?>