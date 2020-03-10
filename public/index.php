<?php

require_once '../autoload.php';

$postRepo = new PostRepository();

$view = new View();
echo $view->render('pages/index', [
    'post' => $postRepo->getAll()[0]
]);
