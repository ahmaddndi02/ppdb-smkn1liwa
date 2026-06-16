<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Login - SMK N 1 LIWA</title>
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
        .choice-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            margin: auto;
        }
        .logo {
            margin-bottom: 30px;
        }
        .logo img {
            height: 80px;
            width: auto;
            margin-bottom: 10px;
        }
        .logo h3 {
            color: #0d47a1;
            margin: 0;
        }
        .btn-siswa {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            padding: 15px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
            display: block;
            margin-bottom: 15px;
            transition: 0.3s;
        }
        .btn-siswa:hover {
            transform: translateY(-3px);
            color: white;
        }
        .btn-admin {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: white;
            padding: 15px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }
        .btn-admin:hover {
            transform: translateY(-3px);
            color: white;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            color: #6c757d;
            text-decoration: none;
        }
        .back-link:hover {
            color: #0d47a1;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="choice-card">
        <div class="logo">
            <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA">
            <h3>SMK N 1 LIWA</h3>
            <p class="text-muted">Pilih jenis login</p>
        </div>
        
        <a href="login.php" class="btn-siswa">
            <i class="fas fa-user-graduate me-2"></i> Login sebagai Siswa
        </a>
        
        <a href="admin_login.php" class="btn-admin">
            <i class="fas fa-user-shield me-2"></i> Login sebagai Admin
        </a>
        
        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>
</body>
</html>