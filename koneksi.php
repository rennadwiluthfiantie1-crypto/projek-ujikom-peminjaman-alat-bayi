<?php
$host = "127.0.0.1";
$user = "root";
$db   = "peminjaman_alat_bayi";

// Coba tanpa password (standar)
$conn = @mysqli_connect($host, $user, "", $db);

// Jika gagal, coba dengan password 'root' (sering terjadi di A-Web Server)
if (!$conn) {
    $conn = @mysqli_connect($host, $user, "root", $db);
}

// Jika masih gagal, pakai localhost biasa
if (!$conn) {
    $conn = @mysqli_connect("localhost", $user, "", $db);
}

if (!$conn) {
    die("Koneksi Gagal Total: " . mysqli_connect_error());
}
?>
