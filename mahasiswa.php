<?php
require '../function.php';
$no = 1;
$keyword = $_GET['keyword'];
$query = "SELECT * FROM mahasiswa WHERE 
nama LIKE '%$keyword%' OR 
nim LIKE '%$keyword%' OR 
jurusan LIKE '%$keyword%' OR 
email LIKE '%$keyword%'";
$mahasiswa = query($query);
?>
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