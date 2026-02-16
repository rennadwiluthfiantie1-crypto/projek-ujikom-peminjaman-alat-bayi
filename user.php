<?php
session_start();
include 'koneksi.php';

if ($_SESSION['user']['level'] != 'admin') { header("Location: dashboard.php"); exit(); }

// 1. LOGIKA TAMBAH USER
if (isset($_POST['tambah'])) {
    $un = $_POST['username'];
    $ps = $_POST['password']; // Simpel sesuai permintaan awal
    $nl = $_POST['nama_lengkap'];
    $lv = $_POST['level'];
    mysqli_query($conn, "INSERT INTO tabel_user (username, password, nama_lengkap, level) VALUES ('$un', '$ps', '$nl', '$lv')");
    header("Location: user.php");
}

// 2. LOGIKA EDIT USER
if (isset($_POST['edit'])) {
    $id = $_POST['id_user'];
    $un = $_POST['username'];
    $ps = $_POST['password'];
    $nl = $_POST['nama_lengkap'];
    $lv = $_POST['level'];
    mysqli_query($conn, "UPDATE tabel_user SET username='$un', password='$ps', nama_lengkap='$nl', level='$lv' WHERE id_user='$id'");
    header("Location: user.php");
}

// 3. LOGIKA HAPUS USER
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM tabel_user WHERE id_user='$id'");
    header("Location: user.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; }
        .modal-content { background: #1e1e1e; color: #fff; border: 1px solid #333; }
        .form-control, .form-select { background: #2a2a2a; border: 1px solid #444; color: #fff; }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="fw-bold text-primary">👥 Manajemen User</h2>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>

    <div class="card card-dark p-4 shadow">
        <div class="d-flex justify-content-between mb-3">
            <h5>Daftar Pengguna</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah User</button>
        </div>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $q = mysqli_query($conn, "SELECT * FROM tabel_user");
                while($row = mysqli_fetch_assoc($q)) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
                    <td><span class="badge bg-info text-dark"><?= strtoupper($row['level']) ?></span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit<?= $row['id_user'] ?>">Edit</button>
                        
                        <a href="?hapus=<?= $row['id_user'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin?')">Hapus</a>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id_user'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" class="modal-content">
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                                <div class="mb-3">
                                    <label class="small text-muted">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted">Password</label>
                                    <input type="text" name="password" class="form-control" value="<?= $row['password'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $row['nama_lengkap'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small text-muted">Level</label>
                                    <select name="level" class="form-select">
                                        <option value="admin" <?= $row['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="petugas" <?= $row['level'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                                        <option value="peminjaman" <?= $row['level'] == 'peminjaman' ? 'selected' : '' ?>>Peminjam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="submit" name="edit" class="btn btn-warning">Update Data</button>
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
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <select name="level" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="peminjaman">Peminjam</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-secondary">
                <button type="submit" name="tambah" class="btn btn-primary">Simpan User</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
