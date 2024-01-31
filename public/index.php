<?php

session_start();

use app\controllers\HomeController;
use core\library\Router;

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$router = new Router;
$router->add('GET', '/', [HomeController::class, 'index']);

$router->run();


