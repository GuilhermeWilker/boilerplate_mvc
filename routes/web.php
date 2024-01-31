<?php

namespace routes;
use app\controllers\HomeController;
use core\library\Router;

$router = new Router;

$router->add('GET', '/', [HomeController::class, 'index']);

$router->run();