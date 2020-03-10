<?php

session_start();

$auth = $_SESSION['auth'] ?? false;

if (!$auth) {
    header('Location: /admin/login.php');
    exit;
}
