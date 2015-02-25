<?php
/**
 * Created by PhpStorm.
 * User: Matthew Baggett
 * Date: 25/02/2015
 * Time: 19:16
 */

require_once("vendor/autoload.php");

if(php_sapi_name() == 'cli'){
  $_SERVER['HTTP_HOST'] = "localhost";
  $_SERVER['SERVER_PORT'] = 80;
}
define("APP_ROOT", dirname(__FILE__));
define("WEB_HOST",      $_SERVER['HTTP_HOST']);
define("WEB_DISK_ROOT", str_replace("\\", "/", dirname($_SERVER['SCRIPT_FILENAME'])));
define("APP_DISK_ROOT", WEB_DISK_ROOT);
define("WEB_PORT",      $_SERVER['SERVER_PORT']);
define("WEB_IS_SSL",    WEB_PORT==443?true:false);
define("WEB_ROOT",      (WEB_IS_SSL?"https":"http") . "://" . WEB_HOST . rtrim(str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME'])),"/") . "/");
define("APP_NAME",      "FoodPanda CSV Thing");

