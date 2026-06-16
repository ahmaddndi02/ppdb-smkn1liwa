<?php
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) { header("Location: ../login.php"); exit; }

$stmt = $pdo->prepare("SELECT id FROM pendaftar WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
if ($stmt->rowCount() > 0) { header("Location: ../dashboard.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_pendaftaran = 'PPDB-' . date('Ymd') . rand(100, 999);
    $sql = "INSERT INTO pendaftar (user_id, no_pendaftaran, nama_lengkap, nisn, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt_rw, kelurahan, kecamatan, kota, provinsi, kode_pos, telepon, email, nama_ayah, pekerjaan_ayah, nama_ibu, pekerjaan_ibu, asal_sekolah, npsn) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $no_pendaftaran, $_POST['nama_lengkap'], $_POST['nisn'], $_POST['tempat_lahir'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'], $_POST['alamat'], $_POST['rt_rw'], $_POST['kelurahan'], $_POST['kecamatan'], $_POST['kota'], $_POST['provinsi'], $_POST['kode_pos'], $_POST['telepon'], $_POST['email'], $_POST['nama_ayah'], $_POST['pekerjaan_ayah'], $_POST['nama_ibu'], $_POST['pekerjaan_ibu'], $_POST['asal_sekolah'], $_POST['npsn']]);
    header("Location: sukses.php?no=" . $no_pendaftaran);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Form Pendaftaran - SMK N 1 LIWA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
        .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
        .navbar-brand{display:flex;align-items:center;gap:12px;font-weight:bold;font-size:22px;color:#0d47a1;text-decoration:none}
        .navbar-brand img{height:45px;width:auto;border-radius:50%;object-fit:cover}
        .form-card{background:#fff;border-radius:20px;padding:30px;box-shadow:0 10px 30px rgba(0,0,0,0.1);margin:20px 0}
        .form-section{background:#f8f9fa;padding:20px;border-radius:15px;margin-bottom:25px;border-left:4px solid #0d47a1}
        .form-section h5{color:#0d47a1;margin-bottom:20px;font-weight:700}
        .btn-submit{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:12px 50px;border-radius:50px;font-weight:700;border:none}
        .btn-submit:hover{transform:translateY(-2px)}
        .btn-back{background:#6c757d;color:#fff;padding:12px 30px;border-radius:50px;text-decoration:none;font-weight:700}
        .btn-back:hover{background:#5a6268;color:#fff}
        .required:after{content:" *";color:red}
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="../portal.php">
            <img src="../assets/img/logo.jpg" alt="Logo SMK N 1 LIWA" onerror="this.src='https://placehold.co/45x45?text=SMK'">
            SMK N 1 LIWA
        </a>
        <a href="../portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a>
    </div>
</nav>
<div class="container">
    <div class="form-card">
        <h2 class="text-center mb-4" style="color:#0d47a1;"><i class="fas fa-edit me-2"></i> Formulir Pendaftaran Siswa Baru</h2>
        <form method="POST">
            <div class="form-section"><h5><i class="fas fa-user me-2"></i> Data Pribadi</h5>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label required">Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label class="form-label">NISN</label><input type="text" name="nisn" class="form-control"></div>
                    <div class="col-md-4 mb-3"><label class="form-label">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control"></div>
                    <div class="col-md-4 mb-3"><label class="form-label">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control"></div>
                    <div class="col-md-4 mb-3"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin" class="form-control"><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div>
                    <div class="col-12 mb-3"><label class="form-label">Alamat Lengkap</label><textarea name="alamat" class="form-control" rows="2"></textarea></div>
                    <div class="col-md-3 mb-3"><label class="form-label">RT/RW</label><input type="text" name="rt_rw" class="form-control"></div>
                    <div class="col-md-3 mb-3"><label class="form-label">Kelurahan</label><input type="text" name="kelurahan" class="form-control"></div>
                    <div class="col-md-3 mb-3"><label class="form-label">Kecamatan</label><input type="text" name="kecamatan" class="form-control"></div>
                    <div class="col-md-3 mb-3"><label class="form-label">Kode Pos</label><input type="text" name="kode_pos" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Kota/Kabupaten</label><input type="text" name="kota" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Provinsi</label><input type="text" name="provinsi" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">No Telepon/HP</label><input type="text" name="telepon" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control"></div>
                </div>
            </div>
            <div class="form-section"><h5><i class="fas fa-users me-2"></i> Data Orang Tua</h5>
                <div class="row">
                    <div class="col-md-6 mb-3"><label class="form-label">Nama Ayah</label><input type="text" name="nama_ayah" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Pekerjaan Ayah</label><input type="text" name="pekerjaan_ayah" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Nama Ibu</label><input type="text" name="nama_ibu" class="form-control"></div>
                    <div class="col-md-6 mb-3"><label class="form-label">Pekerjaan Ibu</label><input type="text" name="pekerjaan_ibu" class="form-control"></div>
                </div>
            </div>
            <div class="form-section"><h5><i class="fas fa-school me-2"></i> Data Sekolah Asal</h5>
                <div class="row">
                    <div class="col-md-8 mb-3"><label class="form-label">Asal Sekolah</label><input type="text" name="asal_sekolah" class="form-control"></div>
                    <div class="col-md-4 mb-3"><label class="form-label">NPSN</label><input type="text" name="npsn" class="form-control"></div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane me-2"></i> LANJUTKAN & SIMPAN</button>
                <a href="../portal.php" class="btn-back ms-3"><i class="fas fa-arrow-left me-2"></i> KEMBALI KE PORTAL</a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>