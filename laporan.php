<?php
session_start();
include 'koneksi.php';

// Proteksi: Hanya Admin dan Petugas yang bisa cetak laporan
if ($_SESSION['user']['level'] == 'peminjaman') {
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
    <title>Laporan Peminjaman - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tampilan di Layar (Dark Mode) */
        body { background-color: #121212; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; }
        .card-dark { background: #1e1e1e; border: 1px solid #333; border-radius: 15px; }
        .table { color: #e0e0e0; border-color: #333; }
        
        /* Tampilan saat dicetak (Putih Bersih) */
        @media print {
            body { background-color: white; color: black; }
            .no-print, .btn-back { display: none !important; }
            .card-dark { background: white; border: none; box-shadow: none; }
            .table { color: black; border: 1px solid #000; }
            .table thead { background: #eee !important; color: black !important; }
        }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h2 class="fw-bold text-info">🖨️ Laporan Peminjaman</h2>
        <div>
            <button onclick="window.print()" class="btn btn-info btn-sm px-4 fw-bold">CETAK LAPORAN</button>
            <a href="dashboard.php" class="ms-2 btn btn-outline-light btn-sm">Kembali</a>
        </div>
    </div>

    <div class="card card-dark p-5 shadow">
        <div class="text-center mb-4">
            <h2 class="fw-bold m-0">BABYRENT 🍼</h2>
            <p class="m-0">Laporan Data Peminjaman Alat Bayi</p>
            <hr style="border: 2px solid #555;">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Alat</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT p.*, u.nama_lengkap, a.nama_alat 
                            FROM tabel_peminjaman p
                            JOIN tabel_user u ON p.id_user = u.id_user
                            JOIN tabel_alat a ON p.id_alat = a.id_alat
                            ORDER BY p.tgl_pinjam DESC";
                    
                    $query = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td><?= $row['nama_alat'] ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($row['tgl_pinjam'])) ?></td>
                        <td class="text-center">
                            <?= ($row['tgl_kembali']) ? date('d/m/Y', strtotime($row['tgl_kembali'])) : '-' ?>
                        </td>
                        <td class="text-center">
                            <strong><?= strtoupper($row['status']) ?></strong>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5 d-flex justify-content-end text-center">
            <div>
                <p class="mb-5">Dicetak pada: <?= date('d F Y') ?></p>
                <br>
                <p class="fw-bold">( <u><?= $u['nama_lengkap'] ?></u> )</p>
                <p class="small text-muted">Petugas Operasional</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
