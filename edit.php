<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit;
}
require 'function.php';
$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id ='$id'")[0];

if (isset($_POST["submit"])) {

    if (ubah($_POST) > 0) {
        echo "
        <script>
        alert('Data Berhasil diubah');
        document.location.href = 'index.php';
        
    </script>
        
        
        ";
    } else {
        echo "
        <script>
        alert('Data Gagal diubah');
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
    <title>Ubah data</title>
</head>

<body>
    <h1>Ubah Data</h1>
    <a href="index.php">Kembali</a>


    <form method="post" action="" enctype="multipart/form-data">
        <table>
            <input type="hidden" name="gambarLama" id="" value="<?= $mhs["gambar"]; ?>">
            <input type="hidden" name="id" id="" value="<?= $mhs["id"]; ?>">
            <tr>
                <td><label for="nama">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>"></td>

            </tr>
            <tr>
                <td><label for="nim">Nim</label></td>
                <td>:</td>
                <td><input type="text" name="nim" id="nim" required value="<?= $mhs["nim"]; ?>"></td>

            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>"></td>

            </tr>
            <tr>
                <td><label for="jurusan">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>"></td>

            </tr>
            <tr>
                <td><label for="gambar">Gambar :</label></td>
                <td><img src="img/<?= $mhs["gambar"]; ?>" width="70"></td>
                <td><input type="file" name="gambar" id="gambar" required"></td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="submit" onclick="return confirm('Simpan perubahan data ?');">Submit</button></td>
            </tr>
        </table>
    </form>


</body>

</html>