<?php
require_once 'config/database.php';
session_start();

$stmt = $pdo->query("SELECT * FROM pengaturan WHERE id = 1");
$setting = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB - SMK N 1 LIWA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
        }

        .navbar-brand span {
            font-weight: 700;
            font-size: 20px;
            color: #0d47a1;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #0d47a1;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #f39c12;
        }

        .btn-nav {
            background: #0d47a1;
            color: white !important;
            padding: 8px 20px;
            border-radius: 25px;
        }

        .btn-nav:hover {
            background: #f39c12;
        }

        /* Hero Section */
        .hero {
            min-height: 85vh;
            display: flex;
            align-items: center;
            padding: 60px 0;
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero h1 span {
            color: #f39c12;
        }

        .hero p {
            font-size: 18px;
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: #f39c12;
            color: #0d47a1;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #fff;
            transform: translateY(-3px);
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-outline:hover {
            background: white;
            color: #0d47a1;
            transform: translateY(-3px);
        }

        .hero-image {
            text-align: center;
        }

        .hero-image img {
            max-width: 100%;
            border-radius: 20px;
        }

        /* BOX LINK PENDAFTARAN (SEPERTI SNBP) */
        .box-pendaftaran {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .box-pendaftaran p {
            color: #333;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .link-pendaftaran {
            display: inline-block;
            background: linear-gradient(135deg, #0d47a1, #1e5f4b);
            color: white;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .link-pendaftaran:hover {
            transform: scale(1.02);
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .link-pendaftaran i {
            margin-right: 10px;
        }

        .box-small {
            margin-top: 15px;
            font-size: 12px;
            color: #888;
        }

        /* Info Link Bawah */
        .info-link {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }

        .info-link p {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }

        .info-link a {
            color: #f39c12;
            text-decoration: none;
        }

        .info-link a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background: rgba(0,0,0,0.3);
            text-align: center;
            padding: 25px;
            color: rgba(255,255,255,0.7);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .hero .container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .hero h1 {
                font-size: 32px;
            }
            .btn-group {
                justify-content: center;
            }
            .navbar .container {
                flex-direction: column;
                gap: 15px;
            }
            .box-pendaftaran {
                padding: 20px;
            }
            .link-pendaftaran {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA" onerror="this.src='https://placehold.co/45x45?text=SMK'">
            <span>SMK N 1 LIWA</span>
        </a>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="portal.php">Portal</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php" class="btn-nav">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php" class="btn-nav">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Raih Masa Depanmu di <span>SMK N 1 LIWA</span></h1>
            <p>
                Bergabunglah dengan calon siswa lainnya yang telah mewujudkan impian mereka. 
                Akses informasi lengkap dan lakukan pendaftaran untuk memasuki sekolah impianmu.
            </p>
            <div class="btn-group">
                <a href="register.php" class="btn-primary">
                    <i class="fas fa-user-plus me-2"></i> Mulai Pendaftaran
                </a>
                <a href="login.php" class="btn-outline">
                    <i class="fas fa-sign-in-alt me-2"></i> Sudah punya akun? Masuk
                </a>
            </div>

            <!-- BOX LINK PENDAFTARAN SEPERTI SNBP (BISA DIKLIK) -->
            <div class="box-pendaftaran">
                <p><strong>📢 Baca pengumuman terbaru dan informasi penting di Portal PPDB</strong></p>
                <p>Untuk mengakses laman pendaftaran, kunjungi:</p>
                <a href="register.php" class="link-pendaftaran">
                    <i class="fas fa-arrow-right"></i> Daftar Sekarang →
                </a>
                <div class="box-small">
                    <i class="fas fa-mouse-pointer"></i> Klik tombol di atas untuk langsung menuju halaman pendaftaran
                </div>
            </div>

            <div class="info-link">
                <p>
                    <i class="fas fa-bell me-2"></i> Baca pengumuman terbaru dan informasi penting di 
                    <a href="portal.php">Portal PPDB</a>
                </p>
            </div>
        </div>
        <div class="hero-image">
            <img src="assets/img/karakter-siswa.png" alt="Karakter Siswa" onerror="this.style.display='none'">
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div class="container">
        <p>&copy; <?= date('Y') ?> SMK N 1 LIWA - Penerimaan Peserta Didik Baru</p>
        <small><?= nl2br(htmlspecialchars($setting['alamat_sekolah'] ?? 'Jl. Pendidikan No. 1, Liwa, Lampung Barat')) ?></small>
    </div>
</div>

</body>
</html>