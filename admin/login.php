<?php

session_start();

$config = require_once '../config.php';

if (isset($_POST)) {
    $login = $_POST['login'] ?? null;
    $pass = $_POST['pass'] ?? null;
    if ($login === $config['user.login'] && md5($pass) === $config['user.pass']) {
        $_SESSION['auth'] = true;
        header('Location: ./');
        exit;
    }
}

require_once '../templates/header.php';

?>

    <h1>Login</h1>

    <form action="login.php" method="post">
        <input type="text" name="login" placeholder="Login" value="admin">
        <br>
        <input type="password" name="pass" placeholder="Pass" value="12345">
        <br>
        <input type="submit" value="Login">
    </form>

<?php

require_once '../templates/footer.php';
