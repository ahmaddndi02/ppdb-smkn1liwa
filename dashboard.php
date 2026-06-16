<?php
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM pendaftar WHERE user_id = ?");
$stmt->execute([$user_id]);
$pendaftaran = $stmt->fetch();

$stmt = $pdo->query("SELECT * FROM pengaturan WHERE id = 1");
$setting = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #e3f2fd, #ffffff); font-family: 'Segoe UI', sans-serif; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); padding: 12px 0; }
        .navbar-brand { display: flex; align-items: center; gap: 10px; font-weight: bold; font-size: 20px; color: #0d47a1; text-decoration: none; }
        .navbar-brand img { height: 40px; width: auto; }
        .dashboard-card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-top: 20px; }
        .btn-custom { background: linear-gradient(135deg, #0d47a1, #1976d2); color: white; padding: 10px 30px; border-radius: 50px; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-custom:hover { transform: translateY(-2px); color: white; }
        .btn-back { background: #6c757d; color: white; padding: 10px 30px; border-radius: 50px; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-back:hover { background: #5a6268; color: white; }
        .status-badge { display: inline-block; padding: 5px 15px; border-radius: 50px; font-weight: bold; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-verifikasi { background: #d1ecf1; color: #0c5460; }
        .status-diterima { background: #d4edda; color: #155724; }
        .status-ditolak { background: #f8d7da; color: #721c24; }
        footer { background: white; border-radius: 10px; padding: 15px; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="portal.php">
            <img src="assets/img/logo.jpg" alt="Logo SMK N 1 LIWA">
            SMK N 1 LIWA
        </a>
        <div>
            <a href="portal.php" class="btn btn-outline-primary btn-sm me-2">
                <i class="fas fa-globe"></i> Kembali ke Portal
            </a>
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="dashboard-card">
        <h3 class="text-center mb-4" style="color: #0d47a1;"><i class="fas fa-tachometer-alt me-2"></i> Dashboard Siswa</h3>
        
        <?php if ($pendaftaran): ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><td><strong>No. Pendaftaran</strong></td><td>: <?= $pendaftaran['no_pendaftaran'] ?></td></tr>
                        <tr><td><strong>Nama Lengkap</strong></td><td>: <?= htmlspecialchars($pendaftaran['nama_lengkap']) ?></td></tr>
                        <tr><td><strong>Tanggal Daftar</strong></td><td>: <?= date('d-m-Y H:i:s', strtotime($pendaftaran['tanggal_daftar'])) ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><td><strong>Status</strong></td><td>: 
                            <?php
                            $status_class = '';
                            $status_text = '';
                            if ($pendaftaran['status'] == 'pending') { $status_class = 'status-pending'; $status_text = 'PENDING'; }
                            elseif ($pendaftaran['status'] == 'verifikasi') { $status_class = 'status-verifikasi'; $status_text = 'VERIFIKASI'; }
                            elseif ($pendaftaran['status'] == 'diterima') { $status_class = 'status-diterima'; $status_text = 'DITERIMA'; }
                            else { $status_class = 'status-ditolak'; $status_text = 'DITOLAK'; }
                            ?>
                            <span class="status-badge <?= $status_class ?>"><?= $status_text ?></span>
                        </td></tr>
                        <tr><td><strong>Asal Sekolah</strong></td><td>: <?= htmlspecialchars($pendaftaran['asal_sekolah'] ?? '-') ?></td></tr>
                    </table>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="pendaftaran/cetak_pdf.php?no=<?= $pendaftaran['no_pendaftaran'] ?>" class="btn-custom" target="_blank">
                    <i class="fas fa-print me-2"></i> Cetak Bukti Pendaftaran
                </a>
                <a href="portal.php" class="btn-back ms-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Portal
                </a>
            </div>
        <?php else: ?>
            <div class="text-center">
                <i class="fas fa-file-alt fa-4x mb-3" style="color: #0d47a1;"></i>
                <h4>Belum Ada Pendaftaran</h4>
                <p>Anda belum mengisi formulir pendaftaran.</p>
                <div class="mt-3">
                    <a href="pendaftaran/daftar.php" class="btn-custom"><i class="fas fa-edit me-2"></i> Isi Formulir Pendaftaran</a>
                    <a href="portal.php" class="btn-back ms-2"><i class="fas fa-arrow-left me-2"></i> Kembali ke Portal</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<footer><div class="container"><p>&copy; <?= date('Y') ?> SMK N 1 LIWA - All Rights Reserved</p></div></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>