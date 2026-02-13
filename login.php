<?php
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM crud_user WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['crud_user'] = $username;
        echo "<script>alert('Login Berhasil!'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - peminjaman_alat_bayi</title>
</head>
<body>
    <div style="margin-top: 100px; text-align: center;">
        <h2>Login Admin</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <button type="submit" name="login">Masuk</button>
        </form>
    </div>
</body>
</html>