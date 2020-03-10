<?php

session_start();

require_once __DIR__ . '/../autoload.php';

$bindings = require_once __DIR__ . '/../bindings.php';
$container = (new Container())->bindAll($bindings);

$config = require_once __DIR__ . '/../config.php';
$config = (new Config())->setAll($config);

$routes = require_once __DIR__ . '/../routes.php';
$router = (new Router())->registerAll($routes);

$container
    ->bind(Config::class, $config)
    ->bind(Router::class, $router)
    ->bind(View::class, fn() => new View($config->get('templates.path')));

try {
    $handler = $router->match();
    if (is_array($handler)) {
        $controller = $container->make($handler[0]);
        $action = $handler[1];
        $handler = fn() => $controller->$action();
    }
    echo $handler();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}
