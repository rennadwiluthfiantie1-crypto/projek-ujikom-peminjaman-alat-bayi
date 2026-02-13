<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Stok Alat - BabyCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #121212;
            --card: #1e1e1e;
            --blue: #a2d2ff;
            --text-dim: #888;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: var(--bg);
            color: white;
            margin: 0; padding: 20px;
            display: flex; justify-content: center;
        }

        .container { width: 100%; max-width: 450px; text-align: center; }

        h2 { margin-bottom: 25px; color: var(--blue); }

        /* Style Tabel Stok yang Simpel */
        .stok-container {
            background: var(--card);
            border-radius: 25px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 10px;
            border-bottom: 1px solid #333;
        }

        .item-row:last-child { border-bottom: none; }

        .info-kiri { text-align: left; }
        .nama-alat { font-weight: 700; font-size: 16px; display: block; }
        .harga-alat { font-size: 12px; color: var(--text-dim); }

        .info-kanan { text-align: right; }
        .stok-angka { 
            background: #003366; 
            color: var(--blue); 
            padding: 5px 12px; 
            border-radius: 10px; 
            font-weight: 700; 
            font-size: 14px;
        }

        /* Tombol Aksi */
        .btn-pinjam {
            display: block;
            background: var(--blue);
            color: #003366;
            text-decoration: none;
            padding: 18px;
            border-radius: 20px;
            font-weight: 700;
            margin-top: 30px;
            font-size: 16px;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Ketersediaan Alat 📦</h2>

    <div class="stok-container">
        <div class="item-row">
            <div class="info-kiri">
                <span class="nama-alat">Baby Box</span>
                <span class="harga-alat">Rp 45.000 / Hari</span>
            </div>
            <div class="info-kanan">
                <span class="stok-angka">5 Tersedia</span>
            </div>
        </div>

        <div class="item-row">
            <div class="info-kiri">
                <span class="nama-alat">Stroller</span>
                <span class="harga-alat">Rp 60.000 / Hari</span>
            </div>
            <div class="info-kanan">
                <span class="stok-angka">4 Tersedia</span>
            </div>
        </div>

        <div class="item-row">
            <div class="info-kiri">
                <span class="nama-alat">Pompa ASI</span>
                <span class="harga-alat">Rp 35.000 / Hari</span>
            </div>
            <div class="info-kanan">
                <span class="stok-angka">7 Tersedia</span>
            </div>
        </div>

        <div class="item-row">
            <div class="info-kiri">
                <span class="nama-alat">Car Seat Bayi</span>
                <span class="harga-alat">Rp 50.000 / Hari</span>
            </div>
            <div class="info-kanan">
                <span class="stok-angka">3 Tersedia</span>
            </div>
        </div>

        <div class="item-row">
            <div class="info-kiri">
                <span class="nama-alat">Timbangan Bayi</span>
                <span class="harga-alat">Rp 20.000 / Hari</span>
            </div>
            <div class="info-kanan">
                <span class="stok-angka">6 Tersedia</span>
            </div>
        </div>
    </div>

    <a href="pinjam.php" class="btn-pinjam">PINJAM ALAT SEKARANG 📝</a>
    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
</div>

</body>
</html>