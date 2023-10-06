<?php
require 'function.php';


if (isset($_POST['submit'])) {
    if (registrasi($_POST) > 0) {
        echo "
        <script>
        alert('Berhasil Registrasi');
        </script>
        ";
    } else {
        mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>

<body>

    <a href="index.php">Kembali</a>

    <h1>Form - Registrasi</h1>

    <form action="" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" placeholder="masukkan username baru anda" size="30" name="username" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" placeholder="masukkan Password baru anda" size="30" name="password" required></td>
            </tr>
            <tr>
                <td>Konfirmasi Password</td>
                <td>:</td>
                <td><input type="password" placeholder="Konfirmasi Password Anda" size="30" name="password2" required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="submit">Daftar</button></td>
            </tr>

        </table>
    </form>

</body>

</html>