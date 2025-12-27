<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="register-box">
    <h2>REGISTER</h2>
    <p>Buat akun baru</p>

    <form action="../process/proses_register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>

    <div class="links">
        <a href="login.php">Sudah punya akun? Login</a>
        <a href="../index.php">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>