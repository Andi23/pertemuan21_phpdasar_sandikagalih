<?php

use Mpdf\Tag\Tr;

require 'function.php';
require_once __DIR__ . '/vendor/autoload.php';
$no = 1;
$mahasiswa = query("SELECT * FROM mahasiswa");

$mpdf = new \Mpdf\Mpdf();
$html = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/print.css">
        <title>Daftar Mahasiswa</title>
        </head>
        <body>
        <h1>Daftar Mahasiswa</h1>
        <table border="1" cellspacing="0" cellpadding="10">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                    </tr>';
foreach ($mahasiswa as $mhs) {
    $html .= '<tr>
            <td> ' . $no++ . ' </td>
            <td> <img src="img/' . $mhs["gambar"] . '" width="50px" height="50px"></td>
            <td> ' . $mhs["nim"] . '</td>
            <td> ' . $mhs["nama"] . '</td>
            <td> ' . $mhs["email"] . '</td>
            <td> ' . $mhs["jurusan"] . '</td>
            </tr>';
}

$html .=     '</table>
        </body>

      
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', 'I'); // = inline .. D = Download
