<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BabyCare Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root { --blue: #a2d2ff; --purple: #b39ddb; --green: #b9fbc0; --bg: #1a1a1a; --card: #262626; }
        body { font-family: 'Quicksand', sans-serif; background: var(--bg); color: white; margin: 0; padding: 20px; text-align: center; }
        .container { max-width: 500px; margin: auto; }
        .menu-card { 
            background: var(--card); border-radius: 30px; padding: 40px 20px; margin-bottom: 20px;
            text-decoration: none; color: white; display: block; transition: 0.3s;
            border: 2px solid transparent;
        }
        .menu-card:hover { border-color: var(--blue); transform: scale(1.02); }
        .icon-circle { width: 70px; height: 70px; background: #003366; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 30px; }
        h3 { margin: 10px 0; font-size: 22px; }
        p { font-size: 14px; color: #888; }
        .logout { color: #ff6b6b; text-decoration: none; font-weight: bold; display: block; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="color: var(--blue);">Welcome BabyCare!🍼</h1>
        
        <a href="tambah_alat.php" class="menu-card">
            <div class="icon-circle" style="background: #1b4332;">➕</div>
            <h3>Tambah Alat</h3>
            <p>Input stok atau perlengkapan bayi baru.</p>
        </a>

        <a href="pinjam.php" class="menu-card">
            <div class="icon-circle">📝</div>
            <h3>Pinjam Alat</h3>
            <p>Pilih Baby Box, Stroller, atau Pompa ASI.</p>
        </a>

        <a href="pengembalian.php" class="menu-card">
            <div class="icon-circle" style="background: #1a0033;">🔄</div>
            <h3>Kembalikan Alat</h3>
            <p>Selesaikan proses pengembalian di sini.</p>
        </a>

        <a href="login.php" class="logout" onclick="return confirm('Keluar dari aplikasi?')">LOGOUT 🚪</a>
    </div>
</body>
</html>