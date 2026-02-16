<?php
session_start();
include 'koneksi.php';

// Proteksi: Hanya Admin yang bisa mengelola kategori
if ($_SESSION['user']['level'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

// Logika Tambah Kategori
if (isset($_POST['tambah'])) {
    $nama_kategori = $_POST['nama_kategori'];
    mysqli_query($conn, "INSERT INTO tabel_kategori (nama_kategori) VALUES ('$nama_kategori')");
    header("Location: kategori.php");
}

// Logika Hapus Kategori
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM tabel_kategori WHERE id_kategori='$id'");
    header("Location: kategori.php");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Alat - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; border-color: #333; }
        .table thead { background: #0d47a1; color: white; }
        .btn-back { color: #aaa; text-decoration: none; }
        .btn-back:hover { color: #fff; }
        .modal-content { background: #1e1e1e; color: #fff; border: 1px solid #333; }
        .form-control { background: #2a2a2a; border: 1px solid #444; color: #fff; }
        .form-control:focus { background: #333; color: #fff; border-color: #0d47a1; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-warning">🏷️ Kategori Alat</h2>
            <p class="text-muted small">Kelompokkan alat bayi agar mudah dicari.</p>
        </div>
        <a href="dashboard.php" class="btn-back small">← Kembali ke Dashboard</a>
    </div>

    <div class="card card-dark p-4 shadow">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="fw-bold">Daftar Kategori</h5>
            <button class="btn btn-warning btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Kategori Baru</button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="border-0" width="10%">No</th>
                        <th class="border-0">Nama Kategori</th>
                        <th class="border-0 text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($conn, "SELECT * FROM tabel_kategori");
                    while($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr style="border-bottom: 1px solid #333;">
                        <td><?= $no++ ?></td>
                        <td><span class="text-warning">#</span> <?= $row['nama_kategori'] ?></td>
                        <td class="text-center">
                            <a href="?hapus=<?= $row['id_kategori'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus kategori ini? Alat dengan kategori ini mungkin akan terpengaruh.')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header border-bottom border-secondary">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small text-muted">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Perlengkapan Tidur" required>
                </div>
            </div>
            <div class="modal-footer border-top border-secondary">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="tambah" class="btn btn-warning btn-sm fw-bold">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
