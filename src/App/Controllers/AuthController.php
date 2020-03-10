<?php

namespace App\Controllers;

class AuthController
{
    protected \View $view;

    public function __construct(\View $view)
    {
        $this->view = $view;
    }

    public function login()
    {
        $config = require_once __DIR__ . '/../../../config.php';

        if (isset($_POST)) {
            $login = $_POST['login'] ?? null;
            $pass = $_POST['pass'] ?? null;
            if ($login === $config['user.login'] && md5($pass) === $config['user.pass']) {
                $_SESSION['auth'] = true;
                header('Location: /admin');
                exit;
            }
        }

        return $this->view->render('admin/login');
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header('Location: /admin');
        exit;
    }
}
