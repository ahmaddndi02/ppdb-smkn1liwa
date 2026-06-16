<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_pendaftar_" . date('Y-m-d') . ".xls");

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>No Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>NISN</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Email</th>
        <th>Asal Sekolah</th>
        <th>Nama Ayah</th>
        <th>Nama Ibu</th>
        <th>Status</th>
        <th>Tanggal Daftar</th>
      </tr>";

$stmt = $pdo->query("SELECT * FROM pendaftar ORDER BY tanggal_daftar DESC");
$pendaftar = $stmt->fetchAll();
$no = 1;

foreach($pendaftar as $p) {
    echo "<tr>
            <td>{$no}</td>
            <td>{$p['no_pendaftaran']}</td>
            <td>{$p['nama_lengkap']}</td>
            <td>{$p['nisn']}</td>
            <td>{$p['tempat_lahir']}</td>
            <td>{$p['tanggal_lahir']}</td>
            <td>" . ($p['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') . "</td>
            <td>{$p['alamat']}</td>
            <td>{$p['telepon']}</td>
            <td>{$p['email']}</td>
            <td>{$p['asal_sekolah']}</td>
            <td>{$p['nama_ayah']}</td>
            <td>{$p['nama_ibu']}</td>
            <td>" . strtoupper($p['status']) . "</td>
            <td>{$p['tanggal_daftar']}</td>
          </tr>";
    $no++;
}

echo "</table>";
?>