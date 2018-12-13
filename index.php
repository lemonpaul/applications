<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');

session_start();

if (!isset($_SESSION['user']) && (Router::getFirstSegmentOfURI() != "login")) {
	header("Location: /login");
}

$router = new Router();
$router->run();