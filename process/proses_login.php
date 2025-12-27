<?php
session_start();
require_once "../classes/User.php";

$user = new User();
$data = $user->login($_POST['username'], $_POST['password']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Proses Login</title>
<link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="result-box">

<?php if ($data): ?>
<?php
    $_SESSION['username'] = $data['username'];
    $_SESSION['level']    = $data['level'];

    // 🔥 REDIRECT: Jika dari products, balik ke products. Selain itu ke index
    if (isset($_SESSION['redirect_after_login'])) {
        $redirect = "../" . $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
    } else {
        // Default: semua user (admin dan biasa) kembali ke index
        $redirect = "../index.php";
    }

    header("refresh:2;url=$redirect");
?>
<div class="success">Login Berhasil ✅</div>
<p>Mengalihkan halaman...</p>

<?php else: ?>
<div class="error">Login Gagal ❌</div>
<p>Username atau password salah</p>
<a href="../auth/login.php">Kembali</a>
<?php endif; ?>

</div>
</body>
</html>