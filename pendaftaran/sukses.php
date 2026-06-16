<?php
$no_pendaftaran = $_GET['no'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Pendaftaran Berhasil - SMK N 1 LIWA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif;min-height:100vh;display:flex;align-items:center}
    .success-card{background:#fff;border-radius:20px;padding:40px;box-shadow:0 10px 30px rgba(0,0,0,0.1);text-align:center;max-width:600px;margin:auto}
    .btn-custom{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:10px 25px;border-radius:50px;text-decoration:none}
    .btn-back{background:#6c757d;color:#fff;padding:10px 25px;border-radius:50px;text-decoration:none}
</style>
</head>
<body>
<div class="container"><div class="success-card"><i class="fas fa-check-circle fa-5x text-success mb-4"></i><h1 class="text-success">Pendaftaran Berhasil!</h1><p class="lead">Selamat, pendaftaran Anda telah kami terima.</p>
<div class="alert alert-info"><h4>Nomor Pendaftaran Anda:</h4><h2 class="text-primary fw-bold"><?= htmlspecialchars($no_pendaftaran) ?></h2></div>
<p><strong>Simpan nomor pendaftaran ini untuk:</strong></p><ul class="list-unstyled"><li>✅ Melihat status pendaftaran</li><li>✅ Keperluan daftar ulang</li></ul>
<div class="mt-4"><a href="../dashboard.php" class="btn-custom"><i class="fas fa-tachometer-alt me-2"></i> Lihat Dashboard</a><a href="../portal.php" class="btn-back ms-2"><i class="fas fa-globe me-2"></i> Kembali ke Portal</a></div></div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>