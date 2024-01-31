<?php

namespace core\library;

use function  FastRoute\simpleDispatcher;
use app\controllers\NotFoundController;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

class Router
{
    private array $routes;
    public function add(string $method, string $uri, array $controller)
    {
        $this->routes[] = [$method, $uri, $controller];
    }

    public function run()
    {
        $dispatcher = simpleDispatcher(function(RouteCollector $r) {
            foreach($this->routes as $route) {
                $r->addRoute(...$route);
            }
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        $this->execute($routeInfo);
    }

    private function execute(array $routeInfo)
    {
        switch ($routeInfo[0]) {
        case Dispatcher::NOT_FOUND:
            call_user_func_array([new NotFoundController, 'index'], []);
            break;
        case Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // ... 405 Method Not Allowed
            break;
        case Dispatcher::FOUND:
            [,[$controller, $method], $vars] = $routeInfo;

            call_user_func_array([new $controller, $method], $vars);
            break;
}
    }
}