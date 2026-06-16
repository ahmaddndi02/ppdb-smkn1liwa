<?php
require_once 'config/database.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM pendaftar WHERE user_id = ?");
$stmt->execute([$user_id]);
$pendaftar = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Hasil Seleksi - SMK N 1 LIWA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
    .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
    .navbar-brand{display:flex;align-items:center;gap:10px;font-weight:bold;font-size:20px;color:#0d47a1;text-decoration:none}
    .navbar-brand img{height:40px;width:auto}
    .result-card{background:#fff;border-radius:20px;padding:30px;box-shadow:0 10px 30px rgba(0,0,0,0.1);margin:20px 0;text-align:center}
    .btn-custom{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:10px 25px;border-radius:50px;text-decoration:none}
    .btn-back{background:#6c757d;color:#fff;padding:10px 25px;border-radius:50px;text-decoration:none}
    .status-diterima{color:#28a745}.status-ditolak{color:#dc3545}.status-pending{color:#ffc107}
</style>
</head>
<body>
<nav class="navbar"><div class="container"><a class="navbar-brand" href="portal.php"><img src="assets/img/logo.jpg" alt="Logo">SMK N 1 LIWA</a><a href="portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a></div></nav>
<div class="container"><div class="result-card">
<?php if(!$pendaftar): ?>
    <i class="fas fa-file-alt fa-5x mb-3" style="color:#0d47a1;"></i><h3>Belum Ada Data Pendaftaran</h3><p>Silakan daftar terlebih dahulu.</p>
    <a href="pendaftaran/daftar.php" class="btn-custom">Daftar Sekarang</a>
<?php else: ?>
    <?php $status=$pendaftar['status']; ?>
    <?php if($status=='diterima'): ?>
        <i class="fas fa-check-circle fa-5x status-diterima mb-3"></i><h3 class="status-diterima">SELAMAT! ANDA DITERIMA</h3><p>Anda dinyatakan LULUS seleksi PPDB SMK N 1 LIWA.</p>
    <?php elseif($status=='ditolak'): ?>
        <i class="fas fa-times-circle fa-5x status-ditolak mb-3"></i><h3 class="status-ditolak">MAAF, ANDA BELUM DITERIMA</h3><p>Silakan coba lagi di gelombang berikutnya.</p>
    <?php else: ?>
        <i class="fas fa-hourglass-half fa-5x status-pending mb-3"></i><h3 class="status-pending">PENDAFTARAN SEDANG DIPROSES</h3><p>Pendaftaran Anda sedang dalam proses verifikasi.</p>
    <?php endif; ?>
    <div class="alert alert-info mt-3"><strong>Nomor Pendaftaran:</strong> <?= $pendaftar['no_pendaftaran'] ?></div>
    <div class="mt-4"><a href="dashboard.php" class="btn-custom">Lihat Dashboard</a><a href="portal.php" class="btn-back ms-2">Kembali ke Portal</a></div>
<?php endif; ?>
</div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>