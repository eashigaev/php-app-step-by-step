<?php

require_once '../classes/PostRepository.php';
require_once '../classes/View.php';

$postRepo = new PostRepository();

$view = new View();
echo $view->render('pages/index', [
    'post' => $postRepo->getAll()[0]
]);
