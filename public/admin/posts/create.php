<?php

require_once '../auth.php';
require_once '../../../classes/PostRepository.php';

$postRepo = new PostRepository();
$postRepo->create([
    'id' => uniqid(),
    'title' => $_POST['title'] ?? '',
    'text' => $_POST['text'] ?? '',
]);

header('Location: /admin/posts');
exit;
