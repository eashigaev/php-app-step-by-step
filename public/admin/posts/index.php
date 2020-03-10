<?php

require_once '../auth.php';

require '../../../classes/PostRepository.php';
require_once '../../../classes/View.php';

$postRepo = new PostRepository();
$posts = $postRepo->getAll();

$view = new View();
echo $view->render('admin/posts', [
    'posts' => $posts
]);
