<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="login-box">
    <h2>LOGIN</h2>
    <p>Masuk ke Sistem</p>

    <form action="../process/proses_login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="links">
        <a href="register.php">Belum punya akun? Register</a>
        <a href="../index.php">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>