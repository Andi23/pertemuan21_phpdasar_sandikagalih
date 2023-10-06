<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit;
}
require 'function.php';


if (isset($_POST["submit"])) {


    if (tambah($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil DIinput');
        document.location.href = 'index.php';
        
    </script>
        
        
        ";
    } else {
        echo "
        <script>
        alert('Data gagal DIinput');
        document.location.href = 'index.php';
        
    </script>
        
        
        ";
    }
}


?>



<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data</title>
</head>

<body>
    <h1>Tambah Data</h1>
    <a href="index.php">Kembali</a>

    <form method="post" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" required></td>

            </tr>
            <tr>
                <td><label for="nim">Nim</label></td>
                <td>:</td>
                <td><input type="text" name="nim" id="nim" required></td>

            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input type="text" name="email" id="email" required></td>

            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" name="jurusan" id="jurusan" required></td>

            </tr>
            <tr>
                <td><label for="gambar">Gambar</label></td>
                <td>:</td>
                <td><input type="file" name="gambar" id="gambar"></td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="submit">Submit</button></td>
            </tr>
        </table>
    </form>


</body>

</html>