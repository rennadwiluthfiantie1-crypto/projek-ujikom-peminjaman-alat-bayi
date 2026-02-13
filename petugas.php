<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare Petugas - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0a;
            --card: #161616;
            --blue: #a2d2ff;
            --green: #b9fbc0;
            --purple: #b39ddb;
            --text: #ffffff;
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
        .logo-text { font-size: 24px; font-weight: 700; color: var(--purple); }
        .owner-name { font-size: 14px; font-weight: 700; color: var(--blue); }
        .logout-btn { background: rgba(255, 255, 255, 0.1); color: #fff; padding: 8px 12px; border-radius: 10px; text-decoration: none; font-size: 12px; font-weight: 700; border: 1px solid #333; }
        .owner-tag { font-size: 11px; color: #555; margin-bottom: 25px; display: block; font-weight: 700; }

        /* MENU PETUGAS */
        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        .menu-item {
            background: var(--card);
            padding: 25px;
            border-radius: 25px;
            text-decoration: none;
            color: white;
            text-align: center;
            border: 1px solid #222;
        }
        .menu-item i { font-size: 30px; display: block; margin-bottom: 10px; }

        /* LIST AKTIVITAS */
        .history-list { background: var(--card); border-radius: 25px; padding: 5px 15px; }
        .log-row {
            display: flex;
            flex-direction: column;
            padding: 15px 5px;
            border-bottom: 1px solid #222;
        }
        .log-row:last-child { border-bottom: none; }
        .log-main { display: flex; justify-content: space-between; align-items: center; }
        .log-info { display: flex; align-items: center; gap: 12px; }
        .log-detail b { display: block; font-size: 15px; }
        .log-detail span { font-size: 12px; color: #777; }

        .action-group { display: flex; gap: 8px; margin-top: 12px; justify-content: flex-end; }
        .btn-action { padding: 8px 20px; border-radius: 8px; font-size: 12px; font-weight: 700; text-decoration: none; }

        /* Hanya ada tombol Update (Pengembalian) */
        .btn-update { background: rgba(255, 209, 102, 0.1); color: var(--warning); border: 1px solid var(--warning); width: 100%; text-align: center; }

        .status-badge { font-size: 9px; padding: 4px 8px; border-radius: 6px; font-weight: 700; }
        .badge-pinjam { background: #003366; color: var(--blue); }
        .badge-kembali { background: #2a1b3d; color: var(--purple); }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo-text">BabyCare Staff 🛠️</div>
        <div class="user-profile">
            <span class="owner-name">Halo, Petugas!</span>
            <a href="logout.php" class="logout-btn">OUT</a>
        </div>
    </div>
    <span class="owner-tag">Staff Operational System</span>

    <div class="menu-grid">
        <a href="pinjam.php" class="menu-item" style="grid-column: span 2;">
            <i>📝</i>
            <b>Input Peminjaman Baru</b>
        </a>
    </div>

    <h3 style="font-size: 16px; margin-bottom: 15px;">Daftar Pinjaman Aktif</h3>
    <div class="history-list">
        
        <div class="log-row">
            <div class="log-main">
                <div class="log-info">
                    <span style="font-size: 20px;">👤</span>
                    <div class="log-detail">
                        <b>Dwi</b>
                        <span>Alat: Baby Box</span>
                    </div>
                </div>
                <div class="status-badge badge-pinjam">DIPINJAM</div>
            </div>
            <div class="action-group">
                <a href="pengembalian.php?id=1" class="btn-action btn-update">Proses Pengembalian</a>
            </div>
        </div>

        <div class="log-row">
            <div class="log-main">
                <div class="log-info">
                    <span style="font-size: 20px;">👤</span>
                    <div class="log-detail">
                        <b>Ani</b>
                        <span>Alat: Stroller</span>
                    </div>
                </div>
                <div class="status-badge badge-kembali">SELESAI</div>
            </div>
            <div class="action-group">
                <span style="color: #444; font-size: 11px;">Data sudah dikunci</span>
            </div>
        </div>

    </div>

    <p style="text-align: center; color: #333; font-size: 11px; margin-top: 40px;">
        Petugas: <b>BabyCare Hub</b>
    </p>
</div>

</body>
</html>