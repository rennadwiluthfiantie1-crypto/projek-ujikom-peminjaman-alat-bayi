<?php
$h = "127.0.0.1";
$s = "root";
$p = "root";
$db = "peminjaman_alat_bayi";

$koneksi = mysqli_connect($h, $s, $p, $db);

if (!$koneksi) {
  die("Koneksi gagal: ".mysqli_connect_error());
}