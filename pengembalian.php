<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$u = $_SESSION['user'];
$level = $u['level'];

// --- LOGIKA PROSES PENGEMBALIAN ---
if (isset($_GET['id_pinjam'])) {
    $id_p = $_GET['id_pinjam'];
    $id_a = $_GET['id_alat'];
    $tgl_kembali = date('Y-m-d');

    // 1. Update status jadi 'Kembali' dan isi tanggal kembali
    $upd = mysqli_query($conn, "UPDATE tabel_peminjaman SET status='Kembali', tgl_kembali='$tgl_kembali' WHERE id_peminjaman='$id_p'");

    if ($upd) {
        // 2. Tambahkan stok alat kembali (+1)
        mysqli_query($conn, "UPDATE tabel_alat SET stok = stok + 1 WHERE id_alat = '$id_a'");
        echo "<script>alert('Alat Berhasil Dikembalikan!'); window.location='kembali.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; border-color: #333; }
        .table thead { background: #2e7d32; color: white; } /* Hijau untuk pengembalian */
        .btn-back { color: #aaa; text-decoration: none; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">🔄 Pengembalian Alat</h2>
        <a href="dashboard.php" class="btn-back small">← Dashboard</a>
    </div>

    <div class="card card-dark p-4 shadow">
        <h5 class="fw-bold mb-3">Daftar Alat yang Masih Dipinjam</h5>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Alat</th>
                        <th>Tgl Pinjam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Hanya tampilkan yang statusnya 'Dipinjam'
                    $sql = "SELECT p.*, u.nama_lengkap, a.nama_alat 
                            FROM tabel_peminjaman p
                            JOIN tabel_user u ON p.id_user = u.id_user
                            JOIN tabel_alat a ON p.id_alat = a.id_alat
                            WHERE p.status = 'Dipinjam'";
                    
                    if($level == 'peminjaman') {
                        $id_u = $u['id_user'];
                        $sql .= " AND p.id_user = '$id_u'";
                    }

                    $query = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($query) == 0) {
                        echo "<tr><td colspan='5' class='text-center text-muted'>Tidak ada alat yang perlu dikembalikan.</td></tr>";
                    }

                    while($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td class="text-info"><?= $row['nama_alat'] ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tgl_pinjam'])) ?></td>
                        <td>
                            <a href="?id_pinjam=<?= $row['id_peminjaman'] ?>&id_alat=<?= $row['id_alat'] ?>" 
                               class="btn btn-success btn-sm px-3" 
                               onclick="return confirm('Apakah alat sudah dicek dan benar dikembalikan?')">
                               Proses Kembali
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
