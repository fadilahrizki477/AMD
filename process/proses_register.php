<?php
require_once "../classes/User.php";

$user = new User();
$status = $user->register($_POST['username'], $_POST['password']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="result-box">

<?php if ($status): ?>
    <div class="success">Registrasi Berhasil ✅</div>
    <p>Akun kamu sudah dibuat.<br>Silakan login untuk masuk ke sistem.</p>
    <a href="../auth/login.php">Login Sekarang</a>

<?php else: ?>
    <div class="error">Registrasi Gagal ❌</div>
    <p>Username sudah digunakan.<br>Silakan gunakan username lain.</p>
    <a href="../auth/register.php">Kembali ke Register</a>
<?php endif; ?>

</div>

</body>
</html>