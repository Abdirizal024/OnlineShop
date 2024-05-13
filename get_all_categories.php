<?php
// Sisipkan file koneksi ke database jika diperlukan
include "koneksi.php";

// Ambil semua kategori dari database
$data = mysqli_query($koneksi, "SELECT * FROM kategori");

// Buat daftar HTML untuk semua kategori
$category_list_html = '';
while($d = mysqli_fetch_array($data)){
    $category_list_html .= '<li><a href="produk_kategori.php?id='.$d['kategori_id'].'">'.$d['kategori_nama'].'</a></li>';
}

// Kembalikan daftar kategori HTML
echo $category_list_html;
?>
