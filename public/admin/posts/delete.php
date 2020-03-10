<?php

require_once '../auth.php';
require_once '../../../autoload.php';

$index = $_GET['index'] ?? null;

$postRepo = new PostRepository();
$postRepo->delete($index);

header('Location: /admin/posts');
exit;
