<?php
// 1. Hubungkan ke database
include 'koneksi.php';

// 2. Ambil ID dari URL (id yang dikirim saat tombol diklik)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Jalankan perintah hapus
    // Ganti 'peminjaman' dengan nama tabel database kamu yang menyimpan data Dwi/Ani
    $query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id = '$id'");

    // 4. Cek apakah berhasil
    if ($query) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'admin_dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location.href = 'admin_dashboard.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, balikkan ke dashboard
    header("Location: admin_dashboard.php");
}
?>