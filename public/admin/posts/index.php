<?php

require_once '../auth.php';
require_once '../../../autoload.php';

$postRepo = new PostRepository();
$posts = $postRepo->getAll();

$view = new View();
echo $view->render('admin/posts', [
    'posts' => $posts
]);
