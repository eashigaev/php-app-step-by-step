<?= $this->render('layout/header'); ?>

<h1>Login</h1>

<form action="/admin/login.php" method="post">
    <input type="text" name="login" placeholder="Login" value="admin">
    <br>
    <input type="password" name="pass" placeholder="Pass" value="12345">
    <br>
    <input type="submit" value="Login">
</form>

<?= $this->render('layout/footer'); ?>
