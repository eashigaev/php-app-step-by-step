<?php

session_start();

require_once '../../autoload.php';

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

$view = new View();
echo $view->render('admin/login');
