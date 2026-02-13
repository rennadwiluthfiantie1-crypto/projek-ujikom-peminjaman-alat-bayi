<?php
session_start();
session_destroy(); // Menghapus semua data login
header("Location: login.php"); // Arahkan kembali ke halaman login
exit();
?>