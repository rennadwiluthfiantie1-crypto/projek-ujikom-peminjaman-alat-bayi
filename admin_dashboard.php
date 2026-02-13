<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare Admin - Rere</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0a;
            --card: #161616;
            --blue: #a2d2ff;
            --green: #b9fbc0;
            --purple: #b39ddb;
            --text: #ffffff;
            --danger: #ff6b6b;
            --warning: #ffd166;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 20px;
        }

        .container { max-width: 500px; margin: auto; }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        .logo-text { font-size: 24px; font-weight: 700; color: var(--blue); }
        .owner-name { font-size: 14px; font-weight: 700; color: var(--green); }
        .logout-btn { background: rgba(255, 107, 107, 0.1); color: var(--danger); padding: 8px 12px; border-radius: 10px; text-decoration: none; font-size: 12px; font-weight: 700; border: 1px solid var(--danger); }
        .owner-tag { font-size: 11px; color: #555; margin-bottom: 25px; display: block; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }

        /* PENDAPATAN */
        .income-card {
            background: linear-gradient(135deg, #1a1a1a, #252525);
            padding: 25px;
            border-radius: 30px;
            margin-bottom: 25px;
            border: 1px solid #333;
            text-align: center;
        }
        .income-card h2 { font-size: 32px; margin: 10px 0 0; color: var(--green); }

        /* MENU UTAMA */
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        .menu-item {
            background: var(--card);
            padding: 20px;
            border-radius: 25px;
            text-decoration: none;
            color: white;
            text-align: center;
            border: 1px solid #222;
        }
        .menu-item i { font-size: 30px; display: block; margin-bottom: 10px; }

        /* RIWAYAT & AKSI */
        .history-list { background: var(--card); border-radius: 25px; padding: 5px 15px; }
        .log-row {
            display: flex;
            flex-direction: column;
            padding: 15px 5px;
            border-bottom: 1px solid #222;
            transition: all 0.5s ease; /* Efek transisi saat menghilang */
        }
        .log-row:last-child { border-bottom: none; }
        .log-main { display: flex; justify-content: space-between; align-items: center; }
        .log-info { display: flex; align-items: center; gap: 12px; }
        .log-detail b { display: block; font-size: 15px; }
        .log-detail span { font-size: 12px; color: #777; }

        .action-group { display: flex; gap: 8px; margin-top: 12px; justify-content: flex-end; }
        .btn-action { padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-decoration: none; cursor: pointer; }

        .btn-update { background: rgba(255, 209, 102, 0.1); color: var(--warning); border: 1px solid var(--warning); }
        .btn-delete { background: rgba(255, 107, 107, 0.1); color: var(--danger); border: 1px solid var(--danger); }

        .status-badge { font-size: 9px; padding: 4px 8px; border-radius: 6px; font-weight: 700; }
        .badge-pinjam { background: #003366; color: var(--blue); }
        .badge-kembali { background: #2a1b3d; color: var(--purple); }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo-text">BabyCare Hub 🍼</div>
        <div class="user-profile">
            <span class="owner-name">Hi, Rere! 👋</span>
            <a href="logout.php" class="logout-btn">OUT</a>
        </div>
    </div>
    <span class="owner-tag">Owner Management System</span>

    <div class="income-card">
        <small style="color: var(--blue); font-size: 11px;">TOTAL PENDAPATAN</small>
        <h2>Rp 1.450.000</h2>
    </div>

    <div class="menu-grid">
        <a href="tambah_alat.php" class="menu-item"><i>➕</i><b>Stok Alat</b></a>
        <a href="pinjam.php" class="menu-item"><i>📝</i><b>Pinjam Alat</b></a>
    </div>

    <h3 style="font-size: 16px; margin-bottom: 15px;">Aktivitas Terbaru</h3>
    <div class="history-list">
        
        <div class="log-row" id="data-dwi">
            <div class="log-main">
                <div class="log-info">
                    <span style="font-size: 20px;">👤</span>
                    <div class="log-detail"><b>Dwi</b><span>Pinjam: Baby Box</span></div>
                </div>
                <div class="status-badge badge-pinjam">DIPINJAM</div>
            </div>
            <div class="action-group">
                <a href="pengembalian.php?id=1" class="btn-action btn-update">Update</a>
                <div class="btn-action btn-delete" onclick="hapusSekarang('data-dwi', 'Dwi')">Delete</div>
            </div>
        </div>

        <div class="log-row" id="data-ani">
            <div class="log-main">
                <div class="log-info">
                    <span style="font-size: 20px;">👤</span>
                    <div class="log-detail"><b>Ani</b><span>Kembali: Stroller</span></div>
                </div>
                <div class="status-badge badge-kembali">SELESAI</div>
            </div>
            <div class="action-group">
                <a href="pengembalian.php?id=2" class="btn-action btn-update">Update</a>
                <div class="btn-action btn-delete" onclick="hapusSekarang('data-ani', 'Ani')">Delete</div>
            </div>
        </div>

    </div>

    <p style="text-align: center; color: #333; font-size: 11px; margin-top: 40px;">
        Owner: <b>Rere BabyCare</b>
    </p>
</div>

<script>
function hapusSekarang(idElemen, nama) {
    if (confirm('Yakin ingin menghapus data ' + nama + '?')) {
        var elemen = document.getElementById(idElemen);
        // Efek transisi menghilang
        elemen.style.opacity = '0';
        elemen.style.transform = 'scale(0.8)';
        
        setTimeout(function() {
            elemen.style.display = 'none';
            alert('Data ' + nama + ' terhapus!');
        }, 300);
    }
}
</script>

</body>
</html>