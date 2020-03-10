<?= $this->render('layout/header'); ?>

<h1 class="title">Posts</h1>
<div><a href="/">Main</a></div>

<?php foreach ($posts as $post): ?>
    <h3><?= $post['title'] ?></h3>
    <div><?= $post['text'] ?></div>
    <div><a href='/posts?id=<?= $post['id'] ?>'>Link</a></div>
<?php endforeach; ?>

<?= $this->render('layout/footer'); ?>
