<?php
require_once 'config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $no_telepon = trim($_POST['no_telepon']);

    // Validasi
    if (empty($email) || empty($password) || empty($nama_lengkap)) {
        $error = "Semua field wajib diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak sama!";
    } elseif (strlen($password) < 4) {
        $error = "Password minimal 4 karakter!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        // Cek email sudah terdaftar
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Email sudah terdaftar! Silakan gunakan email lain.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password, nama_lengkap, no_telepon) VALUES (?, ?, ?, ?)");
            
            if ($stmt->execute([$email, $hashed_password, $nama_lengkap, $no_telepon])) {
                $success = "Akun berhasil dibuat! Silakan login.";
                $_POST = [];
            } else {
                $error = "Gagal mendaftar, silakan coba lagi.";
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
    <title>Daftar Akun - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: auto;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            height: 70px;
            width: auto;
            margin-bottom: 10px;
        }
        .logo h3 {
            color: #0d47a1;
            margin: 0;
            font-weight: bold;
        }
        .logo p {
            color: #6c757d;
            margin-top: 5px;
        }
        .btn-register {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            padding: 12px;
            border-radius: 50px;
            font-weight: bold;
            border: none;
            width: 100%;
            transition: 0.3s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
        }
        .btn-login {
            background: transparent;
            border: 2px solid #0d47a1;
            color: #0d47a1;
            padding: 10px;
            border-radius: 50px;
            font-weight: bold;
            width: 100%;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #0d47a1;
            color: white;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .required:after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="register-card">
        <div class="logo">
            <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA">
            <h3>SMK N 1 LIWA</h3>
            <p>Buat akun untuk mengakses Portal PPDB</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?= $success ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label required">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                <small class="text-muted">Gunakan email aktif untuk login</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label required">Password</label>
                <input type="password" name="password" class="form-control" required>
                <small class="text-muted">Minimal 4 karakter</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label required">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label required">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '') ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nomor Telepon / WhatsApp</label>
                <input type="text" name="no_telepon" class="form-control" value="<?= htmlspecialchars($_POST['no_telepon'] ?? '') ?>">
            </div>
            
            <button type="submit" class="btn-register mb-3">
                <i class="fas fa-user-plus me-2"></i> Daftar Akun
            </button>
        </form>
        
        <hr>
        
        <p class="text-center mb-2">Sudah punya akun?</p>
        <a href="login.php" class="btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> Login Sekarang
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>