<?php

require_once '../classes/PostRepository.php';
require '../templates/header.php';

?>

<h1>Welcome to my microblog</h1>
<ul>
    <li><a href="posts.php">Posts</a></li>
    <li><a href="about.php">About</a></li>
</ul>

<p>
    Термин «блог» был придуман Йорном Баргером 17 декабря 1997 года. Короткую форму слова «блог» придумал Питер
    Мерхольц, который в шуточной форме использовал в своём блоге Peterme.com в апреле или мае 1999 года.
</p>
<p>
    Эван Уильямс из Pyra Labs использовал «блог» как существительное и глагол (англ. «to blog», что означает «изменить
    свой блог или отправить на свой блог»), что привело к созданию термина «блогер». В Pyra Labs был создан Blogger.com,
    что привело к популяризации блогерства.
</p>

<?php

$postRepo = new PostRepository();
$post = $postRepo->getAll()[0];

echo "<h3>{$post['title']}</h3>";
echo "<div>{$post['text']}</div>";

?>

<?php require './templates/footer.php'; ?>
