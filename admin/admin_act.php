<?php
include '../koneksi.php'; // Sesuaikan dengan nama file koneksi Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password untuk keamanan
    $foto = $_FILES['foto'];

    // Cek apakah file foto sudah diupload
    if ($foto['error'] === 0) {
        $namaFoto = $foto['name'];
        $tmpFoto = $foto['tmp_name'];
        $folderFoto = '../gambar/user/'; // Sesuaikan dengan folder penyimpanan foto Anda

        // Pindahkan foto ke folder tujuan
        move_uploaded_file($tmpFoto, $folderFoto . $namaFoto);
    } else {
        // Jika foto tidak diupload, atur namaFoto menjadi string kosong atau sesuai dengan foto default
        $namaFoto = ''; // Sesuaikan dengan foto default yang ada di folder 'gambar/user/'
    }

    // Query SQL untuk menambahkan admin ke database
    $query = "INSERT INTO admin (admin_nama, admin_username, admin_password, admin_foto) VALUES ('$nama', '$username', '$password', '$namaFoto')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Admin berhasil ditambahkan');</script>";
        echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // Redirect sesuai kebutuhan
    } else {
        echo "<script>alert('Gagal menambahkan admin');</script>";
        echo "<meta http-equiv='refresh' content='0;url=index.php'>"; // Redirect sesuai kebutuhan
    }
} else {
    echo "Akses tidak diizinkan"; // Redirect atau berikan pesan kesalahan sesuai kebutuhan
}

