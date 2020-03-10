<?php

require_once '../autoload.php';

$id = $_GET['id'] ?? null;

$postRepo = new PostRepository();
$post = $postRepo->getById($id);

$view = new View();

echo $post
    ? $view->render('pages/posts-full', $post)
    : $view->render('pages/posts-all', [
        'posts' => $posts = $postRepo->getAll()
    ]);
