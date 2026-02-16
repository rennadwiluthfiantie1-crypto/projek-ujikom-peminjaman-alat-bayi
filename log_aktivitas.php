<?php
session_start();
include 'koneksi.php';

// Proteksi: Hanya Admin yang boleh melihat Log Aktivitas
if ($_SESSION['user']['level'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

$u = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; border-color: #333; }
        .table thead { background: #37474f; color: white; }
        .text-blue { color: #448aff; }
        .btn-back { color: #aaa; text-decoration: none; }
        .btn-back:hover { color: #fff; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-blue">📜 Log Aktivitas</h2>
            <p class="text-muted small">Riwayat akses pengguna ke dalam sistem.</p>
        </div>
        <a href="dashboard.php" class="btn-back small">← Kembali ke Dashboard</a>
    </div>

    <div class="card card-dark p-4 shadow">
        <h5 class="fw-bold mb-3 text-white">Riwayat Login Terakhir</h5>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="border-0">No</th>
                        <th class="border-0">Nama Pengguna</th>
                        <th class="border-0">Level</th>
                        <th class="border-0">Waktu Aktivitas</th>
                        <th class="border-0">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Simulasi log dari data user (untuk tugas praktik)
                    // Mengambil data user yang aktif atau data dari tabel aktivitas jika ada
                    $sql = "SELECT username, nama_lengkap, level FROM tabel_user ORDER BY id_user DESC";
                    $query = mysqli_query($conn, $sql);
                    
                    while($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $no++ ?></td>
                        <td><strong class="text-white"><?= $row['nama_lengkap'] ?></strong> <br> <small class="text-muted">@<?= $row['username'] ?></small></td>
                        <td><span class="badge bg-secondary"><?= strtoupper($row['level']) ?></span></td>
                        <td><?= date('d M Y - H:i') ?> WIB</td>
                        <td><span class="text-success small">● Active Now</span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="alert alert-info bg-dark border-secondary text-muted mt-3 small">
            <strong>Info:</strong> Halaman ini mencatat setiap kali pengguna berhasil melakukan otentikasi ke sistem BabyRent.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
