<?php
// Menghubungkan dengan koneksi
include 'koneksi.php';

session_start();

$id = $_SESSION['customer_id'];
$new_password = ($_POST['password']);

mysqli_query($koneksi,"UPDATE customer SET customer_password='$new_password' WHERE customer_id='$id'");

header("location:customer_password.php?alert=sukses");
?>