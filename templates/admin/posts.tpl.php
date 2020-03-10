<?= $this->render('layout/header'); ?>

<h1>Microblog Admin</h1>

<div>
    <a href="/">Blog</a> |
    <a href="/admin/logout.php">Logout</a>
</div>

<form action="/admin/posts/create.php" method="post">
    <input type="text" name="title" placeholder="Title">
    <br>
    <input type="text" name="text" placeholder="Text">
    <br>
    <input type="submit" value="Create">
</form>

<?php foreach ($posts as $index => $post): ?>
    <h3><?= $post['title'] ?></h3>
    <div><?= $post['text'] ?></div>
    <div><a href='/admin/posts/delete.php?index=<?= $index ?>'>Delete</a></div>
<?php endforeach; ?>

<?= $this->render('layout/footer'); ?>
