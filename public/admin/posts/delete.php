<?php

require_once '../auth.php';
require_once '../../../classes/PostRepository.php';

$index = $_GET['index'] ?? null;

$postRepo = new PostRepository();
$postRepo->delete($index);

header('Location: /admin/posts');
exit;
