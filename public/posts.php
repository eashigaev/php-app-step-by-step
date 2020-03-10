<?php

require '../templates/header.php';
require '../classes/PostRepository.php';

?>

<h1 class="title">Micro Blog</h1>
<div><a href="/">Main</a></div>

<?php

$postRepo = new PostRepository();
$posts = $postRepo->getAll();

$id = $_GET['id'] ?? null;
$post = $postRepo->getById($id);

if ($post) {
    echo "<h3>{$post['title']}</h3>";
    echo "<div>{$post['text']}</div>";
    echo "<div><a href='/posts.php'>Back</a></div>";
} else {
    foreach ($posts as $post) {
        echo "<h3>{$post['title']}</h3>";
        echo "<div>{$post['text']}</div>";
        echo "<div><a href='/posts.php?id={$post['id']}'>Link</a></div>";
    }
}
?>

<?php require '../templates/footer.php'; ?>
