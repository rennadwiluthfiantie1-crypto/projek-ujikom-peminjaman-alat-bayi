<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pinjam Alat</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background: #1a1a1a; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: #262626; padding: 40px; border-radius: 30px; width: 380px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); }
        h2 { color: #a2d2ff; text-align: center; margin-top: 0; }
        label { display: block; margin-top: 10px; font-size: 13px; color: #888; margin-left: 5px; }
        input, select { width: 100%; padding: 12px; margin: 8px 0; border-radius: 12px; border: none; background: #333; color: white; box-sizing: border-box; font-family: 'Quicksand', sans-serif; }
        .btn { width: 100%; background: #a2d2ff; color: #003366; border: none; padding: 15px; border-radius: 12px; font-weight: bold; cursor: pointer; margin-top: 20px; font-size: 16px; transition: 0.3s; }
        .btn:hover { background: #8bc2f0; transform: scale(1.02); }
        .cancel-link { display: block; text-align: center; margin-top: 15px; color: #ff6b6b; text-decoration: none; font-size: 14px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Pinjam Alat 📝</h2>
        <form action="dashboard.php" method="POST">
            <label>Nama Peminjam</label>
            <input type="text" name="nama_peminjam" placeholder="Masukkan nama Bunda / Ayah" required>
            
            <label>Tanggal Peminjaman</label>
            <input type="date" name="tgl_pinjam" value="<?php echo date('Y-m-d'); ?>">
            
            <label>Pilih Alat & Harga</label>
            <select name="alat_dipilih">
                <option value="Baby Box">Baby Box - Rp 45.000</option>
                <option value="Stroller">Stroller - Rp 60.000</option>
                <option value="Pompa ASI">Pompa ASI - Rp 35.000</option>
                <option value="Car Seat Bayi">Car Seat Bayi - Rp 50.000</option>
                <option value="Timbangan Bayi">Timbangan Bayi - Rp 20.000</option>
            </select>

            <button type="submit" class="btn" onclick="alert('Berhasil Pinjam! Data telah disimpan.')">KONFIRMASI PINJAM</button>
            <a href="dashboard.php" class="cancel-link">Batal & Kembali</a>
        </form>
    </div>
</body>
</html>