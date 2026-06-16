<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Terkini - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
        .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
        .navbar-brand{display:flex;align-items:center;gap:12px;font-weight:bold;font-size:22px;color:#0d47a1;text-decoration:none}
        .navbar-brand img{height:45px;width:auto;border-radius:50%;object-fit:cover}
        .news-card{background:#fff;border-radius:20px;padding:30px;margin:20px 0;box-shadow:0 10px 30px rgba(0,0,0,0.1)}
        .news-item{border-bottom:1px solid #eee;padding:20px 0}
        .news-item:last-child{border-bottom:none}
        .news-date{color:#0d47a1;font-size:12px;font-weight:600;margin-bottom:8px}
        .news-title{font-size:18px;font-weight:700;margin-bottom:10px;color:#333}
        .news-excerpt{color:#666;margin-bottom:10px}
        .btn-read{color:#0d47a1;text-decoration:none;font-weight:600}
        .btn-back{background:#6c757d;color:#fff;padding:10px 30px;border-radius:50px;text-decoration:none;display:inline-block}
        .btn-back:hover{background:#5a6268;color:#fff}
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="portal.php">
            <img src="/assets/img/logo.jpg" alt="Logo SMK N 1 LIWA" onerror="this.src='https://placehold.co/45x45?text=SMK'">
            SMK N 1 LIWA
        </a>
        <a href="portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a>
    </div>
</nav>
<div class="container">
    <div class="news-card">
        <h3 class="mb-4" style="color:#0d47a1;"><i class="fas fa-newspaper me-2"></i> Info Terkini PPDB</h3>
        <div class="news-item"><div class="news-date"><i class="far fa-calendar-alt me-1"></i> 28 Mei 2026 | 14:00 WIB</div><div class="news-title">Pengumuman Hasil Seleksi PPDB Gelombang 1</div><div class="news-excerpt">Hasil seleksi PPDB SMK N 1 LIWA gelombang 1 telah diumumkan. Silakan cek dashboard masing-masing untuk melihat hasil seleksi.</div><a href="hasil_seleksi.php" class="btn-read">Baca Selengkapnya →</a></div>
        <div class="news-item"><div class="news-date"><i class="far fa-calendar-alt me-1"></i> 25 Mei 2026 | 09:30 WIB</div><div class="news-title">Jadwal Ujian Masuk Gelombang 2</div><div class="news-excerpt">Ujian masuk gelombang 2 akan dilaksanakan pada tanggal 5-7 Juni 2026. Persiapkan diri Anda dengan baik.</div><a href="jadwal_ppdb.php" class="btn-read">Lihat Jadwal →</a></div>
        <div class="news-item"><div class="news-date"><i class="far fa-calendar-alt me-1"></i> 20 Mei 2026 | 10:00 WIB</div><div class="news-title">Info Terbaru: Perpanjangan Masa Pendaftaran</div><div class="news-excerpt">Masa pendaftaran PPDB diperpanjang hingga 10 Juni 2026. Segera daftarkan diri Anda!</div><a href="pendaftaran/daftar.php" class="btn-read">Daftar Sekarang →</a></div>
        <div class="news-item"><div class="news-date"><i class="far fa-calendar-alt me-1"></i> 15 Mei 2026 | 08:00 WIB</div><div class="news-title">Pembukaan Pendaftaran PPDB Gelombang 2</div><div class="news-excerpt">Pendaftaran PPDB gelombang 2 telah dibuka. Kuota terbatas, segera daftar!</div><a href="pendaftaran/daftar.php" class="btn-read">Daftar Sekarang →</a></div>
        <div class="text-center mt-4"><a href="portal.php" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Kembali ke Portal</a></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>