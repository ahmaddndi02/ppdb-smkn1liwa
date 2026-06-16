<?php
require_once 'config/database.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$user_id = $_SESSION['user_id'];
$success = ''; $error = '';

$stmt = $pdo->prepare("SELECT * FROM pendaftar WHERE user_id = ?");
$stmt->execute([$user_id]);
$pendaftar = $stmt->fetch();

if (!$pendaftar) { header("Location: pendaftaran/daftar.php"); exit; }

function uploadFile($file, $folder, $existingFile = null) {
    if ($file['error'] == 4) return $existingFile;
    $targetDir = "uploads/$folder/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'pdf'];
    if (!in_array($ext, $allowedExt)) return "error_ext";
    if ($file['size'] > 2 * 1024 * 1024) return "error_size";
    if ($existingFile && file_exists($existingFile)) unlink($existingFile);
    $fileName = time() . '_' . uniqid() . '.' . $ext;
    $targetFile = $targetDir . $fileName;
    if (move_uploaded_file($file['tmp_name'], $targetFile)) return "uploads/$folder/$fileName";
    return null;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $foto = uploadFile($_FILES['foto'], 'foto', $pendaftar['foto'] ?? null);
    $ijazah = uploadFile($_FILES['ijazah'], 'ijazah', $pendaftar['ijazah'] ?? null);
    $kk = uploadFile($_FILES['kartu_keluarga'], 'kk', $pendaftar['kartu_keluarga'] ?? null);
    if ($foto == "error_ext" || $ijazah == "error_ext" || $kk == "error_ext") $error = "Format file tidak valid. Gunakan JPG, PNG, atau PDF.";
    elseif ($foto == "error_size" || $ijazah == "error_size" || $kk == "error_size") $error = "Ukuran file maksimal 2MB.";
    else {
        $sql = "UPDATE pendaftar SET foto = COALESCE(?, foto), ijazah = COALESCE(?, ijazah), kartu_keluarga = COALESCE(?, kartu_keluarga) WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$foto, $ijazah, $kk, $user_id]);
        $success = "Berkas berhasil diupload!";
        $stmt = $pdo->prepare("SELECT * FROM pendaftar WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $pendaftar = $stmt->fetch();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Upload Berkas - SMK N 1 LIWA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body{background:linear-gradient(135deg,#e3f2fd,#fff);font-family:'Segoe UI',sans-serif}
    .navbar{background:#fff;box-shadow:0 2px 10px rgba(0,0,0,0.05);padding:12px 0}
    .navbar-brand{display:flex;align-items:center;gap:10px;font-weight:bold;font-size:20px;color:#0d47a1;text-decoration:none}
    .navbar-brand img{height:40px;width:auto}
    .upload-card{background:#fff;border-radius:20px;padding:30px;box-shadow:0 10px 30px rgba(0,0,0,0.1);margin:20px 0}
    .upload-area{border:2px dashed #ccc;border-radius:15px;padding:25px;text-align:center;cursor:pointer;transition:0.3s;background:#f8f9fa}
    .upload-area:hover{border-color:#0d47a1;background:#e3f2fd}
    .status-badge{display:inline-block;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600}
    .status-sudah{background:#d4edda;color:#155724}
    .status-belum{background:#f8d7da;color:#721c24}
    .btn-submit{background:linear-gradient(135deg,#0d47a1,#1976d2);color:#fff;padding:12px 40px;border-radius:50px;font-weight:700;border:none}
    .btn-back{background:#6c757d;color:#fff;padding:12px 30px;border-radius:50px;text-decoration:none}
</style>
</head>
<body>
<nav class="navbar"><div class="container"><a class="navbar-brand" href="portal.php"><img src="assets/img/logo.jpg" alt="Logo">SMK N 1 LIWA</a><a href="portal.php" class="btn btn-outline-primary btn-sm">Kembali ke Portal</a></div></nav>
<div class="container"><div class="upload-card"><h3 class="text-center mb-4" style="color:#0d47a1;"><i class="fas fa-upload me-2"></i> Upload Berkas</h3>
<?php if($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
<?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
<form method="POST" enctype="multipart/form-data"><div class="row">
<div class="col-md-4 mb-4"><div class="text-center"><i class="fas fa-camera fa-3x" style="color:#0d47a1;"></i><h5>Pas Foto</h5><?php $fs=$pendaftar['foto']?'sudah':'belum';?><span class="status-badge status-<?=$fs?>"><i class="fas fa-<?=$pendaftar['foto']?'check-circle':'times-circle'?> me-1"></i> <?=$pendaftar['foto']?'Sudah diupload':'Belum diupload'?></span></div><div class="upload-area" onclick="document.getElementById('foto').click()"><i class="fas fa-cloud-upload-alt fa-3x mb-2"></i><p>Klik upload</p><small>JPG,PNG | Max 2MB</small></div><input type="file" name="foto" id="foto" class="d-none" accept="image/jpeg,image/png"></div>
<div class="col-md-4 mb-4"><div class="text-center"><i class="fas fa-file-pdf fa-3x" style="color:#0d47a1;"></i><h5>Ijazah</h5><?php $is=$pendaftar['ijazah']?'sudah':'belum';?><span class="status-badge status-<?=$is?>"><i class="fas fa-<?=$pendaftar['ijazah']?'check-circle':'times-circle'?> me-1"></i> <?=$pendaftar['ijazah']?'Sudah diupload':'Belum diupload'?></span></div><div class="upload-area" onclick="document.getElementById('ijazah').click()"><i class="fas fa-cloud-upload-alt fa-3x mb-2"></i><p>Klik upload</p><small>PDF,JPG,PNG | Max 2MB</small></div><input type="file" name="ijazah" id="ijazah" class="d-none" accept=".pdf,image/jpeg,image/png"></div>
<div class="col-md-4 mb-4"><div class="text-center"><i class="fas fa-file-alt fa-3x" style="color:#0d47a1;"></i><h5>Kartu Keluarga</h5><?php $ks=$pendaftar['kartu_keluarga']?'sudah':'belum';?><span class="status-badge status-<?=$ks?>"><i class="fas fa-<?=$pendaftar['kartu_keluarga']?'check-circle':'times-circle'?> me-1"></i> <?=$pendaftar['kartu_keluarga']?'Sudah diupload':'Belum diupload'?></span></div><div class="upload-area" onclick="document.getElementById('kk').click()"><i class="fas fa-cloud-upload-alt fa-3x mb-2"></i><p>Klik upload</p><small>PDF,JPG,PNG | Max 2MB</small></div><input type="file" name="kartu_keluarga" id="kk" class="d-none" accept=".pdf,image/jpeg,image/png"></div>
</div><div class="text-center mt-3"><button type="submit" class="btn-submit"><i class="fas fa-upload me-2"></i> Upload Berkas</button><a href="portal.php" class="btn-back ms-2">Kembali ke Portal</a></div></form></div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>