<?php

session_start();

require_once '../autoload.php';

$routes = require_once '../routes.php';
$router = new Router();
$router->registerAll($routes);

try {
    echo $router->run();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}
