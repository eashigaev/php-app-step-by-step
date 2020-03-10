<?php

use App\Controllers\Admin\AdminPageController;
use App\Controllers\Admin\AdminPostController;
use App\Controllers\AuthController;
use App\Controllers\PageController;

return [
    '/' => [PageController::class, 'index'],
    '/about' => [PageController::class, 'about'],
    '/posts' => [PageController::class, 'posts'],
    '/admin/login' => [AuthController::class, 'login'],
    '/admin/logout' => [AuthController::class, 'logout'],
    '/admin' => [AdminPageController::class, 'index'],
    '/admin/posts' => [AdminPostController::class, 'index'],
    '/admin/posts/create' => [AdminPostController::class, 'create'],
    '/admin/posts/delete' => [AdminPostController::class, 'delete'],
];
