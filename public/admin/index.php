<?php

use App\Controllers\Admin\PostController;
use App\Repositories\PostRepository;

session_start();

require_once '../../autoload.php';

$ctrl = new PostController(
    new View(),
    new PostRepository()
);
echo $ctrl->index();
