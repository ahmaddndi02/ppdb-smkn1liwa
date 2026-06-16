<?php
$host = 'sql102.infinityfree.com';
$dbname = 'if0_42174542_ppdb_smk';
$username = 'if0_42174542';
$password = 'tFSpVR24uimUbG';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    echo "<h1 style='color:green'>✅ Koneksi BERHASIL!</h1>";
} catch(PDOException $e) {
    echo "<h1 style='color:red'>❌ Koneksi GAGAL</h1>";
    echo "Error: " . $e->getMessage();
}
?>