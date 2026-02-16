<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Menggunakan nama 'tabel_user' sesuai screenshot kamu
    $query = mysqli_query($conn, "SELECT * FROM tabel_user WHERE username='$username'");
    
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        
        // Cek password (mendukung teks biasa untuk tes awal)
        if ($password == $data['password'] || password_verify($password, $data['password'])) {
            $_SESSION['user'] = $data;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BabyRent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 380px; width: 100%; }
        .btn-primary { background: #007bff; border: none; border-radius: 8px; padding: 10px; }
    </style>
</head>
<body>
    <div class="card login-card p-4 mx-3">
        <h3 class="text-center fw-bold mb-1">BabyRent 🍼</h3>
        <p class="text-center text-muted mb-4 small">Aplikasi Peminjaman Alat Bayi</p>
        
        <?php if($error): ?>
            <div class="alert alert-danger py-2 small text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 fw-bold">LOGIN</button>
        </form>
    </div>
</body>
</html>
