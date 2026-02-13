<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Alat - BabyCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #121212;
            --card: #1e1e1e;
            --input: #2c2c2c;
            --purple: #b39ddb;
            --text: #ffffff;
            --text-dim: #888;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .box {
            background: var(--card);
            padding: 30px;
            border-radius: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            border-top: 8px solid var(--purple);
        }

        h2 { text-align: center; margin-bottom: 25px; color: var(--purple); }

        .form-group { margin-bottom: 15px; text-align: left; }
        
        label { 
            display: block; 
            font-size: 13px; 
            color: var(--text-dim); 
            margin-bottom: 5px; 
            margin-left: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: var(--input);
            color: white;
            font-family: 'Quicksand';
            box-sizing: border-box;
            outline: none;
        }

        textarea { resize: none; height: 80px; }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--purple);
            color: #1a0033;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-submit:hover { opacity: 0.9; transform: scale(1.02); }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Pengembalian 🔄</h2>
    
    <form action="dashboard.php" method="POST">
        <div class="form-group">
            <label>Nama Peminjam (Tulis Nama)</label>
            <input type="text" name="nama" placeholder="Contoh: Bunda Shinta" required>
        </div>

        <div class="form-group">
            <label>Alat yang Dikembalikan</label>
            <select name="alat">
                <option>Baby Box</option>
                <option>Stroller</option>
                <option>Pompa ASI</option>
                <option>Car Seat Bayi</option>
                <option>Timbangan Bayi</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <div class="form-group" style="flex: 1;">
                <label>Tgl Pinjam</label>
                <input type="date" name="tgl_pinjam" required>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Tgl Kembali</label>
                <input type="date" name="tgl_kembali" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Deskripsi Kondisi / Alasan</label>
            <textarea name="deskripsi" placeholder="Contoh: Barang mulus, atau Ada lecet sedikit di bagian roda..."></textarea>
        </div>

        <button type="submit" class="btn-submit" onclick="alert('Proses Pengembalian Berhasil!')">SELESAIKAN</button>
        
        <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
    </form>
</div>

</body>
</html>