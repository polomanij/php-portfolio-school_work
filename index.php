<?php
//FRONT CONTROLLER

//SETTINGS
error_reporting(E_ALL);

//FILES INCLUDING
define('ROOT', dirname(__FILE__));
require_once ROOT.'/components/Router.php';

//ROUTER CALLING
$router = new Router();
$router->run();