<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyCare - Katalog Alat</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f8f9fa;
            --card: #ffffff;
            --blue: #48cae4;
            --text: #333;
            --secondary: #90e0ef;
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
            margin-bottom: 20px;
        }
        .logo-text { font-size: 22px; font-weight: 700; color: #0077b6; }
        .logout-btn { background: #0077b6; color: #fff; padding: 8px 15px; border-radius: 20px; text-decoration: none; font-size: 12px; font-weight: 700; }

        /* BANNER */
        .welcome-card {
            background: linear-gradient(135deg, #00b4d8, #90e0ef);
            padding: 20px;
            border-radius: 20px;
            color: white;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(0,180,216,0.2);
        }

        /* KATALOG ALAT */
        .item-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .item-card {
            background: var(--card);
            border-radius: 20px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .item-img {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
        }

        .item-card b { display: block; font-size: 14px; margin-bottom: 5px; }
        .item-card span { font-size: 12px; color: #777; }
        
        .status-ready { 
            display: inline-block;
            margin-top: 10px;
            font-size: 10px;
            background: #e0fbf1;
            color: #2d6a4f;
            padding: 4px 10px;
            border-radius: 10px;
            font-weight: 700;
        }

        .btn-booking {
            display: block;
            margin-top: 15px;
            background: #caf0f8;
            color: #0077b6;
            text-decoration: none;
            padding: 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="logo-text">BabyCare Store 🧸</div>
        <a href="logout.php" class="logout-btn">Keluar</a>
    </div>

    <div class="welcome-card">
        <h2 style="margin: 0; font-size: 18px;">Halo, Ayah & Bunda! ✨</h2>
        <p style="margin: 5px 0 0; font-size: 13px; opacity: 0.9;">Mau sewa perlengkapan apa hari ini?</p>
    </div>

    <h3 style="font-size: 16px; margin-bottom: 15px;">Katalog Perlengkapan</h3>
    
    <div class="item-grid">
        <div class="item-card">
            <span class="item-img">🛏️</span>
            <b>Baby Box Blue</b>
            <span>Rp 50.000 / Hari</span>
            <div class="status-ready">Tersedia</div>
            <a href="#" class="btn-booking">Hubungi Admin</a>
        </div>

        <div class="item-card">
            <span class="item-img">🛒</span>
            <b>Stroller Ringan</b>
            <span>Rp 35.000 / Hari</span>
            <div class="status-ready">Tersedia</div>
            <a href="#" class="btn-booking">Hubungi Admin</a>
        </div>

        <div class="item-card">
            <span class="item-img">🍼</span>
            <b>Breast Pump</b>
            <span>Rp 25.000 / Hari</span>
            <div class="status-ready">Tersedia</div>
            <a href="#" class="btn-booking">Hubungi Admin</a>
        </div>

        <div class="item-card">
            <span class="item-img">🎠</span>
            <b>Baby Walker</b>
            <span>Rp 20.000 / Hari</span>
            <div class="status-ready">Tersedia</div>
            <a href="#" class="btn-booking">Hubungi Admin</a>
        </div>
    </div>

    <p style="text-align: center; color: #aaa; font-size: 11px; margin-top: 40px;">
        © 2024 <b>Rere BabyCare Hub</b>
    </p>
</div>

</body>
</html>