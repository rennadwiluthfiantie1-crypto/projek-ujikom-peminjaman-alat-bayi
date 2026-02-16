<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$u = $_SESSION['user'];
$level = $u['level']; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyRent - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: #1a1a1a; border-bottom: 1px solid #333; }
        .sidebar { background: #1a1a1a; min-height: 100vh; padding: 20px; border-right: 1px solid #333; }
        
        /* CSS agar menu mudah diklik */
        .nav-link { 
            color: #aaa; 
            border-radius: 10px; 
            margin-bottom: 8px; 
            transition: 0.3s; 
            display: block !important; /* Memastikan area klik luas */
            padding: 12px 15px;
        }
        .nav-link:hover { background: #333; color: #fff; }
        .nav-link.active { background: #0d47a1; color: #fff; }
        
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .welcome-gradient { 
            background: linear-gradient(45deg, #0d47a1, #1565c0); 
            border-radius: 15px; padding: 25px; margin-bottom: 25px; 
        }
        .text-blue { color: #448aff; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">🍼 BabyRent</a>
        <div class="d-flex align-items-center">
            <span class="me-3 small">Halo, <strong class="text-blue"><?= $u['nama_lengkap'] ?></strong></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Keluar</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 sidebar">
            <small class="text-muted fw-bold text-uppercase d-block mb-3" style="font-size: 10px; letter-spacing: 1px;">Navigasi Utama</small>
            <div class="nav flex-column">
                <a class="nav-link active" href="dashboard.php">📊 Dashboard</a>
                
                <?php if($level == 'admin'): ?>
                    <a class="nav-link" href="user.php">👥 Data User</a>
                    <a class="nav-link" href="alat.php">🧸 Data Alat</a>
                    <a class="nav-link" href="kategori.php">🏷️ Kategori</a>
                    <a class="nav-link" href="pinjam.php">📝 Peminjaman</a>
                    <a class="nav-link" href="pengembalian.php">🔄 Pengembalian</a>
                    <a class="nav-link" href="log_aktivitas.php">📜 Log Aktivitas</a>
                <?php endif; ?>

                <?php if($level == 'petugas'): ?>
                    <a class="nav-link" href="pinjam.php">✅ Setujui Pinjam</a>
                    <a class="nav-link" href="alat.php">👁️ Pantau Alat</a>
                    <a class="nav-link" href="laporan.php">🖨️ Cetak Laporan</a>
                <?php endif; ?>

                <?php if($level == 'peminjaman'): ?>
                    <a class="nav-link" href="alat.php">🔍 Cari Alat</a>
                    <a class="nav-link" href="pinjam.php">📩 Ajukan Sewa</a>
                    <a class="nav-link" href="pengembalian.php">📤 Kembalikan</a>
                <?php endif; ?>
            </div>
        </nav>

        <main class="col-md-9 col-lg-10 p-4">
            <div class="welcome-gradient shadow text-white">
                <h2 class="fw-bold m-0">Selamat Datang di BabyRent!</h2>
                <p class="m-0 mt-2 opacity-75">Level Akses: <span class="badge bg-light text-dark"><?= strtoupper($level) ?></span></p>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card card-dark p-4 shadow-sm">
                        <h6 class="text-muted small">TOTAL ALAT</h6>
                        <h2 class="fw-bold mt-2 text-white">12 <span class="fs-6 fw-normal">Unit</span></h2>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-dark p-4 shadow-sm border-start border-primary border-4">
                        <h6 class="text-muted small">SEDANG DIPINJAM</h6>
                        <h2 class="fw-bold text-blue mt-2">5 <span class="fs-6 fw-normal text-white">Transaksi</span></h2>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card card-dark p-4 shadow-sm">
                        <h6 class="text-muted small">MEMBER AKTIF</h6>
                        <h2 class="fw-bold mt-2 text-white">3 <span class="fs-6 fw-normal">Orang</span></h2>
                    </div>
                </div>
            </div>

            <div class="card card-dark p-4">
                <h5 class="fw-bold mb-3 text-blue">Informasi Sistem</h5>
                <p class="text-muted mb-0">Halo <strong><?= $u['nama_lengkap'] ?></strong>, anda masuk sebagai <strong><?= strtoupper($level) ?></strong>. Gunakan menu di samping untuk mengelola data BabyRent.</p>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
