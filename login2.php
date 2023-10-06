<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location:index.php");
    exit;
}
require 'function.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username ='$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            $_SESSION['login'] = true;
            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header('Location:index.php');
            exit;
        }
    }
    $error = true;
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>

<body>
    <h1>Halaman Login</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red;">username/password salah!</p>
    <?php endif ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" autocomplete="off"></td>
            </tr>
            <tr>
                <td>password</td>
                <td>:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Remember me</td>
                <td></td>
                <td><input type="checkbox" name="remember"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="login">Login</button></td>
            </tr>
        </table>
    </form>

</body>

</html>