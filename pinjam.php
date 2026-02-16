<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$u = $_SESSION['user'];
$level = $u['level'];
$id_log_user = $u['id_user'];

// --- LOGIKA SIMPAN PEMINJAMAN ---
if (isset($_POST['proses_pinjam'])) {
    $id_user_pinjam = ($level == 'admin') ? $_POST['id_user'] : $id_log_user;
    $id_alat = $_POST['id_alat'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $status = "Dipinjam";

    // 1. Cek stok dulu apakah masih ada
    $cek_stok = mysqli_query($conn, "SELECT stok FROM tabel_alat WHERE id_alat='$id_alat'");
    $s = mysqli_fetch_assoc($cek_stok);

    if ($s['stok'] > 0) {
        // 2. Insert ke tabel peminjaman
        $insert = mysqli_query($conn, "INSERT INTO tabel_peminjaman (id_user, id_alat, tgl_pinjam, status) VALUES ('$id_user_pinjam', '$id_alat', '$tgl_pinjam', '$status')");
        
        if ($insert) {
            // 3. Kurangi stok alat secara otomatis
            mysqli_query($conn, "UPDATE tabel_alat SET stok = stok - 1 WHERE id_alat = '$id_alat'");
            echo "<script>alert('Berhasil Pinjam!'); window.location='pinjam.php';</script>";
        }
    } else {
        echo "<script>alert('Maaf, Stok Alat Habis!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Peminjaman - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; border-color: #333; }
        .table thead { background: #0d47a1; color: white; }
        .form-control, .form-select { background: #2a2a2a; border: 1px solid #444; color: #fff; }
        .modal-content { background: #1e1e1e; color: #fff; border: 1px solid #333; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📤 Transaksi Peminjaman</h2>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm">← Dashboard</a>
    </div>

    <div class="card card-dark p-4 shadow mb-4">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="fw-bold">Riwayat Peminjaman</h5>
            <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalPinjam">+ Pinjam Alat</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT p.*, u.nama_lengkap, a.nama_alat 
                            FROM tabel_peminjaman p
                            JOIN tabel_user u ON p.id_user = u.id_user
                            JOIN tabel_alat a ON p.id_alat = a.id_alat";
                    
                    if($level == 'peminjaman') $sql .= " WHERE p.id_user = '$id_log_user'";
                    
                    $q = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($q)) {
                    ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td class="text-info"><?= $row['nama_alat'] ?></td>
                        <td><?= date('d M Y', strtotime($row['tgl_pinjam'])) ?></td>
                        <td><span class="badge bg-warning text-dark"><?= $row['status'] ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPinjam" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Form Peminjaman Alat</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if($level == 'admin'): ?>
                <div class="mb-3">
                    <label class="small text-muted">Pilih User (Admin Mode)</label>
                    <select name="id_user" class="form-select" required>
                        <?php
                        $u_query = mysqli_query($conn, "SELECT * FROM tabel_user WHERE level='peminjaman'");
                        while($user_row = mysqli_fetch_assoc($u_query)) {
                            echo "<option value='{$user_row['id_user']}'>{$user_row['nama_lengkap']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="small text-muted">Alat yang Dipinjam</label>
                    <select name="id_alat" class="form-select" required>
                        <?php
                        $a_query = mysqli_query($conn, "SELECT * FROM tabel_alat WHERE stok > 0");
                        while($alat_row = mysqli_fetch_assoc($a_query)) {
                            echo "<option value='{$alat_row['id_alat']}'>{$alat_row['nama_alat']} (Stok: {$alat_row['stok']})</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="small text-muted">Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="submit" name="proses_pinjam" class="btn btn-primary px-4">Konfirmasi Pinjam</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
