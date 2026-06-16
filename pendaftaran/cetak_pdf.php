<?php
require_once '../config/database.php';

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$no_pendaftaran = $_GET['no'] ?? '';

// Ambil data pendaftar
$stmt = $pdo->prepare("SELECT * FROM pendaftar WHERE no_pendaftaran = ? AND user_id = ?");
$stmt->execute([$no_pendaftaran, $_SESSION['user_id']]);
$p = $stmt->fetch();

if (!$p) {
    die("Data tidak ditemukan!");
}

// Load library Dompdf - PATH SESUAI STRUKTUR ANDA
require_once __DIR__ . '/../vendor/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

$html = '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - ' . $p['no_pendaftaran'] . '</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 3px solid #0d47a1; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #0d47a1; margin: 0; }
        .header h3 { margin: 5px 0; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { width: 200px; background: #f2f2f2; }
        .footer { text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666; }
        .signature { margin-top: 30px; display: flex; justify-content: space-between; }
        .stempel { text-align: center; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>SMK N 1 LIWA</h1>
        <h3>BUKTI PENDAFTARAN PESERTA DIDIK BARU</h3>
        <p>Nomor Pendaftaran: <strong>' . $p['no_pendaftaran'] . '</strong></p>
    </div>
    
    <table>
        <tr><th>Nama Lengkap</th><td>' . htmlspecialchars($p['nama_lengkap']) . '</td></tr>
        <tr><th>NISN</th><td>' . htmlspecialchars($p['nisn'] ?? '-') . '</td></tr>
        <tr><th>Tempat, Tanggal Lahir</th><td>' . htmlspecialchars($p['tempat_lahir'] ?? '-') . ', ' . date('d-m-Y', strtotime($p['tanggal_lahir'])) . '</td></tr>
        <tr><th>Jenis Kelamin</th><td>' . ($p['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') . '</td></tr>
        <tr><th>Alamat</th><td>' . nl2br(htmlspecialchars($p['alamat'] ?? '-')) . '</td></tr>
        <tr><th>No Telepon</th><td>' . htmlspecialchars($p['telepon'] ?? '-') . '</td></tr>
        <tr><th>Email</th><td>' . htmlspecialchars($p['email'] ?? '-') . '</td></tr>
        <tr><th>Asal Sekolah</th><td>' . htmlspecialchars($p['asal_sekolah'] ?? '-') . '</td></tr>
        <tr><th>Status</th><td><strong>' . strtoupper($p['status']) . '</strong></td></tr>
    </table>
    
    <div class="signature">
        <div class="stempel">
            <p>Calon Peserta Didik,</p>
            <br><br>
            <p>( ' . htmlspecialchars($p['nama_lengkap']) . ' )</p>
        </div>
        <div class="stempel">
            <p>Panitia PPDB,</p>
            <br><br>
            <p>___________________</p>
        </div>
    </div>
    
    <div class="footer">
        <p>Bukti ini dicetak secara online dan sah digunakan untuk keperluan daftar ulang.</p>
        <p>Dicetak pada: ' . date('d-m-Y H:i:s') . '</p>
        <p>&copy; ' . date('Y') . ' SMK N 1 LIWA</p>
    </div>
</div>
</body>
</html>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("bukti_pendaftaran_" . $p['no_pendaftaran'] . ".pdf", array("Attachment" => 0));
exit;
?>