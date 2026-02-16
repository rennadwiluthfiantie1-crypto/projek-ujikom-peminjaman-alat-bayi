<?php
// Memulai session
session_start();

// Menghapus semua data session yang tersimpan (seperti user_id, nama, level)
session_unset();

// Menghancurkan session secara total
session_destroy();

// Mengarahkan kembali pengguna ke halaman login dengan pesan sukses
echo "<script>
    alert('Anda telah berhasil keluar dari sistem.');
    window.location='login.php';
</script>";
exit();
?>
