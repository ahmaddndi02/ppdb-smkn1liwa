<?php
require_once 'config/database.php';

$error = '';
$success = '';

$token = $_GET['token'] ?? '';

if (empty($token)) {
    header("Location: lupa_password.php");
    exit;
}

// Cek token valid dan belum kadaluarsa (dengan debug)
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();

// Debug: cek apakah token ditemukan
if (!$user) {
    $error = "Token tidak valid! Silakan ulangi proses lupa password.";
} else {
    // Cek apakah token sudah kadaluarsa
    $now = new DateTime();
    $expires = new DateTime($user['reset_expires']);
    
    if ($expires < $now) {
        $error = "Token sudah kadaluarsa! Silakan ulangi proses lupa password. (Kadaluarsa pada: " . $user['reset_expires'] . ")";
        // Hapus token yang kadaluarsa
        $stmt = $pdo->prepare("UPDATE users SET reset_token = NULL, reset_expires = NULL WHERE id = ?");
        $stmt->execute([$user['id']]);
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            
            if (strlen($password) < 4) {
                $error = "Password minimal 4 karakter!";
            } elseif ($password !== $confirm_password) {
                $error = "Password dan konfirmasi password tidak sama!";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
                $stmt->execute([$hashed_password, $user['id']]);
                $success = "Password berhasil direset! Silakan login dengan password baru Anda.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif;min-height:100vh;display:flex;align-items:center}
        .reset-card{background:#fff;border-radius:20px;padding:35px;box-shadow:0 10px 30px rgba(0,0,0,0.1);max-width:450px;margin:auto}
        .logo{text-align:center;margin-bottom:20px}
        .logo img{height:70px;margin-bottom:10px}
        .btn-reset{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:12px;border-radius:50px;width:100%;border:none}
        .btn-login{background:transparent;border:2px solid #0d47a1;color:#0d47a1;padding:10px;border-radius:50px;width:100%;text-decoration:none;display:inline-block;text-align:center}
        .btn-login:hover{background:#0d47a1;color:#fff}
    </style>
</head>
<body>
<div class="container">
    <div class="reset-card">
        <div class="logo"><img src="assets/img/logo.jpg" alt="Logo"><h3>Reset Password</h3></div>
        <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <?php if($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <div class="text-center mt-3"><a href="login.php" class="btn-login"><i class="fas fa-sign-in-alt me-2"></i> Login Sekarang</a></div>
        <?php endif; ?>
        <?php if(!$success && !$error && $user && $expires >= $now): ?>
            <form method="POST">
                <div class="mb-3"><label>Password Baru</label><input type="password" name="password" class="form-control" required><small class="text-muted">Minimal 4 karakter</small></div>
                <div class="mb-3"><label>Konfirmasi Password</label><input type="password" name="confirm_password" class="form-control" required></div>
                <button type="submit" class="btn-reset"><i class="fas fa-key me-2"></i> Reset Password</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>