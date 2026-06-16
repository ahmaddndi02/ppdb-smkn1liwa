<?php
session_start();
require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    if ($role == 'admin') {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_nama'] = $user['nama_lengkap'];
            $_SESSION['role'] = 'admin';
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Email atau password admin salah!";
        }
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = 'pendaftar';
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Email atau password pendaftar salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - PPDB SMK N 1 Liwa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }
        .login-card {
            max-width: 450px;
            width: 100%;
            background: white;
            border-radius: 24px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #0d47a1;
            padding: 5px;
            background: white;
            object-fit: cover;
        }
        h2 { color: #0d47a1; margin-bottom: 5px; }
        .subtitle {
            color: #666;
            font-size: 13px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f39c12;
            display: inline-block;
        }
        .role-selector {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            background: #f0f2f5;
            padding: 5px;
            border-radius: 50px;
        }
        .role-option {
            flex: 1;
            text-align: center;
            padding: 10px;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 600;
        }
        .role-option.active {
            background: #0d47a1;
            color: white;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 14px;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #0d47a1, #1e5f4b);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-login:hover { background: #f39c12; }
        .register-link { margin-top: 20px; font-size: 14px; }
        .register-link a { color: #0d47a1; text-decoration: none; }
        .alert {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-size: 13px;
        }
        .back-link:hover { color: #0d47a1; }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="https://ppdb-smkn1liwa.rf.gd/assets/img/logo.jpg" class="logo" alt="Logo" onerror="this.src='https://placehold.co/80x80?text=SMK'">
        <h2>SMK N 1 LIWA</h2>
        <div class="subtitle">Penerimaan Peserta Didik Baru 2026</div>

        <?php if($error): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="role-selector" id="roleSelector">
                <div class="role-option <?= (!isset($_POST['role']) || $_POST['role'] == 'pendaftar') ? 'active' : '' ?>" data-role="pendaftar">Pendaftar</div>
                <div class="role-option <?= (isset($_POST['role']) && $_POST['role'] == 'admin') ? 'active' : '' ?>" data-role="admin">Admin</div>
            </div>
            <input type="hidden" name="role" id="roleInput" value="<?= isset($_POST['role']) ? $_POST['role'] : 'pendaftar' ?>">

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Kata sandi" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
            <div class="register-link">
                Belum punya akun? <a href="register.php">Daftar sekarang</a>
            </div>
            <a href="index.php" class="back-link">← Kembali ke Halaman Utama</a>
        </form>
    </div>
    <script>
        const options = document.querySelectorAll('.role-option');
        const roleInput = document.getElementById('roleInput');
        options.forEach(opt => {
            opt.addEventListener('click', function() {
                options.forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                roleInput.value = this.getAttribute('data-role');
            });
        });
    </script>
</body>
</html>