<?php

session_start();

require '../../classes/PostRepository.php';
require_once '../../classes/View.php';
$view = new View();

$config = require_once '../../config.php';

if (isset($_POST)) {
    $login = $_POST['login'] ?? null;
    $pass = $_POST['pass'] ?? null;
    if ($login === $config['user.login'] && md5($pass) === $config['user.pass']) {
        $_SESSION['auth'] = true;
        header('Location: ./');
        exit;
    }
}

?>

<?= $view->render('layout/header'); ?>


<h1>Login</h1>

<form action="login.php" method="post">
    <input type="text" name="login" placeholder="Login" value="admin">
    <br>
    <input type="password" name="pass" placeholder="Pass" value="12345">
    <br>
    <input type="submit" value="Login">
</form>

<?= $view->render('layout/footer'); ?>
