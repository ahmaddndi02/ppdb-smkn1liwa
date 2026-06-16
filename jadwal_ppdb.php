<?php require_once 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal PPDB - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
        .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
        .navbar-brand{display:flex;align-items:center;gap:12px;font-weight:bold;font-size:22px;color:#0d47a1;text-decoration:none}
        .navbar-brand img{height:45px;width:auto;border-radius:50%;object-fit:cover}
        .schedule-card{background:#fff;border-radius:20px;padding:30px;margin:20px 0;box-shadow:0 10px 30px rgba(0,0,0,0.1)}
        .schedule-title{text-align:center;margin-bottom:30px}
        .schedule-title h3{color:#0d47a1;font-weight:700}
        .schedule-title p{color:#6c757d}
        .timeline{position:relative;padding-left:30px}
        .timeline:before{content:'';position:absolute;left:10px;top:0;bottom:0;width:2px;background:linear-gradient(135deg,#0d47a1,#1976d2)}
        .timeline-item{position:relative;margin-bottom:25px;padding-left:25px}
        .timeline-dot{position:absolute;left:-25px;top:5px;width:14px;height:14px;border-radius:50%;background:#0d47a1;border:2px solid white;box-shadow:0 0 0 2px #0d47a1}
        .timeline-date{font-weight:700;color:#0d47a1;margin-bottom:5px}
        .timeline-event{font-weight:600;font-size:16px;margin-bottom:3px}
        .timeline-desc{color:#6c757d;font-size:14px}
        .status-badge{display:inline-block;padding:3px 12px;border-radius:20px;font-size:12px;font-weight:600;margin-top:5px}
        .status-selesai{background:#d4edda;color:#155724}
        .status-berlangsung{background:#fff3cd;color:#856404}
        .status-datang{background:#d1ecf1;color:#0c5460}
        .btn-back{background:#6c757d;color:#fff;padding:10px 30px;border-radius:50px;text-decoration:none;display:inline-block;transition:0.3s}
        .btn-back:hover{background:#5a6268;color:#fff}
        .info-card{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:20px;border-radius:15px;margin-top:30px}
        .info-card a{color:#fff;text-decoration:underline}
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="portal.php">
            <img src="https://ppdb-smkn1liwa.rf.gd/assets/img/logo.jpg" alt="Logo SMK N 1 LIWA" style="height:45px; width:auto; border-radius:50%; object-fit:cover;" onerror="this.src='https://placehold.co/45x45?text=SMK'">
            SMK N 1 LIWA
        </a>
        <a href="portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a>
    </div>
</nav>

<div class="container">
    <div class="schedule-card">
        <div class="schedule-title">
            <h3><i class="fas fa-calendar-alt me-2"></i> Jadwal PPDB 2026</h3>
            <p>SMK N 1 LIWA - Tahun Ajaran 2026/2027</p>
        </div>

        <div class="timeline">
            <!-- Gelombang 1 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 1 - 15 Mei 2026</div>
                <div class="timeline-event">Pendaftaran Gelombang 1</div>
                <div class="timeline-desc">Pendaftaran online melalui website PPDB</div>
                <span class="status-badge status-selesai"><i class="fas fa-check-circle me-1"></i> Selesai</span>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 20 - 22 Mei 2026</div>
                <div class="timeline-event">Ujian Masuk Gelombang 1</div>
                <div class="timeline-desc">Ujian tulis dan praktik di sekolah</div>
                <span class="status-badge status-selesai"><i class="fas fa-check-circle me-1"></i> Selesai</span>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 28 Mei 2026</div>
                <div class="timeline-event">Pengumuman Hasil Seleksi Gelombang 1</div>
                <div class="timeline-desc">Pengumuman melalui website dan dashboard siswa</div>
                <span class="status-badge status-selesai"><i class="fas fa-check-circle me-1"></i> Selesai</span>
            </div>

            <!-- Gelombang 2 -->
            <div class="timeline-item">
                <div class="timeline-dot" style="background: #ffc107; box-shadow:0 0 0 2px #ffc107;"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 1 - 30 Juni 2026</div>
                <div class="timeline-event">Pendaftaran Gelombang 2</div>
                <div class="timeline-desc">Pendaftaran online melalui website PPDB</div>
                <span class="status-badge status-berlangsung"><i class="fas fa-clock me-1"></i> Berlangsung</span>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 5 - 7 Juni 2026</div>
                <div class="timeline-event">Ujian Masuk Gelombang 2</div>
                <div class="timeline-desc">Ujian tulis dan praktik di sekolah</div>
                <span class="status-badge status-datang"><i class="fas fa-hourglass-half me-1"></i> Akan Datang</span>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 10 Juni 2026</div>
                <div class="timeline-event">Pengumuman Hasil Seleksi Gelombang 2</div>
                <div class="timeline-desc">Pengumuman melalui website dan dashboard siswa</div>
                <span class="status-badge status-datang"><i class="fas fa-hourglass-half me-1"></i> Akan Datang</span>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 12 - 15 Juni 2026</div>
                <div class="timeline-event">Daftar Ulang Siswa Baru</div>
                <div class="timeline-desc">Membawa berkas asli ke sekolah untuk verifikasi</div>
                <span class="status-badge status-datang"><i class="fas fa-hourglass-half me-1"></i> Akan Datang</span>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date"><i class="far fa-calendar-alt me-1"></i> 15 Juli 2026</div>
                <div class="timeline-event">Hari Pertama Masuk Sekolah</div>
                <div class="timeline-desc">Pengenalan lingkungan sekolah (MPLS)</div>
                <span class="status-badge status-datang"><i class="fas fa-hourglass-half me-1"></i> Akan Datang</span>
            </div>
        </div>

        <div class="info-card">
            <i class="fas fa-info-circle fa-2x mb-2"></i>
            <h5>Informasi Penting</h5>
            <p>Jadwal dapat berubah sewaktu-waktu. Pantau terus website ini untuk informasi terbaru.</p>
            <p><i class="fas fa-question-circle me-1"></i> Jika ada pertanyaan, hubungi panitia PPDB di (0728) 12345</p>
        </div>

        <div class="text-center mt-4">
            <a href="portal.php" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Kembali ke Portal</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>