<?php

use App\Controllers\PageController;
use App\Repositories\PostRepository;

require_once '../autoload.php';

$ctrl = new PageController(
    new View(),
    new PostRepository()
);
echo $ctrl->posts();
