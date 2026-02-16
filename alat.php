<?php
session_start();
include 'koneksi.php';

// Proteksi Login
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$u = $_SESSION['user'];
$lv = $u['level']; // admin, petugas, atau peminjaman

// --- LOGIKA CRUD (Hanya Admin) ---
if ($lv == 'admin') {
    // 1. Tambah Alat
    if (isset($_POST['tambah'])) {
        $nama = $_POST['nama_alat'];
        $kat = $_POST['id_kategori'];
        $stok = $_POST['stok'];
        mysqli_query($conn, "INSERT INTO tabel_alat (nama_alat, id_kategori, stok) VALUES ('$nama', '$kat', '$stok')");
        header("Location: alat.php");
    }
    // 2. Edit Alat (Proses Update)
    if (isset($_POST['edit'])) {
        $id = $_POST['id_alat'];
        $nama = $_POST['nama_alat'];
        $kat = $_POST['id_kategori'];
        $stok = $_POST['stok'];
        mysqli_query($conn, "UPDATE tabel_alat SET nama_alat='$nama', id_kategori='$kat', stok='$stok' WHERE id_alat='$id'");
        header("Location: alat.php");
    }
    // 3. Hapus Alat
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        mysqli_query($conn, "DELETE FROM tabel_alat WHERE id_alat='$id'");
        header("Location: alat.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Alat - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; border-color: #333; }
        .table thead { background: #0d47a1; color: white; }
        .modal-content { background: #1e1e1e; color: #fff; border: 1px solid #333; }
        .form-control, .form-select { background: #2a2a2a; border: 1px solid #444; color: #fff; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="fw-bold text-primary">🧸 Manajemen Alat</h2>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>

    <div class="card card-dark p-4 shadow">
        <div class="d-flex justify-content-between mb-3">
            <h5 class="fw-bold">Daftar Stok Barang</h5>
            <?php if($lv == 'admin'): ?>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Alat</button>
            <?php endif; ?>
        </div>
        
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <?php if($lv == 'admin'): ?> <th class="text-center">Aksi</th> <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = "SELECT tabel_alat.*, tabel_kategori.nama_kategori 
                        FROM tabel_alat 
                        LEFT JOIN tabel_kategori ON tabel_alat.id_kategori = tabel_kategori.id_kategori";
                $q = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($q)) {
                ?>
                <tr style="border-bottom: 1px solid #333;">
                    <td><?= $no++ ?></td>
                    <td class="text-white"><?= $row['nama_alat'] ?></td>
                    <td class="text-info"><?= $row['nama_kategori'] ?? '-' ?></td>
                    <td><span class="badge bg-secondary"><?= $row['stok'] ?> Unit</span></td>
                    
                    <?php if($lv == 'admin'): ?>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_alat'] ?>">Edit</button>
                        <a href="?hapus=<?= $row['id_alat'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus alat ini?')">Hapus</a>
                    </td>
                    <?php endif; ?>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id_alat'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" class="modal-content">
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title">Edit Data Alat</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_alat" value="<?= $row['id_alat'] ?>">
                                <div class="mb-3">
                                    <label class="small text-muted">Nama Alat</label>
                                    <input type="text" name="nama_alat" class="form-control" value="<?= $row['nama_alat'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted">Kategori</label>
                                    <select name="id_kategori" class="form-select">
                                        <?php
                                        $k_query = mysqli_query($conn, "SELECT * FROM tabel_kategori");
                                        while($k = mysqli_fetch_assoc($k_query)) {
                                            $s = ($k['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                                            echo "<option value='{$k['id_kategori']}' $s>{$k['nama_kategori']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted">Stok</label>
                                    <input type="number" name="stok" class="form-control" value="<?= $row['stok'] ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="submit" name="edit" class="btn btn-warning">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" class="modal-content">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-primary">Tambah Alat Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" name="nama_alat" class="form-control" placeholder="Nama Alat Bayi" required>
                </div>
                <div class="mb-3">
                    <select name="id_kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $kat_q = mysqli_query($conn, "SELECT * FROM tabel_kategori");
                        while($k = mysqli_fetch_assoc($kat_q)) {
                            echo "<option value='{$k['id_kategori']}'>{$k['nama_kategori']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="number" name="stok" class="form-control" placeholder="Jumlah Stok" required>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="submit" name="tambah" class="btn btn-primary">Simpan Alat</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
