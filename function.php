<?php
$conn = mysqli_connect("localhost", "root", "", "phpdasar");



function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{

    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $email = htmlspecialchars($data['email']);
    $gambar = upload();
    // jalankan upload gambar
    if (!$gambar) {
        return false;
    }

    //jika tidak sesuai maka mengembalikan nilai false

    $query = "INSERT INTO mahasiswa SET
            id = '',
            nim = '$nim',
            nama = '$nama',
            email = '$email',
            jurusan ='$jurusan',
            gambar = '$gambar'
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function upload()
{
    //struktur fungsi $_FILES  [GAMBAR][[]];
    //1tangkap data..nama,,ukuran,,,eror,,namafoldersementara..
    //kemudian periksa apakah tidak ada gambar yg diupload?
    //kemudian periksa apakah yg diupload adalah gambar
    //cek ukuran gambar
    //jika lolos..generate nama baru(unix)
    //tambah kan pemisah
    //kemudian upload
    //kembalikan namagambarbaru


    $namaFile = $_FILES['gambar']['name']; //nama file berserta ekstensi
    $ukuranGambar = $_FILES['gambar']['size']; //ukuran gambar
    $error = $_FILES['gambar']['error']; //error
    $tmpName = $_FILES['gambar']['tmp_name']; //nama tempat penyimpanan sementara gambar

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "
        <script>
        alert('Gambar Wajib Diupload');
        </script>
        ";
        return false;
    }


    $ekstensiGambarValid = ['png', 'jpg', 'jpeg']; //ekstensi file yg boleh diupload
    $ekstensiGambar = explode('.', $namaFile); //memisahkan nama file dan ekstensi dalam bentuk array
    $ekstensiGambar = strtolower(end($ekstensiGambar)); //mengambil ekstensi gambar [gambar],[png] > [png] + mengubah menjadi hurufkecil

    //cek apakah yg diupload adalah gambar?
    //parameter pertama yang diupload user ,,kedua ekstensi yg boleh diupload
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
        alert('yg anda upload bukan GAMBAR !');
        </script>
        ";
        return false;
    }

    // cek ukuran file
    if ($ukuranGambar > 1000000) {
        echo "
        <script>
        alert('Ukuran terlalu Besar !');
        </script>
        ";
        return false;
    }

    $namaGambarBaru = uniqid(); //jika lolos semua diatas,,, upload generate nama baru (random)
    $namaGambarBaru .= '.'; //pemisah .(hubungkan pemisah dan ekstensi)
    $namaGambarBaru .= $ekstensiGambar; //.+nama ekstensi gambar

    //parameter pertama penyimapanan sementara ,kedua pemyimpana baru + gabung nama file
    move_uploaded_file($tmpName, 'img/' . $namaGambarBaru);

    //kembalikan nilai gambar baru
    return $namaGambarBaru;
}

function hapus($id)
{
    global $conn;
    $query = "DELETE FROM mahasiswa WHERE id ='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function ubah($data)
{
    global $conn;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarLama = $data['gambarLama'];

    // cek apakah user upload gambar ?

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
        nim = '$nim',
        nama = '$nama',
        jurusan = '$jurusan',
        gambar = '$gambar',
        email = '$email' WHERE id = '$id'
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE 
    nama LIKE '%$keyword%' OR 
    nim LIKE '%$keyword%' OR 
    jurusan LIKE '%$keyword%' OR 
    email LIKE '%$keyword%'";
    return query($query);
}


function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    //cek apakag username sudah ada
    $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($query)) {
        echo "
        <script>
        alert('Username Sudah Digunakan!');
        </>
        ";
        return false;
    }
    //cek apakah password sesuai?
    if ($password !== $password2) {
        echo "
        <script>
        alert('Konfirmasi Password Tidak Sesuai!');
        </script>
        ";
        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user values ('','$username','$password')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}
