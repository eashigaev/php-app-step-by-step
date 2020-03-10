<?php

use App\Controllers\Admin\AdminPageController;
use App\Controllers\Admin\AdminPostController;
use App\Controllers\AuthController;
use App\Controllers\PageController;
use App\Repositories\PostRepository;

session_start();

require_once '../autoload.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri)['path'];

$pageCtrl = fn() => new PageController(new View(), new PostRepository());
$authCtrl = fn() => new AuthController(new View());
$adminPageCtrl = fn() => new AdminPageController();
$adminPostCtrl = fn() => new AdminPostController(new View(), new PostRepository());

$routes = [
    '/' => fn() => $pageCtrl()->index(),
    '/about' => fn() => $pageCtrl()->about(),
    '/posts' => fn() => $pageCtrl()->posts(),
    '/admin/login' => fn() => $authCtrl()->login(),
    '/admin/logout' => fn() => $authCtrl()->logout(),
    '/admin' => fn() => $adminPageCtrl()->index(),
    '/admin/posts' => fn() => $adminPostCtrl()->index(),
    '/admin/posts/create' => fn() => $adminPostCtrl()->create(),
    '/admin/posts/delete' => fn() => $adminPostCtrl()->delete()
];

try {
    $action = $routes[$path] ?? null;
    echo $action();
} catch (\Throwable $exception) {
    echo '404 Not Found';
}
