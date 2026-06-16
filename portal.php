<?php
require_once 'config/database.php';

// Jika belum login, redirect ke pilihan login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_choice.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM pengaturan WHERE id = 1");
$setting = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
        }
        .sidebar .logo-sidebar {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        .sidebar .logo-sidebar img {
            height: 60px;
            width: auto;
            margin-bottom: 8px;
        }
        .sidebar .logo-sidebar h5 {
            color: #0d47a1;
            margin: 0;
            font-size: 14px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin-bottom: 10px;
        }
        .sidebar a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #0d47a1;
            color: white;
        }
        .sidebar a i {
            width: 25px;
        }
        .main-content {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .news-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: 0.3s;
        }
        .news-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background: #0d47a1;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: #1976d2;
            color: white;
        }
        .info-card {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 12px 0;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 20px;
            color: #0d47a1;
            text-decoration: none;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .feature-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            transition: 0.3s;
            border: 1px solid #e9ecef;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        .feature-icon i {
            font-size: 24px;
            color: white;
        }
        .feature-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #0d47a1;
        }
        footer {
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
        }
        .search-box {
            background: #f0f2f5;
            border: none;
            border-radius: 30px;
            padding: 8px 20px;
            width: 250px;
        }
        @media (max-width: 768px) {
            .sidebar {
                margin-bottom: 20px;
                position: relative;
                top: 0;
            }
            .search-box {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar Atas -->
<nav class="top-navbar">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <a class="navbar-brand" href="portal.php">
                <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA">
                SMK N 1 LIWA
            </a>
            
            <div class="d-flex flex-wrap align-items-center gap-3">
                <div class="position-relative">
                    <i class="fas fa-search position-absolute" style="left: 15px; top: 9px; color: #999; font-size: 13px;"></i>
                    <input type="text" class="search-box" placeholder="Search ..." style="padding-left: 40px;">
                </div>
                
                <span class="text-muted">Halo, <?= htmlspecialchars($_SESSION['user_nama']) ?></span>
                <a href="dashboard.php" class="btn btn-outline-primary btn-sm rounded-pill">
                    <i class="fas fa-tachometer-alt"></i> Dashboard Saya
                </a>
                <a href="logout.php" class="btn btn-danger btn-sm rounded-pill">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <!-- Sidebar Kiri dengan Logo -->
        <div class="col-md-3 mb-4">
            <div class="sidebar">
                <div class="logo-sidebar">
                    <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA">
                    <h5>SMK N 1 LIWA</h5>
                </div>
                <h5 class="mb-3">Menu PPDB</h5>
                <ul>
                    <li><a href="portal.php"><i class="fas fa-home"></i> Beranda Portal</a></li>
                    <li><a href="pendaftaran/daftar.php"><i class="fas fa-edit"></i> Formulir Pendaftaran</a></li>
                    <li><a href="upload_berkas.php"><i class="fas fa-upload"></i> Upload Berkas</a></li>
                    <li><a href="hasil_seleksi.php"><i class="fas fa-file-alt"></i> Hasil Seleksi</a></li>
                    <li><a href="dashboard.php"><i class="fas fa-print"></i> Cetak Bukti</a></li>
                    <li><a href="jadwal_ppdb.php"><i class="fas fa-calendar-alt"></i> Jadwal PPDB</a></li>
                    <li><a href="unduhan.php"><i class="fas fa-download"></i> Unduhan Formulir</a></li>
                    <li><a href="info_terkini.php"><i class="fas fa-newspaper"></i> Info Terkini</a></li>
                    <li><a href="faq.php"><i class="fas fa-question-circle"></i> FAQ & Bantuan</a></li>
                </ul>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="col-md-9">
            <div class="main-content">
                <h4 class="mb-3"><i class="fas fa-info-circle me-2"></i> Info Terkini PPDB</h4>

                <!-- Info Banner -->
                <div class="info-card">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h5 class="mb-1">Pendaftaran PPDB Gelombang 2</h5>
                    <p class="mb-0">Pendaftaran dibuka hingga 30 Juni 2026. Segera daftarkan diri Anda!</p>
                </div>

                <!-- Fitur Cepat -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="fas fa-edit"></i></div>
                            <div class="feature-title">Pendaftaran</div>
                            <small class="text-muted">Isi formulir pendaftaran online</small>
                            <div class="mt-2"><a href="pendaftaran/daftar.php" class="btn-custom btn-sm">Daftar</a></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="fas fa-upload"></i></div>
                            <div class="feature-title">Upload Berkas</div>
                            <small class="text-muted">Upload foto, ijazah, KK</small>
                            <div class="mt-2"><a href="upload_berkas.php" class="btn-custom btn-sm">Upload</a></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon"><i class="fas fa-search"></i></div>
                            <div class="feature-title">Cek Status</div>
                            <small class="text-muted">Lihat status pendaftaran Anda</small>
                            <div class="mt-2"><a href="hasil_seleksi.php" class="btn-custom btn-sm">Cek</a></div>
                        </div>
                    </div>
                </div>

                <!-- Pengumuman Terbaru -->
                <h5 class="mb-3"><i class="fas fa-newspaper me-2"></i> Pengumuman Terbaru</h5>
                
                <div class="news-card">
                    <small class="text-primary"><i class="far fa-calendar-alt me-1"></i> 28 Mei 2026</small>
                    <h6 class="mt-1">Pengumuman Hasil Seleksi PPDB Gelombang 1</h6>
                    <p class="text-muted small">Hasil seleksi PPDB SMK N 1 LIWA gelombang 1 telah diumumkan. Silakan cek dashboard masing-masing.</p>
                    <a href="hasil_seleksi.php" class="text-primary">Baca Selengkapnya →</a>
                </div>

                <div class="news-card">
                    <small class="text-primary"><i class="far fa-calendar-alt me-1"></i> 25 Mei 2026</small>
                    <h6 class="mt-1">Jadwal Ujian Masuk Gelombang 2</h6>
                    <p class="text-muted small">Ujian masuk gelombang 2 akan dilaksanakan pada tanggal 5-7 Juni 2026. Persiapkan diri Anda dengan baik.</p>
                    <a href="jadwal_ppdb.php" class="text-primary">Lihat Jadwal →</a>
                </div>

                <div class="news-card">
                    <small class="text-primary"><i class="far fa-calendar-alt me-1"></i> 20 Mei 2026</small>
                    <h6 class="mt-1">Info Terbaru: Perpanjangan Masa Pendaftaran</h6>
                    <p class="text-muted small">Masa pendaftaran PPDB diperpanjang hingga 10 Juni 2026. Segera daftarkan diri Anda!</p>
                    <a href="pendaftaran/daftar.php" class="text-primary">Daftar Sekarang →</a>
                </div>

                <!-- Tombol Unduhan -->
                <div class="mt-3">
                    <a href="unduhan.php" class="btn-custom"><i class="fas fa-download me-1"></i> Unduh Panduan PPDB</a>
                    <a href="unduhan.php" class="btn-custom ms-2"><i class="fas fa-download me-1"></i> Unduh Formulir Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <p class="mb-0">&copy; <?= date('Y') ?> SMK N 1 LIWA - Penerimaan Peserta Didik Baru</p>
        <small><?= nl2br(htmlspecialchars($setting['alamat_sekolah'] ?? 'Jl. Pendidikan No. 1, Liwa, Lampung Barat')) ?></small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>