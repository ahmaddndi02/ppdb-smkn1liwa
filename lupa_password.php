<?php
require_once 'config/database.php';

$error = '';
$success = '';
$reset_link = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    
    if (empty($email)) {
        $error = "Email wajib diisi!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Buat token reset password (berlaku 1 jam)
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
            $stmt->execute([$token, $expires, $email]);
            
            // Link reset password
            $reset_link = "http://localhost/PPDB/reset_password.php?token=" . $token;
            
            $success = "Link reset password telah dibuat. Klik link di bawah untuk reset password.";
        } else {
            $error = "Email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif;min-height:100vh;display:flex;align-items:center}
        .card-custom{background:#fff;border-radius:20px;padding:35px;box-shadow:0 10px 30px rgba(0,0,0,0.1);max-width:500px;margin:auto}
        .logo{text-align:center;margin-bottom:20px}
        .logo img{height:70px;margin-bottom:10px}
        .btn-submit{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:12px;border-radius:50px;width:100%;border:none}
        .reset-link-box{background:#f0f2f5;padding:15px;border-radius:10px;margin-top:15px;word-break:break-all}
    </style>
</head>
<body>
<div class="container">
    <div class="card-custom">
        <div class="logo"><img src="assets/img/logo.jpg" alt="Logo"><h3>Lupa Password</h3><p>Masukkan email Anda untuk reset password</p></div>
        <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <?php if($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <div class="reset-link-box">
                <strong>Link Reset Password:</strong><br>
                <a href="<?= $reset_link ?>" target="_blank"><?= $reset_link ?></a>
            </div>
        <?php endif; ?>
        <form method="POST"><div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div><button type="submit" class="btn-submit"><i class="fas fa-envelope me-2"></i> Kirim Link Reset</button></form>
        <hr><p class="text-center"><a href="login.php">← Kembali ke Login</a></p>
    </div>
</div>
</body>
</html>