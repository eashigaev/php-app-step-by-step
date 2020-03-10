<?php

require_once '../auth.php';
require_once '../../classes/PostRepository.php';
require '../../templates/header.php';

?>

<h1>Microblog Admin</h1>

<div>
    <a href="..">Blog</a> |
    <a href="/admin/logout.php">Logout</a>
</div>

<form action="/admin/posts/create.php" method="post">
    <input type="text" name="title" placeholder="Title">
    <br>
    <input type="text" name="text" placeholder="Text">
    <br>
    <input type="submit" value="Create">
</form>

<?php

$postRepo = new PostRepository();
$posts = $postRepo->getAll();

foreach ($posts as $index => $post) {
    echo "<h3>{$post['title']}</h3>";
    echo "<div>{$post['text']}</div>";
    echo "<div><a href='/admin/posts/delete.php?index={$index}'>Delete</a></div>";
}

?>

<?php require '../../templates/footer.php'; ?>
