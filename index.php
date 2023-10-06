<?php
session_start();
require 'function.php';
//cek apakah ada cookie dibuat
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $id = $_COOKIE['id'];
    $username = $_COOKIE['key'];
    //ambil username berdasarkan id
    $result  = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    //cek username dan cookie
    if ($username === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}




if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit;
}



$mahasiswa = query("SELECT * FROM mahasiswa");

$no = 1;

if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/code.jquery.com_jquery-3.7.0.min.js"></script>

    <title>Data Mahasiswa</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .loader {
            width: 30px;
            position: absolute;
            top: 183px;
            left: 880px;
            z-index: -1;
            display: none;
        }

        main {
            padding: 50px;
        }

        article h1 {
            text-align: center;
            color: aqua;
        }

        article table {
            margin: 0 auto;
        }

        article a {
            text-align: center;
        }

        article section {
            text-align: center;
        }

        nav {
            text-align: center;
        }

        nav li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
        }

        .baris {
            background-color: aqua;
        }
    </style>
</head>

<body>
    <main>
        <article>

            <h1>Daftar Mahasiswa</h1>
            <nav>
                <ul>
                    <li><a href="tambah.php">Tambah Data</a></li>
                    <li><a href="registrasi.php">Register</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="cetak.php">Cetak</a></li>


                </ul>
            </nav>
            <br>
            <br>
            <section>
                <form action="" method="post">
                    <input type="text" size="50px" id="keyword" name="keyword" autocomplete="off" autofocus placeholder="masukkan keyword pencarian..">
                    <button type="submit" name="cari" id="cari">Cari</button>
                    <img src="img/loader.gif" class="loader">
                </form>
            </section>
            <br>
            <div id="container">
                <table border="1" cellspacing="0" cellpadding="10">
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Gambar</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                    </tr>


                    <?php foreach ($mahasiswa as $mhs) : ?>


                        <?php for ($i = 1; $i <= $no; $i++) : ?>
                            <?php if ($i % 2 == 1) : ?>
                                <tr class="baris">

                                <?php else : ?>
                                <tr>
                                <?php endif ?>
                            <?php endfor ?>
                            <td><?= $no; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $mhs["id"]; ?>">Edit</a> |
                                <a href="hapus.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('yakin ingin dihapus ?');">Hapus</a>
                            </td>

                            <td><img src="img/<?= $mhs["gambar"]; ?>" width="50px" height="50px"></td>
                            <td><?= $mhs["nim"]; ?></td>
                            <td><?= $mhs["nama"]; ?></td>
                            <td><?= $mhs["email"]; ?></td>
                            <td><?= $mhs["jurusan"]; ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach ?>










                </table>
            </div>


    </main>
    </article>

    <script src="js/script.js"></script>
</body>

</html>