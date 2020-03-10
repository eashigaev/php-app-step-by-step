<?php

namespace App\Controllers;

use Vendor\Config;
use Vendor\View;

class AuthController
{
    protected View $view;
    protected Config $config;

    public function __construct(View $view, Config $config)
    {
        $this->view = $view;
        $this->config = $config;
    }

    public function login()
    {
        $config = $this->config;

        if (isset($_POST)) {
            $login = $_POST['login'] ?? null;
            $pass = $_POST['pass'] ?? null;
            if ($login === $config->get('user.login') && md5($pass) === $config->get('user.pass')) {
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
