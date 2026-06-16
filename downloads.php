<?php
$file = $_GET['file'] ?? '';
$allowed = ['formulir_pendaftaran.pdf', 'panduan_ppdb_2026.pdf', 'surat_pernyataan.docx', 'jadwal_ppdb_2026.pdf'];

if (!in_array($file, $allowed)) {
    die("File tidak ditemukan!");
}

$filepath = "downloads/" . $file;

if (!file_exists($filepath)) {
    // Buat file jika belum ada
    $content = "Contoh file: " . $file . "\n\nIni adalah contoh file untuk PPDB SMK N 1 LIWA.";
    file_put_contents($filepath, $content);
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Content-Length: ' . filesize($filepath));
readfile($filepath);
exit;
?>